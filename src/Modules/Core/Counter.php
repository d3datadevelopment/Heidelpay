<?php
namespace D3\Heidelpay\Modules\Core;

/**
 */
class Counter extends Counter_parent
{
    /**
     * Returns module specific counter suffix
     *
     * @return string
     */
    protected function _getCounterSuffix()
    {
        $sCountId = $this->_getCountId();

        if ($sCountId != 'd3heidelpay') {
            return parent::_getCounterSuffix();
        }

        $sSuffixString = '';
        $sActionId     = $this->_getActionId();

        if ($sActionId == "transactionid_ccdb" || $sActionId == "transactionid_otpa") {
            $sSuffixString = "__@@" . date("Y-m-d H:i:s");
        }

        return $sSuffixString;
    }
}

