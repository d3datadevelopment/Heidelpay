<?php

namespace D3\Heidelpay\Modules\Application\Model;

use D3\Heidelpay\Controllers\PaymentGateway as ControllerPaymentGateway;
use D3\Heidelpay\Models\Factory;
use D3\Heidelpay\Models\Response\Parser;
use D3\Heidelpay\Models\Settings\Exception\EmptyPaymentlistException;
use D3\Heidelpay\Models\Transactionlog\Reader\Heidelpay;
use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use D3\ModCfg\Application\Model\Log\d3log;
use D3\ModCfg\Application\Model\Transactionlog\d3transactionlog;
use Doctrine\DBAL\DBALException;
use OxidEsales\Eshop\Application\Model\Payment;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\DatabaseException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Registry;

/**
 */
class PaymentGateway extends PaymentGateway_parent
{

    /**
     * executes heidelpay paymentgateway
     *
     * @param float  $dAmount
     * @param object $oOrder
     *
     * @return bool|int|string
     * @throws EmptyPaymentlistException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws DatabaseException
     * @throws StandardException
     */
    public function executePayment($dAmount, &$oOrder)
    {
        /** @var Factory $oFactory */
        $oFactory = oxNew(Factory::class, d3_cfg_mod::get('d3heidelpay'));
        /** @var ControllerPaymentGateway $oGatewayFacade */
        $oGatewayFacade = oxNew(
            ControllerPaymentGateway::class,
            d3_cfg_mod::get('d3heidelpay'),
            Registry::get(Registry::class),
            $oOrder,
            $oFactory
        );

        $oTransAction = $oFactory->getLatestTransactionByReference($oFactory->getReferenceNumber());

        if (false == $oTransAction) {
            /** @var d3transactionlog $oTransAction */
            $oTransAction = oxNew(
                d3transactionlog::class,
                oxNew(Heidelpay::class),
                $oFactory->getReferenceNumber()
            );
            $oTransAction->setTransactiondata('<?xml version="1.0" encoding="UTF-8" standalone="yes"?><response/>');
        }

        /** @var Parser $oParser */
        $oParser = oxNew(
            Parser::class,
            d3_cfg_mod::get('d3heidelpay'),
            Registry::get(Registry::class),
            $oTransAction->getTransactiondata()
        );

        $mReturn = $oGatewayFacade->executePayment($this->getPayment(), $oParser);

        d3_cfg_mod::get('d3heidelpay')->d3getLog()->log(
            d3log::INFO,
            __CLASS__,
            __FUNCTION__,
            __LINE__,
            'paymentgateway return value',
            print_r(var_export($mReturn, true), true)
        );

        if (ControllerPaymentGateway::CALLPARENT === $mReturn) {
            return parent::executePayment($dAmount, $oOrder);
        }

        //payment successful
        if (true === $mReturn) {
            return $mReturn;
        }

        //wrong result -> got error / message
        $this->_iLastErrorNo = $mReturn;

        return false;
    }

    /**
     * Load and returns oxPayment object.
     *
     * @return Payment
     */
    public function getPayment()
    {
        /** @var Payment $oPayment */
        $oPayment = oxNew(Payment::class);
        $oPayment->load($this->_oPaymentInfo->oxuserpayments__oxpaymentsid->value);

        return $oPayment;
    }
}
