<?php

namespace D3\Heidelpay\Modules\Application\Controller;

use D3\Heidelpay\Models\Containers\PrepaymentData;
use D3\Heidelpay\Models\Factory;
use D3\Heidelpay\Models\Payment\Btobbillpurchase;
use D3\Heidelpay\Models\Payment\Exception\PaymentNotReferencedToHeidelpayException;
use D3\Heidelpay\Models\Payment\Ideal;
use D3\Heidelpay\Models\Payment\Eps;
use D3\Heidelpay\Models\Payment\Invoice\Secured;
use D3\Heidelpay\Models\Payment\Invoice\Unsecured;
use D3\Heidelpay\Models\Payment\Prepayment;
use D3\Heidelpay\Models\Payment\Przelewy24;
use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use Doctrine\DBAL\DBALException;
use OxidEsales\Eshop\Application\Model\Payment as OxidPayment;
use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Exception\SystemComponentException;
use stdClass;

/**
 */
class ThankYouController extends ThankYouController_parent
{
    /**
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function d3GetBankTransferDataTemplateName()
    {
        return $this->d3GetTemplateName('banktransferdata');
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
            $mappedThemeId = d3_cfg_mod::get('d3heidelpay')->getMappedThemeId();

            return "d3_heidelpay_views_{$mappedThemeId}_tpl_{$templateName}.tpl";
        }

        return '';
    }

    /**
     * @return bool|stdClass|void|null
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws PaymentNotReferencedToHeidelpayException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws StandardException
     * @throws SystemComponentException
     */
    public function init()
    {
        // get basket we might need some information from it here
        $oBasket = $this->getSession()->getBasket();
        $oBasket->setOrderId(\OxidEsales\Eshop\Core\Registry::getSession()->getVariable('sess_challenge'));

        // copying basket object
        $this->_oBasket = clone $oBasket;

        if (false == d3_cfg_mod::get('d3heidelpay')->isActive()) {
            parent::init();
            return;
        }

        $order = $this->getOrder();
        if (false === $order) {
            parent::init();
            return;
        }
        /** @var Factory $factory */
        $factory   = oxNew(Factory::class, d3_cfg_mod::get('d3heidelpay'));
        /** @var OxidPayment $payment */
        $payment  = oxNew(OxidPayment::class);
        $payment->load($order->getFieldData('oxpaymenttype'));

        if (false == $payment->isLoaded() || false == $factory->getChannelProvider()->isOxPaymentIdAssignedToChannel($payment->getId())) {
            parent::init();
            return;
        }

        $settings = $factory->getSettings();
        $heidelpayment = $settings->getPayment($payment);

        if (false == ($heidelpayment instanceof Ideal || $heidelpayment instanceof Eps || $heidelpayment instanceof Przelewy24)) {
            parent::init();
            return;
        }

        // is module active + payment assigned
        $temp             = $order->getFieldData('oxordernr');
        $shouldSetOrderNr = false == $temp;

        if (false == $shouldSetOrderNr) {
            parent::init();
            return;
        }

        $placeholder      = 'heidelpayPlaceholder';
        if ($shouldSetOrderNr) {
            $order->assign(['oxordernr' => $placeholder]);
        }

        parent::init();

        $order = $this->getOrder();
        if ($shouldSetOrderNr && $placeholder === $order->getFieldData('oxordernr')) {
            $parameter = [
                $order->getFieldData('oxid'),
                $temp
            ];

            $query = <<<MySQL
SELECT 1 FROM oxorder WHERE oxid = ? AND oxordernr = ?
MySQL;

            $order->assign(['oxordernr' => $temp]);
            if (false === DatabaseProvider::getDb()->getOne($query, $parameter)) {
                $order->save();
            }
        }
    }
}
