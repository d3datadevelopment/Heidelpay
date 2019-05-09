<?php

namespace D3\Heidelpay\Modules\Application\Controller;

use D3\Heidelpay\Models\Factory;
use D3\Heidelpay\Models\Parameter\Group\CompanyData;
use D3\Heidelpay\Models\Payment\Btobbillpurchase;
use D3\Heidelpay\Models\Payment\Directdebit\Secured as DirectdebitSecured;
use D3\Heidelpay\Models\Payment\Easycredit;
use D3\Heidelpay\Models\Payment\Exception\PaymentNotReferencedToHeidelpayException;
use D3\Heidelpay\Models\Payment\Ideal;
use D3\Heidelpay\Models\Payment\Invoice\Secured;
use D3\Heidelpay\Models\Payment\Invoice\Unsecured;
use D3\Heidelpay\Models\Payment\Payment as HeidelpayAbstractPayment;
use D3\Heidelpay\Models\Payment\Paypal;
use D3\Heidelpay\Models\Payment\Przelewy24;
use D3\Heidelpay\Models\Settings\Exception\EmptyPaymentlistException;
use D3\Heidelpay\Models\Settings\Heidelpay;
use D3\Heidelpay\Models\Transactionlog\Reader\Heidelpay as ReaderHeidelpay;
use D3\Heidelpay\Models\Viewconfig;
use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use D3\ModCfg\Application\Model\Log\d3log;
use D3\ModCfg\Application\Model\Transactionlog\d3transactionlog;
use Doctrine\DBAL\DBALException;
use OxidEsales\Eshop\Application\Model\Address;
use OxidEsales\Eshop\Application\Model\Basket;
use OxidEsales\Eshop\Application\Model\Country;
use OxidEsales\Eshop\Application\Model\Payment;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
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
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
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
        $oFactory = oxNew(Factory::class, d3_cfg_mod::get('d3heidelpay'));
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

        if ($oHeidelPaySettings->isAssignedToHeidelPayment($payment)) {
            Registry::getSession()->deleteVariable('sess_challenge');
        }
    }

    /**
     * @param Factory $oFactory
     *
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
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

    /**
     * Injects the Trusted Shops Excellence protection into the POST superglobal
     *
     * @return mixed
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function validatePayment()
    {
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

            if ($this->d3HasInvalidBirthdateInput($birthdate, $paymentId)) {
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

        if ($heidelPayment instanceof Btobbillpurchase) {
            return $this->handleD3HeidelpayBtobbillpurchase($paymentId);
        }

        return $return;
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
    protected function d3HasInvalidBirthdateInput($birthdate, $paymentId)
    {
        return empty($birthdate)
            || empty($birthdate[$paymentId])
            || empty($birthdate[$paymentId]['day'])
            || empty($birthdate[$paymentId]['month'])
            || empty($birthdate[$paymentId]['year']);
    }

    /**
     * @param $paymentId
     *
     * @return string
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
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
     * @param Payment $oPayment
     * @param string  $mappedThemeId
     *
     * @return string
     * @throws PaymentNotReferencedToHeidelpayException
     * @throws StandardException
     * @throws EmptyPaymentlistException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function d3GetPaymentFormTemplateName(Payment $oPayment, $mappedThemeId = '')
    {
        if (empty($mappedThemeId)) {
            $mappedThemeId = d3_cfg_mod::get('d3heidelpay')->getMappedThemeId();
        }

        $mappedThemeId = strtolower($mappedThemeId);

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
            $heidelpayPayment = $oHeidelPaySettings->getPayment($oPayment);
            $result           = $heidelpayPayment->getTemplateName($mappedThemeId);
            if (false == empty($result)) {
                return $result;
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
     * @throws EmptyPaymentlistException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
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

            return $oHeidelPayment instanceof HeidelpayAbstractPayment;
        }

        return false;
    }

    /**
     * @return string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function render()
    {
        $mReturn = parent::render();

        $this->addTplParam('blD3HeidelpayEasycreditNotChecked', $this->isEasyCreditConsentNotConfirmed());
        $this->addTplParam(
            'blD3HeidelpayAllowEasyCredit',
            $this->isHeidelpayEasycreditAllowed(Registry::getSession()->getBasket())
        );
        $basket = Registry::getSession()->getBasket();

        $blD3HeidelpayAllowBtoBBillPurchase = $this->isHeidelpayBtoBBillPurchaseAllowed($basket);

        $this->addTplParam('blD3HeidelpayAllowBtoBBillPurchase', $blD3HeidelpayAllowBtoBBillPurchase);
        $this->addTplParam('blD3HeidelpayAllowPostFinance', $this->isPaymentAllowedForCountryAndCurrency('CH', 'CHF'));
        $this->addTplParam('blD3HeidelpayAllowPrzelewy24', $this->isPaymentAllowedForCountryAndCurrency('PL', 'PLN'));
        $this->addTplParam('blD3HeidelpayAllowIdeal', $this->isPaymentAllowedForCountryAndCurrency('NL', 'EUR'));
        $this->addTplParam('blD3HeidelpayHasSameAdresses', $this->d3HeidelpayHasSameAdresses());
        $this->addTplParam(
            'blD3HeidelpayAllowInvoiceSecured',
            $this->isHeidelpayInvoiceSecuredAllowed(Registry::getSession()->getBasket())
        );
        $this->addTplParam(
            'd3HeidelpayParameters',
            $this->getSession()->getVariable('d3HeidelpayParameters')
        );

        $this->addHeidelpayFormularParameter();

        return $mReturn;
    }

    /**
     * @return bool
     */
    protected function isEasyCreditConsentNotConfirmed()
    {
        return (bool)Registry::get(Request::class)->getRequestParameter('d3heidelpayeasycreditnotchecked');
    }

    /**
     * @param Basket $oxBasket
     *
     * @return bool
     */
    public function isHeidelpayEasycreditAllowed(Basket $oxBasket)
    {
        if (false == $this->isPaymentAllowedForCountryAndCurrency('DE', 'EUR')) {
            return false;
        }

        /** @var Easycredit $easyCreditPayment */
        $easyCreditPayment = oxNew(Easycredit::class);

        if (false == $this->isHeidelpayBasketAmountInLimits($oxBasket, $easyCreditPayment)) {
            return false;
        }

        $basketUser       = $oxBasket->getBasketUser();
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
     * @param Basket $oxBasket
     *
     * @return bool
     */
    public function isHeidelpayInvoiceSecuredAllowed(Basket $oxBasket)
    {
        if (false == $this->d3HeidelpayHasSameAdresses()) {
            return false;
        }

        /** @var Secured $InvoicePayment */
        $InvoicePayment = oxNew(Secured::class);

        return $this->isHeidelpayBasketAmountInLimits($oxBasket, $InvoicePayment);
    }

    /**
     * @return string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function d3GetMessageTemplateName()
    {
        $sTemplate = d3_cfg_mod::get('d3heidelpay')->getMappedThemeId();

        return "d3_heidelpay_views_{$sTemplate}_tpl_messages.tpl";
    }

    /**
     * @throws DBALException
     */
    protected function addHeidelpayFormularParameter()
    {
        $d3hpPaymentFormulars = [];

        $paymentList = $this->getPaymentList();

        $settings = Registry::get(Heidelpay::class);
        try {
            foreach ($paymentList as $paymentId => $payment) {
                /** @var $payment Payment */
                if ($settings->isAssignedToHeidelPayment($payment)) {
                    $d3hpPaymentFormulars[$paymentId] = $settings->getPayment($payment)->getFormularParameter();
                }
            }
        } catch (StandardException $exception) {
        }

        $this->addTplParam('d3hpPaymentFormulars', $d3hpPaymentFormulars);
    }

    /**
     * @param $paymentId
     *
     * @return bool
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    protected function handleD3HeidelpayBtobbillpurchase($paymentId)
    {
        /** @var Request $request */
        $request             = oxNew(Request::class);
        $heidelpayParameters = $request->getRequestParameter('d3heidelpay');
        if (false == isset($heidelpayParameters[$paymentId])) {
            // fehlende Parameter
            return false;
        }

        $birthdateParameters = [$paymentId => $heidelpayParameters[$paymentId]['COMPANY.EXECUTIVE.1.BIRTHDATE']];
        if (strtolower(CompanyData::REGISTERED) !== strtolower($heidelpayParameters[$paymentId]['COMPANY.REGISTRATIONTYPE'])
            && $this->d3HasInvalidBirthdateInput($birthdateParameters, $paymentId)) {
            d3_cfg_mod::get('d3heidelpay')->d3getLog()->log(
                d3log::WARNING,
                __CLASS__,
                __FUNCTION__,
                __LINE__,
                'birthdate is empty but required',
                'user didn\'t set the birthdate for payment. input: '.var_export($birthdateParameters[$paymentId], true)
            );
            $this->_sPaymentError = 1;

            return false;
        }

        //write data in Session
        $this->getSession()->setVariable('d3HeidelpayParameters', $heidelpayParameters);

        return 'order';
    }

    /**
     * @param Basket                   $oxBasket
     * @param HeidelpayAbstractPayment $payment
     *
     * @return bool
     */
    protected function isHeidelpayBasketAmountInLimits(Basket $oxBasket, HeidelpayAbstractPayment $payment)
    {
        $oxPrice  = $oxBasket->getPrice();
        $price    = $oxPrice->getPrice();
        $minPrice = $payment->getMinimumLimit();
        $maxPrice = $payment->getMaximumLimit();

        if (false == ($price >= $minPrice && $maxPrice >= $price)) {
            return false;
        }

        return true;
}

    /**
     * @param Basket $basket
     *
     * @return bool
     */
    protected function isHeidelpayBtoBBillPurchaseAllowed(Basket $basket)
    {
        $isInGermanyAllowed = $this->isPaymentAllowedForCountryAndCurrency('DE', $basket->getBasketCurrency()->name);
        $isInAustriaAllowed = $this->isPaymentAllowedForCountryAndCurrency('AT', $basket->getBasketCurrency()->name);
        $bToBBillPurchase = oxNew(Btobbillpurchase::class);

        return ($isInGermanyAllowed || $isInAustriaAllowed) && $this->isHeidelpayBasketAmountInLimits($basket, $bToBBillPurchase);
}
}
