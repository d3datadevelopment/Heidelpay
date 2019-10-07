<?php
/**
 * This Software is the property of Data Development and is protected
 * by copyright law - it is NOT Freeware.
 * Any unauthorized use of this software without a valid license
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 * http://www.shopmodule.com
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

namespace D3\Heidelpay\Setup;

use D3\ModCfg\Application\Model\Install\d3install_updatebase;
use D3\ModCfg\Application\Model\Installwizzard\d3installdbcommon;
use OxidEsales\Eshop\Core\Database\Adapter\DatabaseInterface;
use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\SystemComponentException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Facts\Facts;

class CleanupRoutine extends d3install_updatebase
{
    protected $_aUpdateMethods = array(
        array(
            'check' => 'hasStoredDataWithWrongShopid',
            'do'    => 'cleanUpStoredDataShopids'
        ),
    );

    /**
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws SystemComponentException
     */
    public function cleanUpStoredDataShopids()
    {
        if ($this->hasStoredDataWithWrongShopid()) {
            $query = <<<MySQL
UPDATE d3hpuid, oxuser 
  SET d3hpuid.OXSHOPID = oxuser.OXSHOPID
  WHERE d3hpuid.OXUSERID = oxuser.oxid;
MySQL;

            $this->setActionLog('SQL', $query);
            if ($this->hasExecute()) {
                /** @var d3installdbcommon $oDbCommon */
                $oDbCommon = oxNew(d3installdbcommon::class, $this);

                return $oDbCommon->sqlExecute($query);
            }
        }

        return true;
    }

    /**
     * @return bool|DatabaseInterface
     * @throws DatabaseConnectionException
     */
    public function hasStoredDataWithWrongShopid()
    {
        if (false === Registry::get(Facts::class)->isEnterprise()) {
            return false;
        }

        // has d3hpuid Entires with wrong shopid ?
        $query = <<<MySQL
SELECT count(*) FROM d3hpuid 
LEFT JOIN oxuser ON d3hpuid.OXUSERID = oxuser.oxid
WHERE d3hpuid.OXSHOPID != oxuser.OXSHOPID
MySQL;

        return (bool)DatabaseProvider::getMaster()->getOne($query);
    }
}
