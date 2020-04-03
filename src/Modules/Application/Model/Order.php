<?php

namespace D3\Heidelpay\Modules\Application\Model;

use D3\Heidelpay\Models\Containers\Criterions;
use D3\Heidelpay\Models\Containers\PrepaymentData;
use D3\Heidelpay\Models\Factory;
use D3\Heidelpay\Models\Mail;
use D3\Heidelpay\Models\Payment\Btobbillpurchase;
use D3\Heidelpay\Models\Payment\Easycredit;
use D3\Heidelpay\Models\Payment\Exception\PaymentNotReferencedToHeidelpayException;
use D3\Heidelpay\Models\Payment\Invoice\Secured;
use D3\Heidelpay\Models\Payment\Invoice\Unsecured;
use D3\Heidelpay\Models\Payment\Payment;
use D3\Heidelpay\Models\Payment\Prepayment;
use D3\Heidelpay\Models\Response\Parser;
use D3\Heidelpay\Models\Transactionlog\Reader\Heidelpay as TransactionlogReader;
use D3\Heidelpay\Models\Viewconfig;
use D3\Heidelpay\Modules\Application\Controller\PaymentController as HPPaymentController;
use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use D3\ModCfg\Application\Model\Log\d3log;
use D3\ModCfg\Application\Model\Transactionlog\d3transactionlog;
use Doctrine\DBAL\DBALException;
use Exception;
use oxArticleInputException;
use OxidEsales\Eshop\Application\Controller\PaymentController;
use OxidEsales\Eshop\Application\Model\Article;
use OxidEsales\Eshop\Application\Model\Basket;
use OxidEsales\Eshop\Application\Model\Payment as OxidPayment;
use OxidEsales\Eshop\Application\Model\User;
use OxidEsales\Eshop\Application\Model\Voucher;
use OxidEsales\Eshop\Core\Counter;
use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\Email;
use OxidEsales\Eshop\Core\Exception\ArticleException;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Exception\SystemComponentException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\UtilsObject;
use oxNoArticleException;
use stdClass;

/**
 */
class Order extends Order_parent
{

    /**
     * Returns bank transfer data if available
     *
     * @return stdClass|false
     * @throws PaymentNotReferencedToHeidelpayException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     */
    public function getHeidelpayBankTransferData()
    {
        if (false == d3_cfg_mod::get('d3heidelpay')->isActive()) {
            return false;
        }
        /** @var Factory $factory */
        $factory   = oxNew(Factory::class, d3_cfg_mod::get('d3heidelpay'));
        /** @var OxidPayment $payment */
        $payment  = oxNew(OxidPayment::class);
        $payment->load($this->getFieldData('oxpaymenttype'));
        if (false == $factory->getChannelProvider()->isOxPaymentIdAssignedToChannel($payment->getId())) {
            return false;
        }

        $settings       = $factory->getSettings();
        $oHeidelpayment = $settings->getPayment($payment);

        if (
            $oHeidelpayment instanceof Prepayment
            || $oHeidelpayment instanceof Secured
            || $oHeidelpayment instanceof Unsecured
            || $oHeidelpayment instanceof Btobbillpurchase
        ) {
            /** @var PrepaymentData $oPrePaymentData */
            $oPrePaymentData = oxNew(PrepaymentData::class);

            return $oPrePaymentData->getBankTransferData($this, $oHeidelpayment->getPaymentCode() . '.PA');
        }

        return false;
    }

