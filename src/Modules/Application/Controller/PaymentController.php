<?php
namespace D3\Heidelpay\Modules\Application\Controller;
use D3\Heidelpay\Models\Factory;
use D3\Heidelpay\Models\Payment\Billsafe;
use D3\Heidelpay\Models\Payment\Creditcard;
use D3\Heidelpay\Models\Payment\Debitcard;
use D3\Heidelpay\Models\Payment\Directdebit;
use D3\Heidelpay\Models\Payment\Directdebit\Secured as DirectdebitSecured;
use D3\Heidelpay\Models\Payment\Easycredit;
use D3\Heidelpay\Models\Payment\Eps;
use D3\Heidelpay\Models\Payment\Exception\PaymentNotReferencedToHeidelpayException;
use D3\Heidelpay\Models\Payment\Giropay;
use D3\Heidelpay\Models\Payment\Ideal;
use D3\Heidelpay\Models\Payment\Invoice\Secured;
use D3\Heidelpay\Models\Payment\Invoice\Unsecured;
use D3\Heidelpay\Models\Payment\Masterpass;
use D3\Heidelpay\Models\Payment\Paypal;
use D3\Heidelpay\Models\Payment\Postfinance;
use D3\Heidelpay\Models\Payment\Przelewy24;
use D3\Heidelpay\Models\Payment\Sofortueberweisung;
use D3\Heidelpay\Models\Settings\Heidelpay;
use D3\Heidelpay\Models\Transactionlog\Reader\Heidelpay as ReaderHeidelpay;
use D3\Heidelpay\Models\Viewconfig;
use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\Log\d3log;
use D3\ModCfg\Application\Model\Transactionlog\d3transactionlog;
use OxidEsales\Eshop\Application\Model\Address;
use OxidEsales\Eshop\Application\Model\Basket;
use OxidEsales\Eshop\Application\Model\Country;
use OxidEsales\Eshop\Application\Model\Payment;
use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;
use OxidEsales\Eshop\Core\UtilsView;

/**
 */
class PaymentController extends PaymentController_parent
{

    /**
     * Bool-Wert fuer das Handling von vorhandenen Kreditkarten-Kunden-Registrierungsdaten in Schritt3
     *
     * @var bool
     */
    protected $sHeidelpayFieldsForPayment;

    /**
     * Initiate and register module classes
     * intitiate reference number
     * reset payment success
     *
     * @return void
     * @throws StandardException
     * @throws \D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException
     * @throws \D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function init()
    {
        parent::init();

        if (false == d3_cfg_mod::get('d3heidelpay')->isActive()) {
            d3_cfg_mod::get('d3heidelpay')->d3getLog()->log(
                d3log::INFO,
                __CLASS__,
                __FUNCTION__,
                __LINE__,
                'module is inactive',
                'module is inactive'
            );

            return;
        }

        $settings = oxNew(Heidelpay::class, d3_cfg_mod::get('d3heidelpay'));
        Registry::set(Heidelpay::class, $settings);

        /** @var Factory $oFactory */
        $oFactory         = oxNew(Factory::class, d3_cfg_mod::get('d3heidelpay'));
        $this->d3HeidelpaySetErrorMessage($oFactory);
        $oFactory->initReferenceNumber();

        $oHeidelpayViewConfig = oxNew(
            Viewconfig::class,
            d3_cfg_mod::get('d3heidelpay'),
            Registry::get(Registry::class),
            $oFactory
        );
        $this->addTplParam('oHeidelpayViewConfig', $oHeidelpayViewConfig);

        $oFactory->resetPaymentSuccess();

        $paymentId = Registry::getSession()->getBasket()->getPaymentId();
        if (empty($paymentId)) {
            return;
        }

        /** @var Payment $payment */
        $payment = oxNew(Payment::class);
        if (false == $payment->load($paymentId)) {
            return;
        }

