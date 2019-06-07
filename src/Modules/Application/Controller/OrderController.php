<?php

namespace D3\Heidelpay\Modules\Application\Controller;

use D3\Heidelpay\Controllers\Order;
use D3\Heidelpay\Models\Containers\Criterions;
use D3\Heidelpay\Models\Factory;
use D3\Heidelpay\Models\Payment\Easycredit;
use D3\Heidelpay\Models\Payment\Exception\PaymentNotReferencedToHeidelpayException;
use D3\Heidelpay\Models\Settings\Exception\EmptyPaymentlistException;
use D3\Heidelpay\Models\Settings\Heidelpay;
use D3\Heidelpay\Models\Transactionlog\Reader\Heidelpay as ReaderHeidelpay;
use D3\Heidelpay\Models\Verify\Exception\AgbNotAcceptedException;
use D3\Heidelpay\Models\Verify\Exception\CheckSessionChallengeException;
use D3\Heidelpay\Models\Verify\Exception\NotLoggedInException;
use D3\Heidelpay\Models\Viewconfig;
use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use D3\ModCfg\Application\Model\Log\d3log;
use D3\ModCfg\Application\Model\Transactionlog\d3transactionlog;
use Doctrine\DBAL\DBALException;
use Exception;
use OxidEsales\Eshop\Application\Model\Basket;
use OxidEsales\Eshop\Application\Model\Payment;
use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Model\BaseModel;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;
use OxidEsales\Eshop\Core\UtilsView;

/**
 */
class OrderController extends OrderController_parent
{

    /**
     * Return-Klasse, die von der hp_resonse.php nach Aufruf order::execute() erhalten wurde (z.B. "thankyou")
     *
     * @var string
     */
    public $s3dsClassReturn;

    /**
     * Kontrollvariable fuer die Beendigung des 3DSecure-iFrames
     *
     * @var string
     */
    protected $_blIsHeidelpaySecureSuccess = false;

    /**
     * @var string
     */
    protected $_sHeidelpaySecureiFrameTemplate = 'd3_heidelpay_views_azure_tpl_order_3ds_iframe.tpl';

    /**
     * array of years
     * @var array
     */
    protected $_aCreditYears                = null;

    /**
     * @var array
     */
    protected $d3HeidelpayExceptionRoutings = [
        NotLoggedInException::class                      => 'd3HeidelpayRouteToUser',
        CheckSessionChallengeException::class            => 'd3HeidelpayRouteToOrder',
        AgbNotAcceptedException::class                   => 'd3HeidelpayRouteToOrderWithAGBError',
        PaymentNotReferencedToHeidelpayException::class => 'd3HeidelpayRouteToParentExecute',
        EmptyPaymentlistException::class               => 'd3HeidelpayRouteToParentExecute',
    ];