    /**
     * @return null
     * @throws PaymentNotReferencedToHeidelpayException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     */
    public function getHeidelpayEasyCreditInformations()
    {
        /** @var Factory $factory */
        $factory   = oxNew(Factory::class, d3_cfg_mod::get('d3heidelpay'));
        /** @var OxidPayment $payment */
        $payment = oxNew(OxidPayment::class);
        $payment->load($this->getFieldData('oxpaymenttype'));
        if (false == $factory->getChannelProvider()->isOxPaymentIdAssignedToChannel($payment->getId())) {
            return null;
        }

        $settings = $factory->getSettings();
        $heidelpayment = $settings->getPayment($payment);

        if ($heidelpayment instanceof Easycredit) {
            /** @var d3transactionlog $transaction */
            $transaction = $factory->getLatestTransactionByObject($this);

            if (false === ($transaction instanceof d3transactionlog)) {
                return null;
            }

            /** @var TransactionlogReader $reader */
            /** @var Criterions $criterionContainer */
            $reader             = $transaction->getTransactiondata();
            $criterionContainer = oxNew(Criterions::class, oxNew(Criterions\Easycredit::class));

            return $criterionContainer->getSelectedCriterions($reader->getCriterionTags());
        }

        return null;
    }

    /**
     * @param Basket $oBasket
     * @param User   $oUser
     *
     * @return int|null
     * @throws DBALException
     * @throws Exception
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function d3CreateTemporaryOrder(Basket $oBasket, User $oUser)
    {
        /* D3 START disabled - 03.03.2016 - KH <!--
        We can't use the session challenge for this break up.
        We need every "hotfix"- payment->toOrder a new order

        $sGetChallenge = Registry::getSession()->getVariable('sess_challenge');
        if ($this->_checkOrderExist($sGetChallenge)) {
            Registry::getUtils()->logger('BLOCKER');
            // we might use this later, this means that somebody clicked like mad on order button
            return self::ORDER_STATE_ORDEREXISTS;
        }

        // if not recalculating order, use sess_challenge id, else leave old order id

        // use this ID
        $this->setId($sGetChallenge);
        --> */

        $this->setId(Registry::get(UtilsObject::class)->generateUId());

        // validating various order/basket parameters before finalizing
        $iOrderState = $this->validateOrder($oBasket, $oUser);
        if ($iOrderState) {
            return $iOrderState;
        }

        // copies user info
        $this->_setUser($oUser);

        // copies basket info
        $this->_loadFromBasket($oBasket);

        // payment information
        $this->_setPayment($oBasket->getPaymentId());

        // set folder information, if order is new
        // #M575 in recalculating order case folder must be the same as it was

        $this->_setFolder();

        //#4005: Order creation time is not updated when order processing is complete
        $this->_updateOrderDate();

        // marking as not finished
        $this->_setOrderStatus('PENDING');

        $aVouchers = $oBasket->getVouchers();
        $moduleConfig = d3_cfg_mod::get('d3heidelpay');
        /** @var Factory $factory */
        $factory = oxNew(Factory::class, $moduleConfig);
        if (count($aVouchers)) {
            $aVoucherIds  = array();
            $pendingLimit = $factory->getModuleProvider()->getPaymentCollectorOrderPendingTime();
            foreach ($aVouchers as $sVoucherId => $oStdVoucher) {
                /** @var Voucher $oVoucher */
                $oVoucher = oxNew(Voucher::class);
                if ($oVoucher->load($oStdVoucher->sVoucherId)) {
                    $aVoucherIds[$oStdVoucher->sVoucherId] = $oStdVoucher->sVoucherId;
                    $oVoucher->assign(array('oxreserved' => time() + $pendingLimit * 3600));
                    $oVoucher->save();
                }
            }
            $this->assign(array('d3heidelpayvouchers' => implode('|', $aVoucherIds)));
        }

        //saving all order data to DB
        $this->save();

        if (false == $factory->getModuleProvider()->isUsingZeroOrderNumber() && false == $this->oxorder__oxordernr->value) {
            $this->_setNumber();
        }

        // set order ID for thankyou
        $oBasket->setOrderId($this->getId());
        Registry::getSession()->setVariable('sess_challenge', $this->getId());

