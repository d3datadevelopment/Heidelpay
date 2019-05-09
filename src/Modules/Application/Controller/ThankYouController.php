<?php

namespace D3\Heidelpay\Modules\Application\Controller;

use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use Doctrine\DBAL\DBALException;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;

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
}
