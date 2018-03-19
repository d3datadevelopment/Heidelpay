<?php
namespace D3\Heidelpay\Modules\Core;
use D3\Heidelpay\Models\Settings\Heidelpay;
use D3\Heidelpay\Models\Verify\Input;
use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use OxidEsales\Eshop\Core\Registry;

/**
 */
class InputValidator extends InputValidator_parent
{

    /**
     * {@inheritdoc}
     */
    public function validatePaymentInputData($sPaymentId, &$aDynvalue)
    {
        if (false == d3_cfg_mod::get('d3heidelpay')->isActive()) {
            return parent::validatePaymentInputData($sPaymentId, $aDynvalue);
        }
        /** @var Heidelpay $oSettings */
        $oSettings = oxNew(Heidelpay::class, d3_cfg_mod::get('d3heidelpay'));
        Registry::set(Heidelpay::class, $oSettings);

        /** @var Input $oVerify */
        $oVerify = oxNew(Input::class, Registry::get(Registry::class), $sPaymentId, $aDynvalue);
        $mReturn = $oVerify->verify();

        if ('callParent' === $mReturn) {
            return parent::validatePaymentInputData($sPaymentId, $aDynvalue);
        }

        return $mReturn;
    }
}