        return null;
    }

    /**
     * @param string $sStatus
     *
     * @return void
     * @throws PaymentNotReferencedToHeidelpayException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     */
    protected function _setOrderStatus($sStatus)
    {
        if (false == d3_cfg_mod::get('d3heidelpay')->isActive()) {
            parent::_setOrderStatus($sStatus);

            return;
        }

        $oDB = DatabaseProvider::getDb();

        $sOldStatus = $oDB->getOne('select oxtransstatus from oxorder where oxid="' . $this->getId() . '"');
        $sPaid      = $oDB->getOne('select oxpaid from oxorder where oxid="' . $this->getId() . '"');
        $sPaymentId = $this->getFieldData('OXPAYMENTTYPE');

        /** @var Factory $factory */
        $factory   = oxNew(Factory::class, d3_cfg_mod::get('d3heidelpay'));

        /** @var OxidPayment $payment */
        $payment = oxNew(OxidPayment::class);
        $payment->load($sPaymentId);

        if (false == $factory->getChannelProvider()->isOxPaymentIdAssignedToChannel($payment->getId())) {
            parent::_setOrderStatus($sStatus);

            return;
        }

        $settings       = $factory->getSettings();
        $blIsPrepayment = $settings->getPayment($payment) instanceof Prepayment;
        $blIsWaiting    = $sOldStatus == 'PENDING' && $sPaid == '0000-00-00 00:00:00';
        if ($blIsPrepayment && $blIsWaiting) {
            $sStatus = "PENDING";
        }

        parent::_setOrderStatus($sStatus);
    }

    /**
     * @param Basket $oBasket
     * @param User   $oUser
     *
     * @return bool|int
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws Exception
     */
    public function d3FinalizeTemporaryOrder(Basket $oBasket, User $oUser)
    {
        $registry           = Registry::get(Registry::class);
        $modulConfiguration = d3_cfg_mod::get('d3heidelpay');

        $oUserPayment = $this->_setPayment($oBasket->getPaymentId());
        // executing payment (on failure deletes order and returns error code)
        // in case when recalculating order, payment execution is skipped

        $blRet = $this->_executePayment($oBasket, $oUserPayment);
        if ($blRet !== true) {
            return $blRet;
        }

        if (!$this->oxorder__oxordernr->value) {
            $this->_setNumber();
        } else {
            /** @var Counter $counter */
            $counter = oxNew(Counter::class);
            $counter->update($this->_getCounterIdent(), $this->oxorder__oxordernr->value);
        }

        // deleting remark info only when order is finished
        Registry::getSession()->deleteVariable('ordrem');

        //#4005: Order creation time is not updated when order processing is complete
        //$this->_updateOrderDate();

        // updating order trans status (success status)
        $this->_setOrderStatus('OK');

        // store orderid
        $oBasket->setOrderId($this->getId());

        // updating wish lists
        $this->_updateWishlist($oBasket->getContents(), $oUser);

        // updating users notice list
        $this->_updateNoticeList($oBasket->getContents(), $oUser);

        // marking vouchers as used and sets them to $this->_aVoucherList (will be used in order email)
        // skipping this action in case of order recalculation
        $this->_markVouchers($oBasket, $oUser);

        // send order by email to shop owner and current user
        // skipping this action in case of order recalculation
        $iRet = $this->_sendOrderByEmail($oUser, $oBasket, $oUserPayment);

        // the negative case shouldn't be possible
        $this->d3VerifyBasketSameAmount($oBasket, $modulConfiguration, $registry);

        return $iRet;
    }

    /**
     * TODO: outsource this in a own model
     *
     * @param Basket     $oxBasket
     * @param d3_cfg_mod $modulConfiguration
     * @param Registry   $registry
     *
     * @return null
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     */
    protected function d3VerifyBasketSameAmount(Basket $oxBasket, d3_cfg_mod $modulConfiguration, Registry $registry)
    {
        $transaction = $this->d3GetLastHeidelpayTransaction($oxBasket, $modulConfiguration);

        if (is_null($transaction)) {
            return null;
        }

        /** @var TransactionlogReader $reader */
        $reader = $transaction->getTransactiondata();
        $amount = $reader->getAmount();
        if ($amount !== $this->getTotalOrderSum()) {

            /** @var Factory $factory */
            $factory = oxNew(Factory::class, $modulConfiguration);

            $transStatusError = $factory->getModuleProvider()->getOxTransStatusErrorState();
            if (empty($transStatusError)) {
                $transStatusError = 'ERROR';
            }
            $this->setD3HPTransactionStatusError($transStatusError);
            $this->d3SendHPErrorMessage($modulConfiguration, $registry, $reader, $this->getTotalOrderSum());
        }

        return null;
    }

    /**
     * @param Basket     $oxBasket
     * @param d3_cfg_mod $modulConfiguration
     *
     * @return d3transactionlog|null |null
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     */
    protected function d3GetLastHeidelpayTransaction(Basket $oxBasket, d3_cfg_mod $modulConfiguration)
    {
        /** @var OxidPayment $oPayment */
        $oPayment = oxNew(OxidPayment::class);
        $oPayment->load($oxBasket->getPaymentId());

        /** @var Factory $factory */
        $factory = oxNew(Factory::class, $modulConfiguration);

        try {
            /** @var Payment $heidelPayment */
            $heidelPayment = $factory->getSettings()->getPayment($oPayment);
        } catch (PaymentNotReferencedToHeidelpayException $oEx) {
            return null;
        }

        if (false == $heidelPayment instanceof Payment) {
            return null;
        }

        $refrenceNumber = $factory->getReferenceNumber();
        if (empty($refrenceNumber)) {
            $modulConfiguration->d3getLog()->log(
                d3log::ERROR,
                __CLASS__,
                __FUNCTION__,
                __LINE__,
                "no reference but heidelpay payment! payment is: " . var_export($heidelPayment, true)
            );

            return null;
        }

        $transaction = $factory->getLatestTransactionByReference($refrenceNumber);

        if (false == $transaction) {
            $modulConfiguration->d3getLog()->log(
                d3log::WARNING,
                __CLASS__,
                __FUNCTION__,
                __LINE__,
                'no transaction found but heidelpay payment and referencenumber',
                $refrenceNumber
            );

            return null;
        }

        return $transaction;
    }

    /**
     * @param      $transStatusError
     * @param bool $resetPaidDate
     */
    public function setD3HPTransactionStatusError($transStatusError, $resetPaidDate = true)
    {
        $aAssignment                  = array();
        $aAssignment['oxtransstatus'] = $transStatusError;
        if ($resetPaidDate) {
            $aAssignment['oxpaid'] = '0000-00-00 00:00:00';
        }
        $this->assign($aAssignment);
        $this->save();
    }

    /**
     *  TODO refactor into separate class
     *
     * @param d3_cfg_mod                                           $modulConfiguration
     * @param Registry                                             $registry
     * @param TransactionlogReader                                 $reader
     * @param                                                      $basketAmount
     *
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     */
    public function d3SendHPErrorMessage(d3_cfg_mod $modulConfiguration, Registry $registry, TransactionlogReader $reader, $basketAmount)
    {
        $text    = $registry->getLang()->translateString(
            'D3HEIDELPAY_DIFFERENCE_IN_ORDER_ERRRORMESSAGE',
            Registry::getLang()->getBaseLanguage(),
            true
        );
        $message = sprintf($text, $this->getFieldData('oxordernr'), $reader->getUniqueid(), $reader->getAmount(), $basketAmount);

        $subject = $registry->getLang()->translateString(
            'D3HEIDELPAY_DIFFERENCE_IN_ORDER_SUBJECT',
            Registry::getLang()->getBaseLanguage(),
            true
        );
        $subject .= $this->getFieldData('oxordernr');

        /** @var Factory $factory */
        $factory = oxNew(Factory::class, $modulConfiguration);

        /** @var Mail $email */
        $email = oxNew(Mail::class, oxNew(Email::class), $modulConfiguration, $this->getConfig()->getActiveShop());
        $email->setSubject($subject)->setMessage($message)->sendMail($factory);
    }

    /**
     * @return Basket
     * @throws ArticleException
     * @throws oxArticleInputException
     * @throws oxNoArticleException
     * @throws SystemComponentException
     */
    public function d3GetOrderBasket()
    {
        $this->reloadDelivery(false);
        $this->reloadDiscount(false);
        $oBasket = $this->_getOrderBasket(false);

        foreach ($this->getOrderArticles() as $oOrderArticle) {
            $oBasket->addOrderArticleToBasket($oOrderArticle);
        }

        /* D3 START added - #4998 - 29.04.2016 - KH */
        $aVouchers = explode('|', $this->getFieldData('d3heidelpayvouchers'));
        if (count($aVouchers)) {
            $oBasket->setSkipVouchersChecking(true);
            foreach ($aVouchers as $sVoucherId) {
                $oVoucher = oxNew(Voucher::class);
                if ($oVoucher->load($sVoucherId)) {
                    $oBasket->addVoucher($sVoucherId);
                }
            }
        }
        /* D3 END   added - #4998 - 29.04.2016 - KH */

        //$oBasket->setVoucherDiscount($this->oxorder__oxvoucherdiscount->value);
        $oBasket->calculateBasket();

        foreach ($oBasket->getContents() as $oBasketItem) {
            /** @var BasketItem $oBasketItem */
            /** @var Article $oArticle */
            $oArticle = oxNew(Article::class);
            $oArticle->loadInLang($this->oxorder__oxlang->value, $oBasketItem->getArticle()->getProductId());
            $oBasketItem->d3SetArticle($oArticle);
        }

        return $oBasket;
    }

    /**
     * @param Basket $oxBasket
     * @param object $oxUser
     * @param bool   $blRecalculatingOrder
     *
     * @return int
     * @throws d3_cfg_mod_exception
     * @throws Exception
     */
    public function finalizeOrder(Basket $oxBasket, $oxUser, $blRecalculatingOrder = false)
    {
        try {
            $paymentId = $oxBasket->getPaymentId();
            $payment = oxNew( OxidPayment::class);
            $payment->load($paymentId);

            /** @var Factory $factory */
            $factory              = oxNew(Factory::class, d3_cfg_mod::get('d3heidelpay'));
            /** @var Viewconfig $heidelpayViewConfig */
            $heidelpayViewConfig = oxNew(
                Viewconfig::class,
                d3_cfg_mod::get('d3heidelpay'),
                Registry::get(Registry::class),
                $factory
            );
            $settings = $heidelpayViewConfig->getSettings();

            $heidelPayment = $settings->getPayment($payment);

            if ($heidelPayment instanceof Secured) {
                /** @var HPPaymentController $paymentController */
                $paymentController = oxNew(PaymentController::class);
                if (false == $paymentController->isHeidelpayInvoiceSecuredAllowed($oxBasket)) {
                    return self::ORDER_STATE_PAYMENTERROR;
                }
            }
        } catch (PaymentNotReferencedToHeidelpayException $e) {
            // ignore exception, because it's handled already before
        }


        $return             = parent::finalizeOrder($oxBasket, $oxUser, $blRecalculatingOrder);
        $registry           = Registry::get(Registry::class);
        $modulConfiguration = d3_cfg_mod::get('d3heidelpay');

        if (false == $modulConfiguration->isActive() || $registry->getConfig()->isAdmin()) {
            return $return;
        }

        $this->d3VerifyBasketSameAmount($oxBasket, $modulConfiguration, $registry);
        $this->d3SetWaitingState($oxBasket, $modulConfiguration, $registry);

        return $return;
    }

    /**
     * @param Basket   $basket
     * @param          $modulConfiguration
     * @param Registry $registry
     *
     * @return null
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     */
    protected function d3SetWaitingState(Basket $basket, $modulConfiguration, Registry $registry)
    {
        $transaction = $this->d3GetLastHeidelpayTransaction($basket, $modulConfiguration);
        if (false  == ($transaction instanceof d3transactionlog)) {
            return null;
        }

        /** @var Parser $oParser */
        $oParser = oxNew(
            Parser::class,
            $modulConfiguration,
            $registry,
            $transaction->getTransactiondata()
        );

        if ('OK' !== $this->getFieldData('oxtransstatus') || false === $oParser->isWaiting()) {
            return null;
        }

        $this->setD3HPTransactionStatusError('PENDING', true);

        return null;
    }
}