    /**
     * OrderController constructor.
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function __construct()
    {
        $settings = oxNew(Heidelpay::class, d3_cfg_mod::get('d3heidelpay'));
        Registry::set(Heidelpay::class, $settings);
        parent::__construct();
    }

    /**
     * @return mixed|string
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function render()
    {
        $ret = parent::render();
        if (false === d3_cfg_mod::get('d3heidelpay')->isActive()) {
            return $ret;
        }
        $this->addTplParam('isHeidelpayDebugMode', (bool)d3_cfg_mod::get('d3heidelpay')->getValue('d3heidelpay_blTestmode'));

        $oHeidelpayViewConfig = oxNew(
            Viewconfig::class,
            d3_cfg_mod::get('d3heidelpay'),
            Registry::get(Registry::class),
            oxNew(Factory::class, d3_cfg_mod::get('d3heidelpay'))
        );

        $this->addTplParam('oHeidelpayViewConfig', $oHeidelpayViewConfig);
        $sHeidelpayTemplate = Registry::get(Request::class)->getRequestParameter('heidelpaytemplate');

        if (false == empty($sHeidelpayTemplate)) {
            $this->_sThisTemplate = $sHeidelpayTemplate;
        }

        return $this->_sThisTemplate;
    }

    /**
     * Return route to payment if no d3 secure payment
     *
     * @return string partizielle rueckgabe der klasse
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function show3DSecureFrame()
    {
        if (false == d3_cfg_mod::get('d3heidelpay')->isActive()) {
            d3_cfg_mod::get('d3heidelpay')->d3getLog()->log(
                d3log::INFO,
                __CLASS__,
                __FUNCTION__,
                __LINE__,
                'module is inactive',
                'module is inactive'
            );

            return '';
        }

        $sReturn   = '';
        $aDynValue = Registry::getSession()->getVariable('dynvalue');

        $transaction = null;

        if (isset($aDynValue['oxuid']) && false == empty($aDynValue['oxuid'])) {
            $logReader   = oxNew(ReaderHeidelpay::class);
            $transaction = oxNew(d3transactionlog::class, $logReader);
            $sUniqueId   = $aDynValue['oxuid'];

            if (false == $transaction->load(DatabaseProvider::getDb()->getOne('SELECT * FROM d3transactionlog WHERE d3reference = ?', array($sUniqueId)))) {
                d3_cfg_mod::get('d3heidelpay')->d3getLog()->log(
                    d3log::WARNING,
                    __CLASS__,
                    __FUNCTION__,
                    __LINE__,
                    'could not load d3transactionlog for saved payment',
                    print_r("SELECT * FROM d3transactionlog WHERE d3reference = '$sUniqueId'", true)
                );

            }
        }

        /** @var Factory $oFactory */
        $oFactory = oxNew(Factory::class, d3_cfg_mod::get('d3heidelpay'));

        if (false == $oFactory->getSettings()->isSecurePayment(Registry::get(Registry::class), $oFactory)) {
            $sReturn = 'payment?payerror=2';
        }

        d3_cfg_mod::get('d3heidelpay')->d3getLog()->log(
            d3log::INFO,
            __CLASS__,
            __FUNCTION__,
            __LINE__,
            'return value',
            var_export($sReturn, true)
        );