        /** @var Heidelpay $oHeidelPaySettings */
        $oHeidelPaySettings = oxNew(
            Heidelpay::class,
            d3_cfg_mod::get('d3heidelpay')
        );

        try {
            if ($oHeidelPaySettings->isAssignedToHeidelPayment($payment)) {
                Registry::getSession()->deleteVariable('sess_challenge');
            }
        } catch (PaymentNotReferencedToHeidelpayException $exception) {
            d3_cfg_mod::get('d3heidelpay')->d3getLog()->log(
                d3log::INFO,
                __CLASS__,
                __FUNCTION__,
                __LINE__,
                'payment is not referenced to heidelpay',
                'paymentid: ' . $paymentId . PHP_EOL . 'Exception: ' . $exception->getMessage()
            );
        }
    }

    /**
     * Injects the Trusted Shops Excellence protection into the current session
     *
     * @return bool true if TSprotection is set, false if it was removed
     */
    public function setTsProtection()
    {
        $oBasket = $this->getSession()->getBasket();
        if(false == method_exists($oBasket,'setTsProductId')) {
            return false;
        }

        if (Registry::get(Request::class)->getRequestParameter('bltsprotection')) {
            $sTsProductId = Registry::get(Request::class)->getRequestParameter('stsprotection');
            $oBasket->setTsProductId($sTsProductId);
            Registry::getSession()->setVariable('stsprotection', $sTsProductId);

            return true;
        }
        Registry::getSession()->deleteVariable('stsprotection');
        $oBasket->setTsProductId(null);

        return false;
    }

    /**
     * Injects the Trusted Shops Excellence protection into the POST superglobal
     *
     * @return mixed
     * @throws StandardException
     * @throws \D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException
     * @throws \D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function validatePayment()
    {
        $oBasket = $this->getSession()->getBasket();
        if (method_exists($oBasket, 'getTsProductId') && $oBasket->getTsProductId()) {
            $_POST['bltsprotection'] = true;
            $_POST['stsprotection']  = $oBasket->getTsProductId();
        }

        $return = parent::validatePayment();

        if (empty($return) || false === stristr($return, 'order')) {
            return $return;
        }

        $paymentId = $this->getD3PaymentId();

        $payment = oxNew(Payment::class);
        $payment->load($paymentId);

        $heidelPaySettings = oxNew(Heidelpay::class, d3_cfg_mod::get('d3heidelpay'));
        if (false == $heidelPaySettings->isAssignedToHeidelPayment($payment)) {
            return $return;
        }

        $heidelPayment = $heidelPaySettings->getPayment($payment);
        if ($heidelPayment instanceof Secured
            || $heidelPayment instanceof Unsecured
            || $heidelPayment instanceof DirectdebitSecured
        ) {
            $birthdate = Registry::get(Request::class)->getRequestParameter('d3birthdate');

            if ($this->d3ValidateBirthdateInput($birthdate, $paymentId)) {
                // log message
                d3_cfg_mod::get('d3heidelpay')->d3getLog()->log(
                    d3log::WARNING,
                    __CLASS__,
                    __FUNCTION__,
                    __LINE__,
                    'birthdate is empty but required',
                    'user didn\'t set the birthdate for invoice payment. input: ' . var_export($birthdate, true)
                );
                $this->_sPaymentError = 1;

                return null;
            }

            $this->getUser()->assign(
                array('oxbirthdate' => $birthdate[$paymentId])
            );

            $this->getUser()->save();

            return $return;
        }

        if (($heidelPayment instanceof Easycredit
                || $heidelPayment instanceof Przelewy24
                || $heidelPayment instanceof Ideal
                || $heidelPayment instanceof Paypal
                || $heidelPayment instanceof DirectdebitSecured
                || $heidelPayment instanceof Secured
            ) && false == Registry::get(Request::class)->getRequestParameter('paymentid')
        ) {
            return false;
        }

        if ($heidelPayment instanceof Easycredit) {
            return $this->handleD3HeidelpayEasyCredit($paymentId);
        }

        return $return;
    }

    /**
     * Returns id of user stored payment data
     *
     * @param $sPaymentId
     *
     * @return string
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     */
    public function getUserHPStoreID($sPaymentId)
    {
        if (false == ($sUserID = $this->getSession()->getVariable("usr"))) {
            return '';
        }

        return DatabaseProvider::getDb()->getOne(
            "SELECT `oxid` FROM `d3hpuid` WHERE `oxuserid` = '$sUserID' AND `oxpaymentid` = '$sPaymentId'"
        );
    }

    /**
     * @param Payment $oPayment
     * @param string  $sTemplate
     *
     * @return string
     * @throws PaymentNotReferencedToHeidelpayException
     * @throws StandardException
     * @throws \D3\Heidelpay\Models\Settings\Exception\EmptyPaymentlistException
     * @throws \D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException
     * @throws \D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function d3GetPaymentFormTemplateName(Payment $oPayment, $sTemplate = '')
    {
        if (empty($sTemplate)) {
            $sTemplate = d3_cfg_mod::get('d3heidelpay')->getMappedThemeId();
        }

        $sTemplate = strtolower($sTemplate);

        /** @var Viewconfig $oHeidelpayViewConfig */
        $oHeidelpayViewConfig = oxNew(
            Viewconfig::class,
            d3_cfg_mod::get('d3heidelpay'),
            Registry::get(Registry::class),
            oxNew(Factory::class, d3_cfg_mod::get('d3heidelpay'))
        );
        $oHeidelPaySettings   = $oHeidelpayViewConfig->getSettings();
        $return               = $this->d3GetDefaultPaymentFormTemplateName($oPayment);
        if ($oHeidelPaySettings->isAssignedToHeidelPayment($oPayment)) {
            $oHeidelPayment = $oHeidelPaySettings->getPayment($oPayment);
            if ($oHeidelPayment instanceof Creditcard
                || $oHeidelPayment instanceof Debitcard
            ) {
                $return = "d3_heidelpay_views_{$sTemplate}_tpl_payment_cards.tpl";
            } elseif ($oHeidelPayment instanceof Directdebit
                || $oHeidelPayment instanceof DirectdebitSecured
            ) {
                $return = "d3_heidelpay_views_{$sTemplate}_tpl_payment_debitnote.tpl";
            } elseif ($oHeidelPayment instanceof Sofortueberweisung) {
                $return = "d3_heidelpay_views_{$sTemplate}_tpl_payment_sofort.tpl";
            } elseif ($oHeidelPayment instanceof Giropay) {
                $return = "d3_heidelpay_views_{$sTemplate}_tpl_payment_giropay.tpl";
            } elseif ($oHeidelPayment instanceof Ideal) {
                $return = "d3_heidelpay_views_{$sTemplate}_tpl_payment_ideal.tpl";
            } elseif ($oHeidelPayment instanceof Eps) {
                $return = "d3_heidelpay_views_{$sTemplate}_tpl_payment_eps.tpl";
            } elseif ($oHeidelPayment instanceof Billsafe) {
                $return = "d3_heidelpay_views_{$sTemplate}_tpl_payment_billsafe.tpl";
            } elseif ($oHeidelPayment instanceof Paypal) {
                $return = "d3_heidelpay_views_{$sTemplate}_tpl_payment_paypal.tpl";
            } elseif ($oHeidelPayment instanceof Postfinance) {
                $return = "d3_heidelpay_views_{$sTemplate}_tpl_payment_postfinance.tpl";
            } elseif ($oHeidelPayment instanceof Przelewy24) {
                $return = "d3_heidelpay_views_{$sTemplate}_tpl_payment_przelewy24.tpl";
            } elseif ($oHeidelPayment instanceof Masterpass) {
                $return = "d3_heidelpay_views_{$sTemplate}_tpl_payment_masterpass.tpl";
            } elseif ($oHeidelPayment instanceof Easycredit) {
                $return = "d3_heidelpay_views_{$sTemplate}_tpl_payment_easycredit.tpl";
            } elseif ($oHeidelPayment instanceof Secured
                || $oHeidelPayment instanceof Unsecured
            ) {
                $return = "d3_heidelpay_views_{$sTemplate}_tpl_payment_invoice.tpl";
            }
        }

        return $return;
    }

    /**
     * @param Payment $oPayment
     *
     * @return string
     */
    public function d3GetDefaultPaymentFormTemplateName(Payment $oPayment)
    {
        $sPaymentId = $oPayment->getId();

        if ($sPaymentId == "oxidcashondel") {
            return "page/checkout/inc/payment_oxidcashondel.tpl";
        } elseif ($sPaymentId == "oxidcreditcard") {
            return "page/checkout/inc/payment_oxidcreditcard.tpl";
        } elseif ($sPaymentId == "oxiddebitnote") {
            return "page/checkout/inc/payment_oxiddebitnote.tpl";
        } else {
            return "page/checkout/inc/payment_other.tpl";
        }
    }

    /**
     * @param Payment $oPayment
     *
     * @return bool
     * @throws PaymentNotReferencedToHeidelpayException
     * @throws StandardException
     * @throws \D3\Heidelpay\Models\Settings\Exception\EmptyPaymentlistException
     * @throws \D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException
     * @throws \D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function d3IsHeidelpayPaymentMethode(Payment $oPayment)
    {
        /** @var Viewconfig $oHeidelpayViewConfig */
        $oHeidelpayViewConfig = oxNew(
            Viewconfig::class,
            d3_cfg_mod::get('d3heidelpay'),
            Registry::get(Registry::class),
            oxNew(Factory::class, d3_cfg_mod::get('d3heidelpay'))
        );
        $oHeidelPaySettings   = $oHeidelpayViewConfig->getSettings();
        if ($oHeidelPaySettings->isAssignedToHeidelPayment($oPayment)) {
            $oHeidelPayment = $oHeidelPaySettings->getPayment($oPayment);
            if ($oHeidelPayment instanceof \D3\Heidelpay\Models\Payment\Payment) {
                return true;
            }

            return false;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function d3CheckForMobileTheme()
    {
        $blIsMobile = false;
        if (class_exists('oeThemeSwitcherThemeManager') == true) {
            /** @var oeThemeSwitcherThemeManager $oThemeManager */
            $oThemeManager = new oeThemeSwitcherThemeManager();
            $blIsMobile    = $oThemeManager->isMobileThemeRequested();
        }

        return $blIsMobile;
    }

    /**
     * @return string
     */
    public function render()
    {
        $mReturn = parent::render();

        $this->addTplParam('blD3HeidelpayEasycreditNotChecked', $this->isEasyCreditConsentNotConfirmed());
        $this->addTplParam(
            'blD3HeidelpayAllowEasyCredit',
            $this->isHeidelpayEasycreditAllowed(Registry::getSession()->getBasket())
        );
        $this->addTplParam('blD3HeidelpayAllowPostFinance', $this->isPaymentAllowedForCountryAndCurrency('CH', 'CHF'));
        $this->addTplParam('blD3HeidelpayAllowPrzelewy24', $this->isPaymentAllowedForCountryAndCurrency('PL', 'PLN'));
        $this->addTplParam('blD3HeidelpayAllowIdeal', $this->isPaymentAllowedForCountryAndCurrency('NL', 'EUR'));
        $this->addTplParam('blD3HeidelpayHasSameAdresses', $this->d3HeidelpayHasSameAdresses());

        return $mReturn;
    }

    /**
     * @param $sCountryIsoAlpha2
     * @param $sCurrencyName
     *
     * @return bool
     */
    public function isPaymentAllowedForCountryAndCurrency($sCountryIsoAlpha2, $sCurrencyName)
    {
        $sCountryId = $this->getUser()->getFieldData('oxcountryid');

        /** @var $oCountry Country * */
        $oCountry = oxNew(Country::class);
        if ($oCountry->load($sCountryId) && $oCountry->getFieldData('oxisoalpha2') == $sCountryIsoAlpha2 //
            && $this->getActCurrency()->name == $sCurrencyName
        ) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    protected function d3HeidelpayHasSameAdresses()
    {
        $oDelAdress = null;
        if (false == ($soxAddressId = Registry::get(Request::class)->getRequestParameter('deladrid'))) {
            $soxAddressId = Registry::getSession()->getVariable('deladrid');
        }
        if (false == $soxAddressId) {
            return true;
        }
        $oUser      = $this->getUser();
        $oDelAdress = oxNew(Address::class);
        $oDelAdress->load($soxAddressId);

        //get delivery country name from delivery country id
        if ($oDelAdress->oxaddress__oxcountryid->value && $oDelAdress->oxaddress__oxcountryid->value != -1) {
            $oCountry = oxNew(Country::class);
            $oCountry->load($oDelAdress->oxaddress__oxcountryid->value);
            $oDelAdress->oxaddress__oxcountry = clone $oCountry->oxcountry__oxtitle;
        }

        $userAdress = array(
            $oUser->getFieldData('oxfname'),
            $oUser->getFieldData('oxlname'),
            $oUser->getFieldData('oxcompany'),
            $oUser->getFieldData('oxstreet'),
            $oUser->getFieldData('oxstreetnr'),
            $oUser->getFieldData('oxzip'),
            $oUser->getFieldData('oxcity')
        );

        $deliverAdress = array(
            $oDelAdress->getFieldData('oxfname'),
            $oDelAdress->getFieldData('oxlname'),
            $oDelAdress->getFieldData('oxcompany'),
            $oDelAdress->getFieldData('oxstreet'),
            $oDelAdress->getFieldData('oxstreetnr'),
            $oDelAdress->getFieldData('oxzip'),
            $oDelAdress->getFieldData('oxcity')
        );


        if ($userAdress == $deliverAdress) {
            return true;
        }

        return false;
    }

    /**
     * @return string
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function d3GetMessageTemplateName()
    {
        $sTheme    = 'd3_heidelpay_views_tpl_messages.tpl';
        $sTemplate = d3_cfg_mod::get('d3heidelpay')->getMappedThemeId();

        if ($sTemplate != 'azure' && $sTemplate != 'mobile') {
            $sTheme = "d3_heidelpay_views_{$sTemplate}_tpl_messages.tpl";
        }

        return $sTheme;
    }

    /**
     * @return mixed
     */
    protected function getD3PaymentId()
    {
        $paymentId = Registry::get(Request::class)->getRequestParameter('paymentid');
        if (empty($paymentId)) {
            $paymentId = $this->getSession()->getVariable('paymentid');
        }

        return $paymentId;
    }

    /**
     * @param $birthdate
     * @param $paymentId
     *
     * @return bool
     */
    protected function d3ValidateBirthdateInput($birthdate, $paymentId)
    {
        return empty($birthdate)
            || empty($birthdate[$paymentId])
            || empty($birthdate[$paymentId]['day'])
            || empty($birthdate[$paymentId]['month'])
            || empty($birthdate[$paymentId]['year']);
    }

    /**
     * @return bool
     */
    protected function isEasyCreditConsentNotConfirmed()
    {
        return (bool)Registry::get(Request::class)->getRequestParameter('d3heidelpayeasycreditnotchecked');
    }

    /**
     * @param $paymentId
     *
     * @return string
     * @throws StandardException
     * @throws \D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException
     * @throws \D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    protected function handleD3HeidelpayEasyCredit($paymentId)
    {
        $easycreditTransactionIds = Registry::get(Request::class)->getRequestParameter(
            'd3heidelpayEasycreditTransactionLogid'
        );

        if (false == is_array($easycreditTransactionIds) || empty($easycreditTransactionIds[$paymentId])) {
            return 'payment?d3heidelpayeasycreditnotchecked=1';
        }

        $transactionlog = oxNew(d3transactionlog::class, oxNew(ReaderHeidelpay::class));
        if (false == $transactionlog->load($easycreditTransactionIds[$paymentId])) {
            d3_cfg_mod::get('d3heidelpay')->d3getLog()->log(
                d3log::ERROR,
                __CLASS__,
                __FUNCTION__,
                __LINE__,
                'could not load d3transactionlog',
                'd3transactionlogid: ' . var_export($easycreditTransactionIds[$paymentId], true)
            );

            return 'payment?paymenterror=-99';
        }

        /** @var ReaderHeidelpay $response */
        $response    = $transactionlog->getTransactiondata();
        $redirectUrl = $response->getRedirecturl();

        if (empty($redirectUrl)) {
            d3_cfg_mod::get('d3heidelpay')->d3getLog()->log(
                d3log::ERROR,
                __CLASS__,
                __FUNCTION__,
                __LINE__,
                'redirect url is empty:' . $redirectUrl,
                var_export($response, true)
            );

            return 'payment?paymenterror=-99';
        }

        d3_cfg_mod::get('d3heidelpay')->d3getLog()->log(
            d3log::INFO,
            __CLASS__,
            __FUNCTION__,
            __LINE__,
            'redirect customer to url:' . $redirectUrl,
            $redirectUrl
        );
        Registry::getConfig()->pageClose();
        Registry::getUtils()->redirect($redirectUrl, false, 302);

        return '';
    }

    /**
     * @param Basket $oxBasket
     *
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function isHeidelpayEasycreditAllowed(Basket $oxBasket)
    {
        if (false == $this->isPaymentAllowedForCountryAndCurrency('DE', 'EUR')) {
            return false;
        }

        /** @var Easycredit $easyCreditPayment */
        $easyCreditPayment = oxNew(Easycredit::class);
        $oxPrice  = $oxBasket->getPrice();
        $price    = $oxPrice->getPrice();
        $minPrice          = $easyCreditPayment->getMinimumLimit();
        $maxPrice          = $easyCreditPayment->getMaximumLimit();

        if (false == ($price >= $minPrice && $maxPrice >= $price)) {
            return false;
        }

        $basketUser = $oxBasket->getBasketUser();
        $possiblePSFields = array('oxfname', 'oxlname', 'oxstreet', 'oxstreetnr', 'oxcity');

        foreach ($possiblePSFields as $field) {
            if (false === stristr(strtolower($basketUser->getFieldData($field)), 'packstation')) {
                continue;
            }

            return false;
        }

        return true;
    }

    /**
     * @param Factory $oFactory
     *
     * @throws StandardException
     * @throws \D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException
     * @throws \D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    protected function d3HeidelpaySetErrorMessage(Factory $oFactory)
    {
        $oldReference = $oFactory->getReferenceNumber();
        if ($oldReference) {
            $oTransAction = $oFactory->getLatestTransactionByReference($oldReference);
            if ($oTransAction instanceof d3transactionlog) {
                /** @var ReaderHeidelpay $reader */
                $reader = $oTransAction->getTransactiondata();
                if ($reader->getResult() === "NOK" && $reader->getReturncode()) {
                    $string      = 'd3heidelpay_' . $reader->getReturncode();
                    $translation = Registry::getLang()->translateString($string);

                    if ($translation === $string) {
                        d3_cfg_mod::get('d3heidelpay')->d3getLog()->log(
                            d3log::ERROR,
                            __CLASS__,
                            __FUNCTION__,
                            __LINE__,
                            'Translation not found: ' . $string,
                            $string
                        );
                        $translation = Registry::getLang()->translateString('d3heidelpay_execute_error');
                    }

                    $exception = oxNew(StandardException::class, $translation);
                    Registry::get(UtilsView::class)->addErrorToDisplay($exception);
                }
            }
        }
    }
}