        return $sReturn;
    }

    /**
     * Template variable getter. Returns array of years for credit cards
     *
     * @return array
     */
    public function getCreditYears()
    {
        if ($this->_aCreditYears === null) {
            $this->_aCreditYears = false;

            $this->_aCreditYears = range(date('Y'), date('Y') + 10);
        }

        return $this->_aCreditYears;
    }

    /**
     * Returns user stored payment data
     *
     * @param $sPaymentId
     *
     * @return array
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getUserHPStoreData($sPaymentId)
    {
        if (false == d3_cfg_mod::get('d3heidelpay')->isActive()) {
            return array();
        }

        $storeIds = $this->getUserHPStoreIDs($sPaymentId);
        if (empty($storeIds)) {
            return array();
        }

        $storedData = array();

        foreach ($storeIds as $storeId) {
            /** @var BaseModel $oUsrStoreData */
            $oUsrStoreData = oxNew(BaseModel::class);
            $oUsrStoreData->init('d3hpuid');
            $oUsrStoreData->load($storeId['OXID']);

            $oUsrStoreData->aDynValue          = unserialize($oUsrStoreData->d3hpuid__oxpaymentdata->rawValue);
            $oUsrStoreData->aDynValue['oxuid'] = $oUsrStoreData->getFieldData('oxuid');
            $storedData[$storeId['OXID']]      = $oUsrStoreData;
        }

        return $storedData;
    }

    /**
     * Returns id of user stored payment data
     *
     * @param $sPaymentId
     *
     * @return array
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getUserHPStoreIDs($sPaymentId)
    {
        if (false == ($sUserID = $this->getSession()->getVariable("usr"))) {
            return array();
        }
        $shopid = $this->getConfig()->getShopId();
        return DatabaseProvider::getDb(DatabaseProvider::FETCH_MODE_ASSOC)->getAll(
            "SELECT `oxid` AS OXID FROM `d3hpuid` WHERE `oxuserid` = '$sUserID' AND `oxpaymentid` = '$sPaymentId' AND `oxshopid` = '$shopid'"
        );
    }

    //<editor-fold desc="TODO:3 ways with existing paymentdata possible. see /tests/acceptance/selenium/dudeWantToPay.graphml">

    /**
     * @return string
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function d3GetAfterStepTemplate()
    {
        $themeId      = d3_cfg_mod::get('d3heidelpay')->getMappedThemeId();
        $blUseHPStore = Registry::get(Request::class)->getRequestParameter("usehpstore");
        /** @var Basket $oBasket */
        $oBasket    = $this->getBasket();
        $sPaymentid = $oBasket->getPaymentId();

        if ($this->hasUserHPStoreData($sPaymentid) && is_null($blUseHPStore)) {
            return "d3_heidelpay_views_{$themeId}_tpl_storeduid.tpl";
        }

        return "d3_heidelpay_views_{$themeId}_tpl_order_iframe.tpl";
    }

    /**
     * Returns true if user has stored payment data
     *
     * @param $sPaymentId
     *
     * @return bool
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function hasUserHPStoreData($sPaymentId)
    {
        if (false == d3_cfg_mod::get('d3heidelpay')->isActive()) {
            d3_cfg_mod::get('d3heidelpay')->d3getLog()->log(
                d3log::INFO,
                __CLASS__,
                __FUNCTION__,
                __LINE__,
                'module is inactive',
                'module is inactive'
            );

            return false;
        }

        // keine Anzeige gespeicherter Registrierungsdaten erlauben?
        if (false == d3_cfg_mod::get('d3heidelpay')->getValue('d3heidelpay_blShowStoredHPData')) {
            return false;
        }

        return (bool)$this->getUserHPStoreID($sPaymentId);
    }

    /**
     * Returns id of user stored payment data
     *
     * @param $sPaymentId
     *
     * @return string
     * @throws DatabaseConnectionException
     */
    public function getUserHPStoreID($sPaymentId)
    {
        if (false == ($sUserID = $this->getSession()->getVariable("usr"))) {
            return '';
        }
        $shopid = $this->getConfig()->getShopId();

        return DatabaseProvider::getDb()->getOne(
            "SELECT `oxid` FROM `d3hpuid` WHERE `oxuserid` = '$sUserID' AND `oxpaymentid` = '$sPaymentId' AND `oxshopid` = '$shopid'"
        );
    }

    /**
     * @return string
     * @throws StandardException
     * @throws d3_cfg_mod_exception
     * @throws Exception
     * @throws DatabaseConnectionException
     */
    public function d3PayWithStoreData()
    {
        /** @var Basket $oBasket */
        $oBasket    = $this->getBasket();
        $sPaymentid = $oBasket->getPaymentId();

        $blUseHPStore = Registry::get(Request::class)->getRequestParameter("usehpstore");
        if ($this->hasUserHPStoreData($sPaymentid) && $blUseHPStore) {
            return $this->execute();
        }

        return "";
    }
    //</editor-fold>

    /**
     * try to execute order
     * Returns the following action
     *
     * @throws StandardException
     * @return string Return-Wert fuer weiteren Klassen-Shopaufruf
     * @throws Exception
     */
    public function execute()
    {
        if (false == d3_cfg_mod::get('d3heidelpay')->isActive()) {
            d3_cfg_mod::get('d3heidelpay')->d3getLog()->log(
                d3log::INFO,
                __CLASS__,
                __FUNCTION__,
                __LINE__,
                'module is inactive',
                'module is inactive'
            );

            return parent::execute();
        }

        try {
            /** @var Payment $mPayment */
            $mPayment = $this->getPayment();

            if (false === $mPayment) {
                d3_cfg_mod::get('d3heidelpay')->d3getLog()->log(
                    d3log::WARNING,
                    __CLASS__,
                    __FUNCTION__,
                    __LINE__,
                    'payment is not set, execute parent',
                    print_r(var_export($mPayment, true), true)
                );

                return parent::execute();
            }

            $sUseHPStore = Registry::get(Request::class)->getRequestParameter("usehpstore");
            if ($this->hasUserHPStoreData($mPayment->getId()) && $sUseHPStore) {
                $this->d3LoadHeidelpayStoreData($sUseHPStore);

                return parent::execute();
            }

            /** @var Heidelpay $settings */
            $settings       = Registry::get(Heidelpay::class);
            $oHeidelPayment = $settings->getPayment($mPayment);

            /** @var Order $controllerFacade */
            $controllerFacade = oxNew(
                Order::class,
                Registry::get(Registry::class),
                d3_cfg_mod::get('d3heidelpay'),
                oxNew(Factory::class, d3_cfg_mod::get('d3heidelpay'))
            );
            $mResult          = $controllerFacade->execute($oHeidelPayment);

            d3_cfg_mod::get('d3heidelpay')->d3getLog()->log(
                d3log::INFO,
                __CLASS__,
                __FUNCTION__,
                __LINE__,
                'Heidelpay Order return value',
                print_r(var_export($mResult, true), true)
            );


            if (true === $mResult) {
                return parent::execute();
            }

            if (is_string($mResult)) {
                $urlparameter = $this->d3GetHeidelpayURLParameter();
                $urlparameter = http_build_query($urlparameter, '', '&');

                return $mResult . "&{$urlparameter}";
            }

        } catch (StandardException $exception) {
            foreach ($this->d3HeidelpayExceptionRoutings as $className => $d3HeidelpayExceptionRouting) {
                if(get_class($exception) === $className) {
                    return $this->$d3HeidelpayExceptionRouting($exception);
                }
            }
        }

        /** @var StandardException $exception */
        $exception = oxNew(StandardException::class, Registry::getLang()->translateString('d3heidelpay_execute_error'));
        Registry::get(UtilsView::class)->addErrorToDisplay($exception);

        d3_cfg_mod::get('d3heidelpay')->d3getLog()->log(
            d3log::INFO,
            __CLASS__,
            __FUNCTION__,
            __LINE__,
            'exception handling',
            get_class($exception) . PHP_EOL . $exception->getMessage() . PHP_EOL . $exception->getTraceAsString()
        );

        return '';
    }

    /**
     * @return array
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    protected function d3GetHeidelpayURLParameter()
    {
        //fake User-Checkboxen
        $mPostFields             = d3_cfg_mod::get('d3heidelpay')->getValue('d3_cfg_mod__d3heidelpay_additionalUrlParameter');
        $aPostFields             = explode(PHP_EOL, $mPostFields);
        $aHeidelpayPostparameter = array();
        foreach ($aPostFields as $sFieldDefinition) {
            list($sFieldName, $sValue) = explode('=>', $sFieldDefinition);
            $aHeidelpayPostparameter[trim($sFieldName)] = trim($sValue);
        }

        return $aHeidelpayPostparameter;
    }

    /**
     * @return array
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function d3GetHeidelpayPostparameter()
    {
        //fake User-Checkboxen
        $mPostFields             = d3_cfg_mod::get('d3heidelpay')->getValue('d3_cfg_mod__d3heidelpay_orderExecutePostFields');
        $aPostFields             = explode(PHP_EOL, $mPostFields);
        $aHeidelpayPostparameter = array();
        foreach ($aPostFields as $sFieldDefinition) {
            list($sFieldName, $sValue) = explode('=>', $sFieldDefinition);
            $aHeidelpayPostparameter[trim($sFieldName)] = trim($sValue);
        }

        return $aHeidelpayPostparameter;

    }

    /**
     * @return mixed
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function d3ValidateTransactionlogParameters()
    {
        $d3TransactionLogId = Registry::get(Request::class)->getRequestParameter('d3trlgid');

        d3_cfg_mod::get('d3heidelpay')->d3getLog()->log(
            d3log::INFO,
            __CLASS__,
            __FUNCTION__,
            __LINE__,
            'Validate Transactionlog Parameters',
            '$d3TransactionLogId is ' . $d3TransactionLogId
        );

        $controllerFacade = oxNew(
            Order::class,
            Registry::get(Registry::class),
            d3_cfg_mod::get('d3heidelpay'),
            oxNew(Factory::class, d3_cfg_mod::get('d3heidelpay'))
        );

        $return = $controllerFacade->validateTransactionlogParameters($this, $d3TransactionLogId);

        d3_cfg_mod::get('d3heidelpay')->d3getLog()->log(
            d3log::INFO,
            __CLASS__,
            __FUNCTION__,
            __LINE__,
            'return of Validate Transactionlog Parameters',
            'return is ' . empty($return) ? 'order' : $return
        );

        return $return;
    }

    /**
     * @param $templateName
     *
     * @return string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function d3GetTemplateName($templateName)
    {
        if (is_string($templateName)) {
            $sTemplate = d3_cfg_mod::get('d3heidelpay')->getMappedThemeId();

            return "d3_heidelpay_views_{$sTemplate}_tpl_{$templateName}.tpl";
        }

        return '';
    }

    /**
     * @return null
     * @throws EmptyPaymentlistException
     * @throws PaymentNotReferencedToHeidelpayException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getHeidelpayEasyCreditInformations()
    {
        /** @var Basket $oBasket */
        $oBasket    = $this->getBasket();
        $sPaymentid = $oBasket->getPaymentId();

        /** @var Heidelpay $oSettings */
        /** @var Payment $oPayment */
        $oSettings = oxNew(Heidelpay::class, d3_cfg_mod::get('d3heidelpay'));
        $oPayment  = oxNew(Payment::class);
        $oPayment->load($sPaymentid);
        if (false == $oSettings->isAssignedToHeidelPayment($oPayment)) {
            return null;
        }

        $oHeidelpayment = $oSettings->getPayment($oPayment);

        if ($oHeidelpayment instanceof Easycredit) {
            /** @var d3transactionlog $transaction */
            $transaction = oxNew(Factory::class, d3_cfg_mod::get('d3heidelpay'))->getLatestTransactionByObject();

            if (false === ($transaction instanceof ReaderHeidelpay)) {
                return null;
            }

            /** @var Criterions $criterionContainer */
            /** @var ReaderHeidelpay $reader */
            $reader = $transaction->getTransactiondata();
            $criterionContainer = oxNew(Criterions::class, oxNew(Criterions\Easycredit::class));

            return $criterionContainer->getSelectedCriterions($reader->getCriterionTags());
        }

        return null;
    }

    /**
     * @param int $mSuccess
     *
     * @return mixed|string
     * @throws EmptyPaymentlistException
     * @throws PaymentNotReferencedToHeidelpayException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    protected function _getNextStep($mSuccess)
    {
        if (false == d3_cfg_mod::get('d3heidelpay')->isActive()) {
            d3_cfg_mod::get('d3heidelpay')->d3getLog()->log(
                d3log::INFO,
                __CLASS__,
                __FUNCTION__,
                __LINE__,
                'module is inactive',
                'module is inactive'
            );

            return parent::_getNextStep($mSuccess);
        }

        if ($mSuccess === 'Show3DSecureFrame') {
            $sTemplateFor3DSecure = 'd3_heidelpay_views_azure_tpl_order_3ds_iframe.tpl';

            d3_cfg_mod::get('d3heidelpay')->d3getLog()->log(
                d3log::INFO,
                __CLASS__,
                __FUNCTION__,
                __LINE__,
                'next step is Show3DSecureFrame',
                "set return: 'order?fnc=Show3DSecureFrame&heidelpaytemplate=" . $sTemplateFor3DSecure . "'"
            );

            return 'order?fnc=Show3DSecureFrame&heidelpaytemplate=' . $sTemplateFor3DSecure;
        }

        $sReturn = parent::_getNextStep($mSuccess);

        /** @var Order $controllerFacade */
        $controllerFacade = oxNew(
            Order::class,
            Registry::get(Registry::class),
            d3_cfg_mod::get('d3heidelpay'),
            oxNew(Factory::class, d3_cfg_mod::get('d3heidelpay'))
        );

        $mNextStep = $controllerFacade->getNextOrderStep($sReturn, $mSuccess);

        d3_cfg_mod::get('d3heidelpay')->d3getLog()->log(
            d3log::INFO,
            __CLASS__,
            __FUNCTION__,
            __LINE__,
            'return value',
            "success: $mSuccess, sReturn: $sReturn, nextstep: " . var_export($mNextStep, true)

        );

        return $mNextStep;
    }

    /**
     * @param StandardException $exception
     *
     * @return string
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    protected function d3HeidelpayRouteToUser(StandardException $exception)
    {
        d3_cfg_mod::get('d3heidelpay')->d3getLog()->log(
            d3log::INFO,
            __CLASS__,
            __FUNCTION__,
            __LINE__,
            'exception handling',
            get_class($exception).PHP_EOL.$exception->getMessage().PHP_EOL.$exception->getTraceAsString()
        );

        return 'user';
    }

    /**
     * @param StandardException $exception
     *
     * @return string
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    protected function d3HeidelpayRouteToOrder(StandardException $exception)
    {
        d3_cfg_mod::get('d3heidelpay')->d3getLog()->log(
            d3log::INFO,
            __CLASS__,
            __FUNCTION__,
            __LINE__,
            'exception handling',
            get_class($exception).PHP_EOL.$exception->getMessage().PHP_EOL.$exception->getTraceAsString()
        );

        return '';
    }

    /**
     * @param StandardException $exception
     *
     * @return string
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    protected function d3HeidelpayRouteToOrderWithAGBError(StandardException $exception)
    {
        $this->_blConfirmAGBError = 1;

        return $this->d3HeidelpayRouteToOrder($exception);
    }

    /**
     * @param StandardException $exception
     *
     * @return string
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    protected function d3HeidelpayRouteToParentExecute(StandardException $exception)
    {
        d3_cfg_mod::get('d3heidelpay')->d3getLog()->log(
            d3log::INFO,
            __CLASS__,
            __FUNCTION__,
            __LINE__,
            'exception handling',
            get_class($exception).PHP_EOL.$exception->getMessage().PHP_EOL.$exception->getTraceAsString()
        );

        return parent::execute();
    }

    /**
     * @param $sUseHPStore
     *
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    protected function d3LoadHeidelpayStoreData($sUseHPStore)
    {
        d3_cfg_mod::get('d3heidelpay')->d3getLog()->log(
            d3log::INFO,
            __CLASS__,
            __FUNCTION__,
            __LINE__,
            'load user storage data',
            $sUseHPStore
        );

        /** @var BaseModel $userStoredData */
        $userStoredData = oxNew(BaseModel::class);
        $userStoredData->init('d3hpuid');
        if ($userStoredData->load($sUseHPStore)) {
            $userStoredData->aDynValue          = unserialize($userStoredData->d3hpuid__oxpaymentdata->rawValue);
            $userStoredData->aDynValue['oxuid'] = $userStoredData->getFieldData('oxuid');
            $this->getSession()->setVariable('dynvalue', $userStoredData->aDynValue);
            d3_cfg_mod::get('d3heidelpay')->d3getLog()->log(
                d3log::INFO,
                __CLASS__,
                __FUNCTION__,
                __LINE__,
                'set user storage data to session',
                print_r(var_export($userStoredData->aDynValue, true), true)
            );
        }
    }

}
