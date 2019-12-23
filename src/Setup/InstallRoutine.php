<?php

namespace D3\Heidelpay\Setup;

use D3\Heidelpay\Models\Configuration\ModProfile;
use D3\Heidelpay\Models\Factory;
use D3\Heidelpay\Models\Transactionlog\Reader\Heidelpay as TransactionlogReader;
use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\d3database;
use D3\ModCfg\Application\Model\d3str;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use D3\ModCfg\Application\Model\Install\d3install_updatebase;
use D3\ModCfg\Application\Model\Installwizzard\d3installconfirmmessage;
use D3\ModCfg\Application\Model\Transactionlog\d3transactionlog;
use Doctrine\DBAL\DBALException;
use Exception;
use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\Exception\ConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Exception\SystemComponentException;
use OxidEsales\Eshop\Core\Model\BaseModel;
use OxidEsales\Eshop\Core\Registry;

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
class InstallRoutine extends d3install_updatebase
{
    /**
     * @var string
     */
    public $sModKey = 'd3heidelpay';

    /**
     * @var string
     */
    public $sModName = 'Heidelpay';

    /**
     * @var string
     */
    public $sModVersion = '6.1.0.1';

    /**
     * @var string
     */
    public $sMinModCfgVersion = '5.2.0.2';

    /** @var string @deprecated since 2016-04-13 */
    public $sModRevision = '6110';

    /**
     * @var string
     */
    public $sBaseConf = '--------------------------------------------------------------------------------
38kv2==RkNqL2lJVW9nMnk4TW5Ib2ZLTXlBS3BRbEhqem9waFUyajZrUHVtNW8rR21icDNhY3B6TFMxb
nREWEM5MzdOaENXK0ZTMkpJZnFOVUM2T3lwdDVXUjRoZVc0Ymo5WUNRakRzMHNDdlB3emF3STh1OEIrY
XdpK0xocitGNU9pdW9XSjFvNzU3dHpwZXpzdExKVG55N1o0UFR0ODg3dEw2TmhwR01MQllTSEF0S0JLa
UVBVXV3VURsV09hdDV1eWFmbDg2V0NqeC93T1F3OTYzOC9EZnY5K0RmUU9MbE00S2I5Wm9aanZCbHRKL
y80VlpnamtKcFNqVVdkK3ZLdVpYMnBIeE9YclN1K01EVTloQXAyK3RiUTRkOHZOQzZNOU9GZXhhd0I3c
HJIZlo4TFQrMUw1QWZZUTNDbmN0MU50bytab2VtbTJCUnFINTVSUjVZVXh6Ym5RPT0=
--------------------------------------------------------------------------------';

    /**
     * @var string
     */
    public $sRequirements = '';

    /**
     * @var string
     */
    public $sBaseValue = 'TyUzQTglM0ElMjJzdGRDbGFzcyUyMiUzQTI3JTNBJTdCcyUzQTM0JTNBJTIyZDNfY2ZnX21vZF9fZDNoZWlkZWxwYXlfYmxUZXN0bW9kZSUyMiUzQnMlM0ExJTNBJTIyMSUyMiUzQnMlM0EzOSUzQSUyMmQzX2NmZ19tb2RfX2QzaGVpZGVscGF5X3NTZWN1cml0eVNlbmRlciUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTMxJTNBJTIyZDNfY2ZnX21vZF9fZDNoZWlkZWxwYXlfc1VzZXJJRCUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTMzJTNBJTIyZDNfY2ZnX21vZF9fZDNoZWlkZWxwYXlfc1Bhc3N3b3JkJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBNDMlM0ElMjJkM19jZmdfbW9kX19kM2hlaWRlbHBheV9zU2VjdXJpdHlTZW5kZXJUZXN0JTIyJTNCcyUzQTMyJTNBJTIyMzFIQTA3QkM4MTQyQzVBMTcxNzQ1RDAwQUQ2M0QxODIlMjIlM0JzJTNBMzUlM0ElMjJkM19jZmdfbW9kX19kM2hlaWRlbHBheV9zVXNlcklEVGVzdCUyMiUzQnMlM0EzMiUzQSUyMjMxaGEwN2JjODE0MmM1YTE3MTc0NGU1YWVmMTFmZmQzJTIyJTNCcyUzQTM3JTNBJTIyZDNfY2ZnX21vZF9fZDNoZWlkZWxwYXlfc1Bhc3N3b3JkVGVzdCUyMiUzQnMlM0E4JTNBJTIyOTMxNjdERTclMjIlM0JzJTNBMzQlM0ElMjJkM19jZmdfbW9kX19kM2hlaWRlbHBheV9zVHJhbnNUeXBlJTIyJTNCcyUzQTQlM0ElMjJhdXRoJTIyJTNCcyUzQTM2JTNBJTIyZDNfY2ZnX21vZF9fZDNoZWlkZWxwYXlfYmxDYXJkc1VzZVJHJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTM2JTNBJTIyZDNfY2ZnX21vZF9fZDNoZWlkZWxwYXlfc0REVHJhbnNUeXBlJTIyJTNCcyUzQTQlM0ElMjJhdXRoJTIyJTNCcyUzQTM2JTNBJTIyZDNfY2ZnX21vZF9fZDNoZWlkZWxwYXlfc1ZBVHJhbnNUeXBlJTIyJTNCcyUzQTQlM0ElMjJhdXRoJTIyJTNCcyUzQTQyJTNBJTIyZDNfY2ZnX21vZF9fZDNoZWlkZWxwYXlfYmxTaG93U3RvcmVkSFBEYXRhJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTM0JTNBJTIyZDNfY2ZnX21vZF9fZWFzeUNyZWRpdExpbWl0TWluaW11bSUyMiUzQnMlM0EzJTNBJTIyMjAwJTIyJTNCcyUzQTM0JTNBJTIyZDNfY2ZnX21vZF9fZWFzeUNyZWRpdExpbWl0TWF4aW11bSUyMiUzQnMlM0E0JTNBJTIyNTAwMCUyMiUzQnMlM0EzOCUzQSUyMmQzX2NmZ19tb2RfX2ludm9pY2VTZWN1cmVkTGltaXRNaW5pbXVtJTIyJTNCcyUzQTIlM0ElMjIxMCUyMiUzQnMlM0EzOCUzQSUyMmQzX2NmZ19tb2RfX2ludm9pY2VTZWN1cmVkTGltaXRNYXhpbXVtJTIyJTNCcyUzQTQlM0ElMjIxMDAwJTIyJTNCcyUzQTQ2JTNBJTIyZDNfY2ZnX21vZF9fZDNoZWlkZWxwYXlfb3JkZXJFeGVjdXRlUG9zdEZpZWxkcyUyMiUzQnMlM0ExMDIlM0ElMjJvcmRfYWdiJTIwJTNEJTNFJTIwMSUwRCUwQW9yZF9jdXN0aW5mbyUyMCUzRCUzRSUyMDElMEQlMEFveGRvd25sb2FkYWJsZXByb2R1Y3RzYWdyZWVtZW50JTIwJTNEJTNFJTIwMSUwRCUwQW94c2VydmljZXByb2R1Y3RzYWdyZWVtZW50JTIwJTNEJTNFJTIwMSUyMiUzQnMlM0E0NiUzQSUyMmQzX2NmZ19tb2RfX2QzaGVpZGVscGF5X2FkZGl0aW9uYWxVcmxQYXJhbWV0ZXIlMjIlM0JzJTNBMTklM0ElMjJ1dG1fbm9vdmVycmlkZSUyMCUzRCUzRSUyMDElMjIlM0JzJTNBMzYlM0ElMjJkM19jZmdfbW9kX19kM2hlaWRlbHBheV9pQ3VybFRpbWVPdXQlMjIlM0JzJTNBMiUzQSUyMjYwJTIyJTNCcyUzQTM5JTNBJTIyZDNfY2ZnX21vZF9fZDNoZWlkZWxwYXlfYmxTZXJ2aWNlRXJyb3JzJTIyJTNCcyUzQTElM0ElMjIxJTIyJTNCcyUzQTQ2JTNBJTIyZDNfY2ZnX21vZF9fZDNoZWlkZWxwYXlfb3h0cmFuc3N0YXR1c2Vycm9ybWFpbCUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTQyJTNBJTIyZDNfY2ZnX21vZF9fZDNoZWlkZWxwYXlfb3h0cmFuc3N0YXR1c2Vycm9yJTIyJTNCcyUzQTUlM0ElMjJFUlJPUiUyMiUzQnMlM0EzOSUzQSUyMmQzX2NmZ19tb2RfX2QzaGVpZGVscGF5X2NhcmR0eXBldGltZW91dCUyMiUzQnMlM0EzJTNBJTIyNjAwJTIyJTNCcyUzQTM1JTNBJTIyZDNfY2ZnX21vZF9fc0QzSHBIRk9yZGVyUGVuZGluZ1RpbWUlMjIlM0JzJTNBMiUzQSUyMjI2JTIyJTNCcyUzQTI5JTNBJTIyZDNfY2ZnX21vZF9fc0QzSHBIRk9yZGVyTGltaXQlMjIlM0JzJTNBMyUzQSUyMjEwMCUyMiUzQnMlM0EzNCUzQSUyMmQzX2NmZ19tb2RfX3NEM0hwSEZPcmRlckNhbmNlbFR5cGUlMjIlM0JzJTNBMTMlM0ElMjJQTEVBU0VfQ0hPT1NFJTIyJTNCcyUzQTM4JTNBJTIyZDNfY2ZnX21vZF9fYmxEM0hwSEZTZXRaZXJvT3JkZXJOdW1iZXIlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0IlN0Q=';

    /**
     * @var array
     */
    public $aFields = array(
        'OXID_d3hpuid'                => array(
            'sTableName'  => 'd3hpuid',
            'sFieldName'  => 'OXID',
            'sType'       => 'VARCHAR(32)',
            'blNull'      => false,
            'sDefault'    => '',
            'sComment'    => 'D3 Heidelpay',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'OXUSERID_d3hpuid'            => array(
            'sTableName'  => 'd3hpuid',
            'sFieldName'  => 'OXUSERID',
            'sType'       => 'VARCHAR(32)',
            'blNull'      => false,
            'sDefault'    => '',
            'sComment'    => 'D3 Heidelpay',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'OXPAYMENTID_d3hpuid'         => array(
            'sTableName'  => 'd3hpuid',
            'sFieldName'  => 'OXPAYMENTID',
            'sType'       => 'VARCHAR(32)',
            'blNull'      => false,
            'sDefault'    => '',
            'sComment'    => 'D3 Heidelpay',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'OXUID_d3hpuid'               => array(
            'sTableName'  => 'd3hpuid',
            'sFieldName'  => 'OXUID',
            'sType'       => 'VARCHAR(50)',
            'blNull'      => false,
            'sDefault'    => '',
            'sComment'    => 'D3 Heidelpay',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'OXTIME_d3hpuid'              => array(
            'sTableName'  => 'd3hpuid',
            'sFieldName'  => 'OXTIME',
            'sType'       => 'DATETIME',
            'blNull'      => false,
            'sDefault'    => '0000-00-00 00:00:00',
            'sComment'    => 'D3 Heidelpay',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'OXPAYMENTDATA_d3hpuid'       => array(
            'sTableName'  => 'd3hpuid',
            'sFieldName'  => 'OXPAYMENTDATA',
            'sType'       => 'TEXT',
            'blNull'      => false,
            'sDefault'    => '',
            'sComment'    => 'D3 Heidelpay',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'OXSHOPID_d3hpuid'       => array(
            'sTableName'  => 'd3hpuid',
            'sFieldName'  => 'OXSHOPID',
            'sType'       => 'INT(11)',
            'blNull'      => false,
            'sDefault'    => '1',
            'sComment'    => '',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'OXID_d3hperrortexts'         => array(
            'sTableName'  => 'd3hperrortexts',
            'sFieldName'  => 'OXID',
            'sType'       => 'VARCHAR(32)',
            'blNull'      => false,
            'sDefault'    => '',
            'sComment'    => 'D3 Heidelpay',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'OXCODE_d3hperrortexts'       => array(
            'sTableName'  => 'd3hperrortexts',
            'sFieldName'  => 'OXCODE',
            'sType'       => 'VARCHAR(20)',
            'blNull'      => false,
            'sDefault'    => '',
            'sComment'    => 'D3 Heidelpay',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'OXTYPE_d3hperrortexts'       => array(
            'sTableName'  => 'd3hperrortexts',
            'sFieldName'  => 'OXTYPE',
            'sType'       => 'INT(1)',
            'blNull'      => false,
            'sDefault'    => '0',
            'sComment'    => 'D3 Heidelpay',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'OXTITLE_d3hperrortexts'      => array(
            'sTableName'  => 'd3hperrortexts',
            'sFieldName'  => 'OXTITLE',
            'sType'       => 'VARCHAR(255)',
            'blNull'      => false,
            'sDefault'    => '',
            'sComment'    => 'D3 Heidelpay',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'OXTITLE_1_d3hperrortexts'    => array(
            'sTableName'  => 'd3hperrortexts',
            'sFieldName'  => 'OXTITLE_1',
            'sType'       => 'VARCHAR(255)',
            'blNull'      => false,
            'sDefault'    => '',
            'sComment'    => 'D3 Heidelpay',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'OXREALTEXT_d3hperrortexts'   => array(
            'sTableName'  => 'd3hperrortexts',
            'sFieldName'  => 'OXREALTEXT',
            'sType'       => 'VARCHAR(255)',
            'blNull'      => false,
            'sDefault'    => '',
            'sComment'    => 'D3 Heidelpay',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'D3HEIDELPAYVOUCHERS_oxorder' => array(
            'sTableName'  => 'oxorder',
            'sFieldName'  => 'D3HEIDELPAYVOUCHERS',
            'sType'       => 'TEXT',
            'blNull'      => false,
            'sDefault'    => '',
            'sComment'    => 'D3 Heidelpay voucherinfos for temporary orders',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
    );

    // Standardwerte zum umbenennen Tables
    /**
     * @var array
     */
    public $aIndizes = array(
        array(
            'sTableName'  => 'd3hpuid',
            'sType'       => d3database::INDEX_TYPE_PRIMARY,
            'sName'       => d3database::INDEX_TYPE_PRIMARY,
            'aFields'     => array(
                'OXID' => 'OXID',
            ),
            'blMultilang' => false,
        ),
        array(
            'sTableName'  => 'd3hpuid',
            'sType'       => 'KEY',
            'sName'       => 'OXSHOPID',
            'aFields'     => array(
                'OXSHOPID' => 'OXSHOPID',
            ),
            'blMultilang' => false,
        ),
        array(
            'sTableName'  => 'd3hpuid',
            'sType'       => 'KEY',
            'sName'       => 'OXUSERID',
            'aFields'     => array(
                'OXUSERID' => 'OXUSERID',
            ),
            'blMultilang' => false,
        ),
        array(
            'sTableName'  => 'd3hperrortexts',
            'sType'       => 'PRIMARY',
            'sName'       => 'PRIMARY',
            'aFields'     => array(
                'OXID' => 'OXID',
            ),
            'blMultilang' => false,
        ),
    );

    // Standardwerte fuer checkFields(), _addTable() und fixFields()
    // Standardwerte fuer checkIndizes() und fixIndizes()
    /**
     * @var array
     */
    protected $_aRefreshMetaModuleIds = array('d3heidelpay');
    /**
     * @var array
     */
    protected $_aUpdateMethods = array(
        array(
            'check' => 'hasToShowNoteForStoredData',
            'do'    => 'showNoteForStoredData'
        ),
        array(
            'check' => 'checkModCfgItemExist', // Prueft auf Datenbankeintrag
            'do'    => 'updateModCfgItemExist'
        ),
        array(
            'check' => 'checkD3hpuidTableExist',
            'do'    => 'updateD3hpuidTableExist'
        ),
        array(
            'check' => 'checkD3hperrortextsTableExist',
            'do'    => 'updateD3hperrortextsTableExist'
        ),
        array(
            'check' => 'hasEmptyCMSShopId', //0004566: Korrektur der Autoinstallation bei einem Modulupdate
            'do'    => 'removeEmptyCMSShopId' // bug fix for version 5.0.0.2
        ),
        array(
            'check' => 'checkHPerrortextcontent', // UPDATE `d3hperrortexts` SET `OXTYPE` = '2' WHERE `OXCODE` = '800.100.153';
            'do'    => 'updateHPerrortextcontent' // Update 4.0.1.0 XE4 => 4.0.2.0 XE4
        ),
        array(
            'check' => 'hasOldTables',
            'do'    => 'deleteOldTables'
        ),
        array(
            'check' => 'checkOxcontentEntrysExist', // Pruefte ob oxcontenteintraege schon vorhanden
            'do'    => 'showMessageForCustomerToUpdateManually'
        ),
        array(
            'check' => 'checkOxcontentItemsExist', // sql befehle fuer Tabelle oxcontents
            'do'    => 'insertOxcontentItemsIfNotExist'
        ),
        array(
            'check' => 'checkOxpaymentsItemsExist', // sql befehle fuer Tabelle oxpayments
            'do'    => 'insertOxpaymentsItemsIfNotExist'
        ),
        array(
            'check' => 'checkD3hperrortextsItemsExist', // sql befehle fuer Tabelle d3hperrortexts
            'do'    => 'insertD3hperrortextsItemsIfNotExist'
        ),
        array(
            'check' => 'checkForChangeHaendlerKontoMsg',
            'do'    => 'showForChangeHaendlerKontoMsg'
        ),
        array(
            'check' => 'checkModCfgorderExecutePostFields',
            'do'    => 'updateModCfgorderExecutePostFields'
        ),
        array(
            'check' => 'usingModCfgStoredDataWithoutRG',
            'do'    => 'updateModCfStoredDataWithRG'
        ),
        array(
            'check' => 'hasModProfileEntries',
            'do'    => 'createModProfileEntries'
        ),
        array(
            'check' => 'hasOldModuleItems', //nicht vorhandene Moduldatei-Eintraege entfernen
            'do'    => 'deleteOldModuleItems'
        ),
        array(
            'check' => 'checkFields',
            'do'    => 'fixFields'
        ),
        array(
            'check' => 'checkIndizes',
            'do'    => 'fixIndizes'
        ),
        array(
            'check' => 'checkModCfgSameRevision', // Prueft auf nachgezogene Revisionsnummer
            'do'    => 'updateModCfgSameRevision'
        ),
        array( // this has to be the last step
               'check' => 'hasMultilangConfigButNoSetting',
               'do'    => 'showMultilangConfigButNoSettingMessage'
        ),
    );

    /**
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws SystemComponentException
     */
    public function hasToShowNoteForStoredData()
    {
        $hasAlreadyCorrectedData = $this->getConfig()->getSystemConfigParameter('d3HeidelpayNoteShownForStoredData');

        if ($hasAlreadyCorrectedData) {
            return false;
        }

        if ($this->_checkTableNotExist('d3hpuid')) {
            return false;
        }

        if (DatabaseProvider::getDb()->getOne('SELECT COUNT(*) FROM d3hpuid')) {
            return true;
        }

        $this->getConfig()->saveSystemConfigParameter('bool', 'd3HeidelpayNoteShownForStoredData', true);

        return false;
    }

    /**
     * @return bool
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws SystemComponentException
     */
    public function showNoteForStoredData()
    {
        $this->_confirmMessage('D3HEIDELPAYNOTESHOWNFORSTOREDDATA');

        $aDoList                  = array();
        $hasReferenceIndexCreated = $hasOxuidIndexCreated = false;
        //set indexes
        if (false == DatabaseProvider::getDb()->getOne('SHOW INDEX FROM d3transactionlog WHERE Column_name=\'D3REFERENCE\';')) {
            $referenceQuery = 'ALTER TABLE `d3transactionlog` ADD INDEX `D3REFERENCE` (`D3REFERENCE`);';
            $aDoList[]      = $referenceQuery;
            DatabaseProvider::getDb()->execute($referenceQuery);
            $hasReferenceIndexCreated = true;
        }

        if (false == DatabaseProvider::getDb()->getOne('SHOW INDEX FROM d3hpuid WHERE Column_name=\'OXUID\';')) {
            $d3huidQuery = 'ALTER TABLE `d3hpuid` ADD INDEX `OXUID` (`OXUID`);';
            $aDoList[]   = $d3huidQuery;
            DatabaseProvider::getDb()->execute($d3huidQuery);
            $hasOxuidIndexCreated = true;
        }

        //cleanup non linked entries
        $aDoList[] = 'DELETE FROM d3hpuid 
 WHERE NOT EXISTS(
    SELECT NULL
    FROM d3transactionlog f
    WHERE f.D3REFERENCE = OXUID);';

        //get all d3transaction entries from d3huid
        $db     = DatabaseProvider::getDb(DatabaseProvider::FETCH_MODE_ASSOC);
        $result = $db->getAll(
            'SELECT d3transactionlog.oxid AS oxid FROM d3hpuid
LEFT JOIN d3transactionlog ON d3hpuid.`OXUID` = d3transactionlog.D3REFERENCE
WHERE d3transactionlog.oxid IS NOT NULL;'
        );

        $deleteIds = array();
        /** @var TransactionlogReader $reader */
        $reader = oxNew(TransactionlogReader::class);
        foreach ($result as $logdata) {
            $transaction = oxNew(d3transactionlog::class, $reader);
            if (false == $transaction->load($logdata['oxid'])) {
                continue;
            }
            $reader      = $transaction->getTransactiondata();
            $paymentcode = strtolower($reader->getPaymentcode());
            if (false == in_array($paymentcode, array('cc.rg', 'dc.rg'))) {
                $deleteIds[] = $transaction->getFieldData('d3reference');
                continue;
            }
        }
        if (false == empty($deleteIds)) {
            $ids = join("','", $deleteIds);

            $aDoList[] = "DELETE FROM d3hpuid WHERE OXUID IN ('$ids');";
        }

        if ($hasReferenceIndexCreated) {
            $referenceQuery = 'ALTER TABLE `d3transactionlog` DROP INDEX `D3REFERENCE`;';
            $aDoList[]      = $referenceQuery;
            DatabaseProvider::getDb()->execute($referenceQuery);
        }

        if ($hasOxuidIndexCreated) {
            $d3huidQuery = 'ALTER TABLE `d3hpuid` DROP INDEX `OXUID`;';
            $aDoList[]   = $d3huidQuery;
            DatabaseProvider::getDb()->execute($d3huidQuery);
        }

        $this->getConfig()->saveSystemConfigParameter('bool', 'd3HeidelpayNoteShownForStoredData', true);
        $this->setInitialExecMethod(__METHOD__);
        $blUseCombinedLogItem = false == $this->hasExecute();

        return $this->_executeMultipleQueries($aDoList, $blUseCombinedLogItem);
    }

    /**
     * @return bool
     * @throws DatabaseConnectionException
     */
    public function checkD3hperrortextsItemsExist()
    {
        $blReturn = $this->_checkUpdateFile('d3/heidelpay/Setup/d3hp_errortextsQuerys.php');

        return $blReturn;
    }

    /**
     * @return bool
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function insertD3hperrortextsItemsIfNotExist()
    {
        return $this->_doUpdateFile('d3/heidelpay/Setup/d3hp_errortextsQuerys.php');
    }

    /****************************************************
     * Tabellen anlegen                                 *
     ****************************************************/
    /**
     * @return bool TRUE, if table exsist
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function hasOldTables()
    {
        return $this->_checkTableExist('PrepaymentData')
            || $this->_checkTableExist('oxhpprepaymentdata')
            || $this->_checkTableExist('oxpaylogs')
            || $this->_checkTableExist('oxhpuid')
            || $this->_checkTableExist('oxhperrortexts')
            || $this->_checkTableExist('oxobject2heidelpay');
    }

    /**
     * @return bool
     * @throws DBALException
     * @throws ConnectionException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function deleteOldTables()
    {
        $blRet = true;

        if ($this->_checkTableExist('PrepaymentData')) {
            $aRet  = $this->_dropTable('PrepaymentData');
            $blRet = $aRet['blRet'];
            $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
        }

        if ($this->_checkTableExist('oxhpprepaymentdata')) {
            $aRet  = $this->_dropTable('oxhpprepaymentdata');
            $blRet = $aRet['blRet'];
            $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
        }

        if ($this->_checkTableExist('oxobject2heidelpay')) {
            $aRet  = $this->_dropTable('oxobject2heidelpay');
            $blRet = $aRet['blRet'];
            $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
        }

        if ($this->_checkTableExist('oxhpuid')) {
            $aRet  = $this->_dropTable('oxhpuid');
            $blRet = $aRet['blRet'];
            $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
        }

        if ($this->_checkTableExist('oxhperrortexts')) {
            $aRet  = $this->_dropTable('oxhperrortexts');
            $blRet = $aRet['blRet'];
            $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
        }

        if ($this->_checkTableExist('oxpaylogs')) {
            $aRet  = $this->_dropTable('oxpaylogs');
            $blRet = $aRet['blRet'];
            $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
        }

        return $blRet;
    }

    /**
     * @return bool
     * @throws DBALException
     * @throws ConnectionException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function updateD3hpuidTableExist()
    {
        $blRet = true;

        if ($this->checkD3hpuidTableExist()) {
            $aRet  = $this->_addTable2('d3hpuid', $this->aFields, $this->aIndizes, 'D3 Heidelpay', 'MyISAM');
            $blRet = $aRet['blRet'];
            $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
        }

        return $blRet;
    }

    /**
     * @return bool TRUE, if table is missing
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function checkD3hpuidTableExist()
    {
        return $this->_checkTableNotExist('d3hpuid');
    }

    /**
     * @return bool
     * @throws DBALException
     * @throws ConnectionException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function updateD3hperrortextsTableExist()
    {
        $blRet = true;

        if ($this->checkD3hperrortextsTableExist()) {
            $aRet  = $this->_addTable2('d3hperrortexts', $this->aFields, $this->aIndizes, 'D3 Heidelpay', 'MyISAM');
            $blRet = $aRet['blRet'];
            $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
        }

        return $blRet;
    }

    /**
     * @return bool TRUE, if table is missing
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function checkD3hperrortextsTableExist()
    {
        return $this->_checkTableNotExist('d3hperrortexts');
    }

    /****************************************************
     * Tabelle oxcontents & oxpayments                  *
     * if entrys not exist -> insert                    *
     ****************************************************/

    /**
     * @return bool
     * @throws ConnectionException
     * @throws DatabaseConnectionException
     * @throws SystemComponentException
     */
    public function checkOxcontentItemsExist()
    {
        $blReturn = $this->_hasExecuteFileQuery('d3/heidelpay/Setup/d3hp_oxcontentsQuerys.php');

        return $blReturn;
    }

    /**
     * @param $sFileName
     *
     * @return bool
     * @throws ConnectionException
     * @throws DatabaseConnectionException
     * @throws SystemComponentException
     */
    protected function _hasExecuteFileQuery($sFileName)
    {
        startProfile(__METHOD__);
        $result = false;

        $sCurrentShopId = $this->getConfig()->getShopId();
        foreach ($this->getShopListByActiveModule($this->sModKey) as $oShop) {
            /** @var $oShop BaseModel */
            $this->_changeToShop($oShop->getId());
            $aList = $this->_parseUpdateFile($sFileName);
            foreach ($aList['check'] as $sCheckQuery) {
                if (DatabaseProvider::getDb(DatabaseProvider::FETCH_MODE_ASSOC)->getOne($sCheckQuery)) {
                    $result = true;
                    break;
                }
            }
        }

        $this->_changeToShop($sCurrentShopId);
        stopProfile(__METHOD__);

        return $result;
    }

    /**
     * @return bool
     * @throws ConnectionException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws SystemComponentException
     */
    public function insertOxcontentItemsIfNotExist()
    {
        Registry::getSession()->setVariable('d3hp_update_skip_oxcontents', 1);

        $blReturn = $this->_executeFileQueries('d3/heidelpay/Setup/d3hp_oxcontentsQuerys.php');

        return $blReturn;
    }

    /**
     * @param $sFileName
     *
     * @return bool
     * @throws ConnectionException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws SystemComponentException
     */
    protected function _executeFileQueries($sFileName)
    {
        startProfile(__METHOD__);

        $blRet   = true;
        $aDoList = array();

        $sCurrentShopId = $this->getConfig()->getShopId();

        foreach ($this->getShopListByActiveModule($this->sModKey) as $oShop) {
            /** @var $oShop BaseModel */
            $this->_changeToShop($oShop->getId());
            $aList = $this->_parseUpdateFile($sFileName);

            $oD3Str = oxNew(d3str::class);
            $oD3Str->convert2utf_8($aList, false);

            foreach ($aList['check'] as $sKey => $sCheckQuery) {
                if (DatabaseProvider::getDb(DatabaseProvider::FETCH_MODE_ASSOC)->getOne($sCheckQuery)) {
                    $aList['do'][$sKey] = utf8_encode($aList['do'][$sKey]);
                    $aDoList[]          = $aList['do'][$sKey];
                }
            }
        }

        $this->_changeToShop($sCurrentShopId);

        if ($aDoList && is_array($aDoList) && count($aDoList)) {
            $this->setInitialExecMethod(__METHOD__);
            $blUseCombinedLogItem = !$this->hasExecute();
            $blRet                = $this->_executeMultipleQueries($aDoList, $blUseCombinedLogItem);
        }

        stopProfile(__METHOD__);

        return $blRet;
    }

    /****************************************************
     * Tabelle oxcontents                               *
     * No Autoupdate if exist -> Message                *
     ****************************************************/

    /**
     * @return bool
     * @throws DatabaseConnectionException
     */
    public function checkOxpaymentsItemsExist()
    {
        $blReturn = $this->_checkUpdateFile('d3/heidelpay/Setup/d3hp_oxpaymentsQuerys.php');

        return $blReturn;
    }

    /**
     * @return bool
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function insertOxpaymentsItemsIfNotExist()
    {
        return $this->_doUpdateFile('d3/heidelpay/Setup/d3hp_oxpaymentsQuerys.php');
    }

    /**
     * @return bool
     * @throws ConnectionException
     * @throws DBALException
     * @throws DatabaseConnectionException
     */
    public function checkOxcontentEntrysExist()
    {
        $blRet       = false;
        $bSkipUpdate = Registry::getSession()->getVariable('d3hp_update_skip_oxcontents');

        if ($bSkipUpdate) {
            return $blRet;
        }

        foreach ($this->getShopListByActiveModule($this->sModKey) as $oShop) {
            /** @var $oShop BaseModel */

            $query = /** @lang MySQL */
                <<<MySQL
SELECT count(*) FROM oxcontents
WHERE  oxloadid IN (
    'd3_hp_vorkassemail_cust_text',
    'd3_hp_vorkassemail_cust_subject',
    'd3_hp_vorkassemail_cust_plain',
    'd3_hp_vorkassemail_owner_text',
    'd3_hp_vorkassemail_owner_subject',
    'd3_hp_vorkassemail_owner_plain'
  ) 
  AND oxshopid = '{$oShop->getId()}'
MySQL;

            $blInstallationIsNotComplete = $this->checkModCfgSameRevision();

            if ((DatabaseProvider::getDb()->getOne($query)) && $blInstallationIsNotComplete) {
                $blRet = true;
            }
        }

        return $blRet;
    }

    /**
     * Message for manuelle Updates for CMS-Sites
     *
     * @return bool
     */
    public function showMessageForCustomerToUpdateManually()
    {
        $sMessage = 'D3_HEIDELPAY_UPDATE_OXCONTENTITEMS';
        $blRet    = $this->_confirmMessage($sMessage);

        Registry::getSession()->setVariable('d3hp_update_skip_oxcontents', 1);

        return $blRet;
    }

    /**
     * @return bool
     * @throws DBALException
     * @throws ConnectionException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function updateHPerrortextcontent()
    {
        $blRet = false;

        if ($this->checkHPerrortextcontent()) {
            $aWhere = array(
                'oxcode' => '800.100.153',
            );

            if ($this->_checkTableItemNotExist('d3hperrortexts', $aWhere)) {
                $aInsertFields = array(
                    'OXID'       => array(
                        'content'      => "366",
                        'force_update' => true,
                        'use_quote'    => false,
                    ),
                    'OXCODE'     => array(
                        'content'      => '800.100.153',
                        'force_update' => true,
                        'use_quote'    => true,
                    ),
                    'OXTYPE'     => array(
                        'content'      => "2",
                        'force_update' => true,
                        'use_quote'    => true,
                    ),
                    'OXTITLE'    => array(
                        'content'      => "Ung&uuml;ltige Pr&uuml;fziffer",
                        'force_update' => true,
                        'use_quote'    => true,
                    ),
                    'OXTITLE_1'  => array(
                        'content'      => "transaction declined (invalid CVV)",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXREALTEXT' => array(
                        'content'      => "transaction declined (invalid CVV)",
                        'force_update' => true,
                        'use_quote'    => true,
                    )
                );
                $aRet          = $this->_updateTableItem2('d3hperrortexts', $aInsertFields, $aWhere);
                $blRet         = $aRet['blRet'];

                $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
                $this->setUpdateBreak(false);
            }
        }

        // if actually updated don't update entry a second time
        Registry::getSession()->setVariable('d3hp_HPerrortext_skip_update', 1);

        return $blRet;
    }

    /**
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function checkHPerrortextcontent()
    {
        $blRet                         = false;
        $bSkipUpdate                   = Registry::getSession()->getVariable('d3hp_HPerrortext_skip_update');
        $bSkipUpdateCauseTableNotExist = !$this->checkD3hperrortextsTableExist();

        if ($bSkipUpdate || $bSkipUpdateCauseTableNotExist) {
            return $blRet;
        }

        $aWhere = array(
            'oxcode' => '800.100.153',
        );
        $blRet1 = $this->_checkTableItemNotExist('d3hperrortexts', $aWhere);

        $blRetX = $this->checkModCfgSameRevision();

        if ($blRet1 && $blRetX) {
            $blRet = true;
        }

        return $blRet;
    }

    /**
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function checkRenameD3Tables()
    {
        return $this->checkRenameTables();
    }

    /**
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function renameD3Tables()
    {
        /** @param string $sMethodName */
        return $this->fixRenameTables(__METHOD__);
    }

    /**
     * @return bool
     * @throws DBALException
     * @throws ConnectionException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws SystemComponentException
     */
    public function showForChangeHaendlerKontoMsg()
    {
        $oConfirmMessage = oxNew(d3installconfirmmessage::class, $this);
        if (false == $this->hasExecute()) {
            $oConfirmMessage->showConfigConfirmMessage('blD3checkForModHaendlerKontoMsg', 'D3_HEIDELPAY_UPDATE_CHANGE_HAENDLERKONTO');
        }

        if ($this->hasExecute() && $this->checkForChangeHaendlerKontoMsg()) {
            $sCurrentShopid = $this->getConfig()->getShopId();

            foreach ($this->getShopListByActiveModule($this->sModKey) as $oShop) {
                /** @var $oShop BaseModel */
                $this->_changeToShop($oShop->getId());
                $oConfirmMessage->setConfirmMessageConfigRequest('blD3checkForModHaendlerKontoMsg', 1);
            }
            $this->_changeToShop($sCurrentShopid);
        }

        return true;
    }

    /**
     * @return bool
     * @throws DBALException
     * @throws ConnectionException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws SystemComponentException
     */
    public function checkForChangeHaendlerKontoMsg()
    {
        $sCurrentShopid = $this->getConfig()->getShopId();

        $result = false;
        foreach ($this->getShopListByActiveModule($this->sModKey) as $oShop) {
            /** @var $oShop BaseModel */
            $this->_changeToShop($oShop->getId());
            $moduleConfiguration = d3_cfg_mod::getNoCache($this->sModKey);
            if (false === $moduleConfiguration) {
                continue;
            }
            $oldVersionNumber = (int)$moduleConfiguration->getFieldData('oxversionnum');

            //check if old module version is new installation or older than 4.0.5.0
            if ($oldVersionNumber <= 0 || $oldVersionNumber >= 67110144) {
                continue;
            }

            $oConfirmMessage = oxNew(d3installconfirmmessage::class, $this);
            if (false == $oConfirmMessage->hasConfirmMessageConfigRequest('blD3checkForModHaendlerKontoMsg')) {
                $result = true;
                break;
            }
        }
        $this->_changeToShop($sCurrentShopid);

        return $result;
    }

    /**
     * @return bool
     * @throws DBALException
     * @throws ConnectionException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws SystemComponentException
     */
    public function checkModCfgorderExecutePostFields()
    {
        $blReturn       = false;
        $sCurrentShopid = $this->getConfig()->getShopId();
        foreach ($this->getShopListByActiveModule($this->sModKey) as $oShop) {
            /** @var $oShop BaseModel */
            $this->_changeToShop($oShop->getId());
            $moduleConfiguration = d3_cfg_mod::getNoCache($this->sModKey);
            if (false === $moduleConfiguration) {
                continue;
            }

            if (false == is_string(
                $moduleConfiguration->getValue('d3heidelpay_orderExecutePostFields')
                ) || strlen(
                    $moduleConfiguration->getValue('d3heidelpay_orderExecutePostFields')
                ) == 0
            ) {
                $blReturn = true;
            }
        }
        $this->_changeToShop($sCurrentShopid);

        return $blReturn;
    }

    /**
     * @return bool
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws ConnectionException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     */
    public function updateModCfgorderExecutePostFields()
    {
        $aDefaultConfig = unserialize(rawurldecode(base64_decode($this->sBaseValue)));

        $sCurrentShopid = $this->getConfig()->getShopId();
        foreach ($this->getShopListByActiveModule($this->sModKey) as $oShop) {
            /** @var $oShop BaseModel */
            $this->_changeToShop($oShop->getId());
            /** @var $oShop BaseModel */
            /** @var d3_cfg_mod $moduleConfiguration */
            $moduleConfiguration = d3_cfg_mod::getNoCache($this->sModKey);
            if (false === $moduleConfiguration) {
                continue;
            }

            $moduleConfiguration->setValue(
                'd3heidelpay_orderExecutePostFields',
                $aDefaultConfig->d3_cfg_mod__d3heidelpay_orderExecutePostFields
            );

            if ($this->hasExecute()) {
                $moduleConfiguration->save();
            }

            $sQuery = 'UPDATE ' . $moduleConfiguration->getCoreTableName() //
                . ' SET oxvalue = ' //
                . DatabaseProvider::getDb(DatabaseProvider::FETCH_MODE_ASSOC)->quote($moduleConfiguration->getFieldData('oxvalue')) //
                . " WHERE oxmodid = " . DatabaseProvider::getDb(DatabaseProvider::FETCH_MODE_ASSOC)->quote($this->sModKey) //
                . " AND oxshopid = " . DatabaseProvider::getDb(DatabaseProvider::FETCH_MODE_ASSOC)->quote($oShop->getId()) . ";";

            $this->setActionLog(
                'SQL',
                $sQuery,
                $this->getInitialExecMethod(__METHOD__)
            );
        }

        $this->_changeToShop($sCurrentShopid);

        return true;
    }

    /**
     * @return bool
     * @throws DBALException
     * @throws ConnectionException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws SystemComponentException
     */
    public function usingModCfgStoredDataWithoutRG()
    {
        startProfile(__METHOD__);

        $return        = false;
        $currentShopId = $this->getConfig()->getShopId();

        foreach ($this->getShopListByActiveModule($this->sModKey) as $oShop) {
            /** @var $oShop BaseModel */
            $this->_changeToShop($oShop->getId());

            $modConfig = d3_cfg_mod::getNoCache($this->sModKey);
            if (false === $modConfig) {
                continue;
            }
            $config = $oShop->getConfig();

            if ($config->getShopConfVar('d3HeidelpayNoteStoredDataWithoutRG')) {
                continue;
            }

            if ($modConfig->getValue('d3heidelpay_blShowStoredHPData') && false == $modConfig->getValue('d3heidelpay_blCardsUseRG')) {
                $return = true;
            }
        }

        $this->_changeToShop($currentShopId);

        stopProfile(__METHOD__);

        return $return;
    }

    /**
     * @return bool
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws ConnectionException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     */
    public function updateModCfStoredDataWithRG()
    {
        startProfile(__METHOD__);

        $return        = false;
        $currentShopId = $this->getConfig()->getShopId();

        foreach ($this->getShopListByActiveModule($this->sModKey) as $oShop) {
            /** @var $oShop BaseModel */
            $this->_changeToShop($oShop->getId());
            $modConfig = d3_cfg_mod::getNoCache($this->sModKey);
            if (false === $modConfig) {
                continue;
            }
            $config = $oShop->getConfig();

            if ($config->getShopConfVar('d3HeidelpayNoteStoredDataWithoutRG')) {
                continue;
            }

            if ($modConfig->getValue('d3heidelpay_blShowStoredHPData') && false == $modConfig->getValue('d3heidelpay_blCardsUseRG')) {
                $oConfirmMessage = oxNew(d3installconfirmmessage::class, $this);
                $message         = Registry::getLang()->translateString('D3HEIDELPAYNOTESTOREDDATAWITHOUTRG');
                $message         .= Registry::getLang()->translateString('HELP_D3DYN_HEIDELPAY_PARAM_CARDS_USE_RG');

                $oConfirmMessage->confirmCustomMessage($message);

                if ($this->hasExecute()) {
                    $modConfig->setValue('d3heidelpay_blCardsUseRG', true);
                    $modConfig->save();
                    $config->saveShopConfVar('bool', 'd3HeidelpayNoteStoredDataWithoutRG', true);
                }
            }
        }

        $this->_changeToShop($currentShopId);

        stopProfile(__METHOD__);

        return $return;
    }

    /**
     * 0004566: Korrektur der Autoinstallation bei einem Modulupdate
     *
     * @return bool
     * @throws DatabaseConnectionException
     */
    public function hasEmptyCMSShopId()
    {
        $oDb                     = DatabaseProvider::getDb();
        $sHasEmptyCMSShopIdQuery = <<<MYSQL
SELECT count(1) FROM `oxcontents`
WHERE
    `OXLOADID` LIKE {$oDb->quote('d3%')}
    AND `OXSHOPID` IN ('0', '')
MYSQL;

        return (bool)$oDb->getOne($sHasEmptyCMSShopIdQuery);
    }

    /**
     * 0004566: Korrektur der Autoinstallation bei einem Modulupdate
     *
     * @return bool
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function removeEmptyCMSShopId()
    {
        // ggf deleteTableitem benutzen?
        $oDb                     = DatabaseProvider::getDb();
        $sHasEmptyCMSShopIdQuery = <<<MYSQL
DELETE FROM `oxcontents`
WHERE
    `OXLOADID` LIKE {$oDb->quote('d3%')}
    AND `OXSHOPID` IN ('0', '')
MYSQL;
        $return                  = $this->sqlExecute($sHasEmptyCMSShopIdQuery);
        $this->setActionLog('SQL', $sHasEmptyCMSShopIdQuery, __METHOD__);

        return $return;
    }

    /**
     * @return bool
     * @throws ConnectionException
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws SystemComponentException
     */
    public function hasMultilangConfigButNoSetting()
    {
        startProfile(__METHOD__);

        $return        = false;
        $currentShopId = $this->getConfig()->getShopId();

        foreach ($this->getShopListByActiveModule($this->sModKey) as $oShop) {
            /** @var $oShop BaseModel */
            if ($currentShopId != $oShop->getId()) {
                continue;
            }

            $config = $oShop->getConfig();

            if ($config->getShopConfVar('d3hp_allowMultipleLanguages', null, 'd3heidelpay')) {
                continue;
            }

            if ($this->getSession()->getVariable('d3heidelpay_skip_multilangcheck' . $currentShopId)) {
                return false;
            }

            $actuallCalledMethod = $this->getConfig()->getActiveView()->getFncName();

            if ('autoinstall' === strtolower($actuallCalledMethod)) {
                $this->getSession()->setVariable('d3heidelpay_skip_multilangcheck' . $currentShopId, true);

                return false;
            }

            $modConfig = d3_cfg_mod::getNoCache($this->sModKey);
            if (false === $modConfig) {
                continue;
            }
            $moduleConfig = oxNew(d3_cfg_mod::class);
            $moduleConfig->setEnableMultilang(false);
            $moduleConfig->init();
            $moduleConfig->load($modConfig->getId());
            $languageCount = count((array)$config->getShopConfVar('aLanguages'));

            for ($i = 1; $languageCount > $i; $i++) {
                $oxvalue = $moduleConfig->getFieldData('oxvalue_' . $i);
                if (empty($oxvalue)) {
                    continue;
                }

                $return = true;
                break 2;
            }
        }

        stopProfile(__METHOD__);

        return $return;
    }

    /**
     * @return bool
     * @throws ConnectionException
     * @throws SystemComponentException
     */
    public function showMultilangConfigButNoSettingMessage()
    {
        startProfile(__METHOD__);

        $currentShopId = $this->getConfig()->getShopId();

        foreach ($this->getShopListByActiveModule($this->sModKey) as $oShop) {
            /** @var $oShop BaseModel */
            if ($currentShopId != $oShop->getId()) {
                continue;
            }
            $actuallCalledMethod = $this->getConfig()->getActiveView()->getFncName();

            if ('autoinstall' === strtolower($actuallCalledMethod)) {
                return true;
            }

            /** @var $oShop BaseModel */
            $this->_confirmMessage('D3HEIDELPAY_MULTIPLE_LANGUAGECONFIGURATIONS_FOUND');
            if ($this->hasExecute()) {
                $this->getSession()->setVariable('d3heidelpay_skip_multilangcheck' . $currentShopId, true);
            }

            return true;
        }

        stopProfile(__METHOD__);

        return false;
    }

    /**
     * @return bool
     * @throws ConnectionException
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws SystemComponentException
     */
    public function hasModProfileEntries()
    {
        $blReturn       = false;
        $sCurrentShopid = $this->getConfig()->getShopId();
        foreach ($this->getShopListByActiveModule($this->sModKey) as $oShop) {
            /** @var $oShop BaseModel */
            $this->_changeToShop($oShop->getId());
            /** @var ModProfile $modProfile */
            $modProfile = oxNew(ModProfile::class);
            /** @var Factory $factory */
            $factory = oxNew(Factory::class, d3_cfg_mod::getNoCache('d3heidelpay'));
            $oxid    = $factory->getModProfileId();
            if ($modProfile->exists($oxid)) {
                continue;
            }
            $blReturn = true;
            break;
        }
        $this->_changeToShop($sCurrentShopid);

        return $blReturn;
    }

    /**
     * @return bool
     * @throws ConnectionException
     * @throws Exception
     */
    public function createModProfileEntries()
    {
        $blReturn       = false;
        $sCurrentShopid = $this->getConfig()->getShopId();
        foreach ($this->getShopListByActiveModule($this->sModKey) as $oShop) {
            /** @var $oShop BaseModel */
            $this->_changeToShop($oShop->getId());
            /** @var ModProfile $modProfile */
            $modProfile = oxNew(ModProfile::class);
            /** @var Factory $factory */
            $d3CfgMod = d3_cfg_mod::getNoCache('d3heidelpay');
            $factory  = oxNew(Factory::class, $d3CfgMod);
            $oxid     = $factory->getModProfileId();
            if ($modProfile->exists($oxid)) {
                continue;
            }
            $oldPaymentlist = $d3CfgMod->getValue('d3heidelpay_aPaymentList');
            $oxValue = '';
            if (empty($oldPaymentlist)) {
                $oxValue = 'TyUzQTglM0ElMjJzdGRDbGFzcyUyMiUzQTEwJTNBJTdCcyUzQTMyJTNBJTIyYzY5MzViN2Q3MDUxY2NmNzY5MTcwYTY4MWU3ZDg3ODIlMjIlM0JzJTNBNDgzJTNBJTIyJTdCJTIyY2FyZFR5cGVUaW1lb3V0JTIyJTNBMCUyQyUyMmhlaWRlbHBheVBheW1lbnRDbGFzc25hbWUlMjIlM0ElMjJEMyU1QyU1Q0hlaWRlbHBheSU1QyU1Q01vZGVscyU1QyU1Q1BheW1lbnQlNUMlNUNDcmVkaXRjYXJkJTIyJTJDJTIyaXNVc2luZ1JlZ2lzdHJhdGlvbiUyMiUzQW51bGwlMkMlMjJpc1VzaW5nU3RvcmVkQ2FyZERhdGElMjIlM0FudWxsJTJDJTIyaWQlMjIlM0ElMjJjNjkzNWI3ZDcwNTFjY2Y3NjkxNzBhNjgxZTdkODc4MiUyMiUyQyUyMmlzQWN0aXZlJTIyJTNBJTIyMSUyMiUyQyUyMnRpdGxlJTIyJTNBJTIyS3JlZGl0a2FydGUlMjIlMkMlMjJwYXltZW50VHlwZSUyMiUzQSUyMkQzJTVDJTVDSGVpZGVscGF5JTVDJTVDTW9kZWxzJTVDJTVDU2V0dGluZ3MlNUMlNUNDaGFubmVscyU1QyU1Q0NyZWRpdENhcmQlMjIlMkMlMjJjaGFubmVsJTIyJTNBJTIyMzFIQTA3QkM4MTQyQzVBMTcxNzQ5QTYwRDk3OUI2RTQlMjIlMkMlMjJ0cmFuc2FjdGlvblR5cGUlMjIlM0ElMjIlMjIlMkMlMjJpc1Rlc3RDb25maWclMjIlM0ElMjIxJTIyJTJDJTIyb3hpZHBheW1lbnRJZHMlMjIlM0ElNUIlNUQlMkMlMjJza2lwUHJvcGVydGllcyUyMiUzQSU1QiUyMm94aWRwYXltZW50SWRzJTIyJTJDJTIyc2tpcFByb3BlcnRpZXMlMjIlMkMlMjJoZWlkZWxwYXlQYXltZW50Q2xhc3NuYW1lJTIyJTVEJTdEJTIyJTNCcyUzQTMyJTNBJTIyYmU2MjE1NzllNDRmYTUzNGUwN2YwZDAzOTk5ZjRhMTclMjIlM0JzJTNBNTIyJTNBJTIyJTdCJTIyY2FyZFR5cGVUaW1lb3V0JTIyJTNBMCUyQyUyMmhlaWRlbHBheVBheW1lbnRDbGFzc25hbWUlMjIlM0ElMjJEMyU1QyU1Q0hlaWRlbHBheSU1QyU1Q01vZGVscyU1QyU1Q1BheW1lbnQlNUMlNUNEZWJpdGNhcmQlMjIlMkMlMjJpc1VzaW5nUmVnaXN0cmF0aW9uJTIyJTNBbnVsbCUyQyUyMmlzVXNpbmdTdG9yZWRDYXJkRGF0YSUyMiUzQW51bGwlMkMlMjJpZCUyMiUzQSUyMmJlNjIxNTc5ZTQ0ZmE1MzRlMDdmMGQwMzk5OWY0YTE3JTIyJTJDJTIyaXNBY3RpdmUlMjIlM0ElMjIxJTIyJTJDJTIydGl0bGUlMjIlM0ElMjJEZWJpdGthcnRlJTIyJTJDJTIycGF5bWVudFR5cGUlMjIlM0ElMjJEMyU1QyU1Q0hlaWRlbHBheSU1QyU1Q01vZGVscyU1QyU1Q1NldHRpbmdzJTVDJTVDQ2hhbm5lbHMlNUMlNUNEZWJpdENhcmQlMjIlMkMlMjJjaGFubmVsJTIyJTNBJTIyMzFIQTA3QkM4MTQyQzVBMTcxNzQ5QTYwRDk3OUI2RTQlMjIlMkMlMjJ0cmFuc2FjdGlvblR5cGUlMjIlM0ElMjIlMjIlMkMlMjJpc1Rlc3RDb25maWclMjIlM0ElMjIxJTIyJTJDJTIyb3hpZHBheW1lbnRJZHMlMjIlM0ElNUIlNUQlMkMlMjJza2lwUHJvcGVydGllcyUyMiUzQSU1QiUyMm94aWRwYXltZW50SWRzJTIyJTJDJTIyc2tpcFByb3BlcnRpZXMlMjIlMkMlMjJoZWlkZWxwYXlQYXltZW50Q2xhc3NuYW1lJTIyJTVEJTJDJTIyb3hpZCUyMiUzQSUyMmJlNjIxNTc5ZTQ0ZmE1MzRlMDdmMGQwMzk5OWY0YTE3JTIyJTdEJTIyJTNCcyUzQTMyJTNBJTIyZGM1MjQ0OTNiMjFjMDBhMjE5YmRmODc3NTY1NjU0ODMlMjIlM0JzJTNBNDI1JTNBJTIyJTdCJTIyaGVpZGVscGF5UGF5bWVudENsYXNzbmFtZSUyMiUzQSUyMkQzJTVDJTVDSGVpZGVscGF5JTVDJTVDTW9kZWxzJTVDJTVDUGF5bWVudCU1QyU1Q0RpcmVjdGRlYml0JTIyJTJDJTIyaWQlMjIlM0ElMjJkYzUyNDQ5M2IyMWMwMGEyMTliZGY4Nzc1NjU2NTQ4MyUyMiUyQyUyMmlzQWN0aXZlJTIyJTNBJTIyMSUyMiUyQyUyMnRpdGxlJTIyJTNBJTIyU2VwYSUyMExhc3RzY2hyaWZ0JTIyJTJDJTIycGF5bWVudFR5cGUlMjIlM0ElMjJEMyU1QyU1Q0hlaWRlbHBheSU1QyU1Q01vZGVscyU1QyU1Q1NldHRpbmdzJTVDJTVDQ2hhbm5lbHMlNUMlNUNEaXJlY3RkZWJpdCU1QyU1Q1Vuc2VjdXJlZCUyMiUyQyUyMmNoYW5uZWwlMjIlM0ElMjIzMUhBMDdCQzgxNDJDNUExNzE3NDlBNjBEOTc5QjZFNCUyMiUyQyUyMnRyYW5zYWN0aW9uVHlwZSUyMiUzQSUyMiUyMiUyQyUyMmlzVGVzdENvbmZpZyUyMiUzQSUyMjElMjIlMkMlMjJveGlkcGF5bWVudElkcyUyMiUzQSU1QiU1RCUyQyUyMnNraXBQcm9wZXJ0aWVzJTIyJTNBJTVCJTIyb3hpZHBheW1lbnRJZHMlMjIlMkMlMjJza2lwUHJvcGVydGllcyUyMiUyQyUyMmhlaWRlbHBheVBheW1lbnRDbGFzc25hbWUlMjIlNUQlN0QlMjIlM0JzJTNBMzIlM0ElMjIwYThkNDczZDZlYzA2MGU3OTBmZGUwMzBjYTdjYjBmNSUyMiUzQnMlM0E0NDYlM0ElMjIlN0IlMjJoZWlkZWxwYXlQYXltZW50Q2xhc3NuYW1lJTIyJTNBJTIyRDMlNUMlNUNIZWlkZWxwYXklNUMlNUNNb2RlbHMlNUMlNUNQYXltZW50JTVDJTVDUHJlcGF5bWVudCUyMiUyQyUyMmlkJTIyJTNBJTIyMGE4ZDQ3M2Q2ZWMwNjBlNzkwZmRlMDMwY2E3Y2IwZjUlMjIlMkMlMjJpc0FjdGl2ZSUyMiUzQSUyMjElMjIlMkMlMjJ0aXRsZSUyMiUzQSUyMlZvcmthc3NlJTIyJTJDJTIycGF5bWVudFR5cGUlMjIlM0ElMjJEMyU1QyU1Q0hlaWRlbHBheSU1QyU1Q01vZGVscyU1QyU1Q1NldHRpbmdzJTVDJTVDQ2hhbm5lbHMlNUMlNUNQcmVwYXltZW50JTIyJTJDJTIyY2hhbm5lbCUyMiUzQSUyMjMxSEEwN0JDODE0MkM1QTE3MTc0OUE2MEQ5NzlCNkU0JTIyJTJDJTIydHJhbnNhY3Rpb25UeXBlJTIyJTNBJTIyJTIyJTJDJTIyaXNUZXN0Q29uZmlnJTIyJTNBJTIyMSUyMiUyQyUyMm94aWRwYXltZW50SWRzJTIyJTNBJTVCJTVEJTJDJTIyc2tpcFByb3BlcnRpZXMlMjIlM0ElNUIlMjJveGlkcGF5bWVudElkcyUyMiUyQyUyMnNraXBQcm9wZXJ0aWVzJTIyJTJDJTIyaGVpZGVscGF5UGF5bWVudENsYXNzbmFtZSUyMiU1RCUyQyUyMm94aWQlMjIlM0ElMjIwYThkNDczZDZlYzA2MGU3OTBmZGUwMzBjYTdjYjBmNSUyMiU3RCUyMiUzQnMlM0EzMiUzQSUyMmJhZDYwNTJlZWZmMTczNDYzNjVjYjZhZWViZTVjNzhhJTIyJTNCcyUzQTQyMCUzQSUyMiU3QiUyMmhlaWRlbHBheVBheW1lbnRDbGFzc25hbWUlMjIlM0ElMjJEMyU1QyU1Q0hlaWRlbHBheSU1QyU1Q01vZGVscyU1QyU1Q1BheW1lbnQlNUMlNUNJbnZvaWNlJTVDJTVDVW5zZWN1cmVkJTIyJTJDJTIyaWQlMjIlM0ElMjJiYWQ2MDUyZWVmZjE3MzQ2MzY1Y2I2YWVlYmU1Yzc4YSUyMiUyQyUyMmlzQWN0aXZlJTIyJTNBJTIyMSUyMiUyQyUyMnRpdGxlJTIyJTNBJTIyUmVjaG51bmclMjIlMkMlMjJwYXltZW50VHlwZSUyMiUzQSUyMkQzJTVDJTVDSGVpZGVscGF5JTVDJTVDTW9kZWxzJTVDJTVDU2V0dGluZ3MlNUMlNUNDaGFubmVscyU1QyU1Q0ludm9pY2UlNUMlNUNVbnNlY3VyZWQlMjIlMkMlMjJjaGFubmVsJTIyJTNBJTIyMzFIQTA3QkM4MTQyQzVBMTcxNzQ5QTYwRDk3OUI2RTQlMjIlMkMlMjJ0cmFuc2FjdGlvblR5cGUlMjIlM0ElMjIlMjIlMkMlMjJpc1Rlc3RDb25maWclMjIlM0ElMjIxJTIyJTJDJTIyb3hpZHBheW1lbnRJZHMlMjIlM0ElNUIlNUQlMkMlMjJza2lwUHJvcGVydGllcyUyMiUzQSU1QiUyMm94aWRwYXltZW50SWRzJTIyJTJDJTIyc2tpcFByb3BlcnRpZXMlMjIlMkMlMjJoZWlkZWxwYXlQYXltZW50Q2xhc3NuYW1lJTIyJTVEJTdEJTIyJTNCcyUzQTMyJTNBJTIyYmE4YTNjYjQ1YjkzMDU0YWFhNGM0ZDgzMzJhMjg1MjMlMjIlM0JzJTNBNDE0JTNBJTIyJTdCJTIyc1ZBVHJhbnNUeXBlJTIyJTNBbnVsbCUyQyUyMmhlaWRlbHBheVBheW1lbnRDbGFzc25hbWUlMjIlM0ElMjJEMyU1QyU1Q0hlaWRlbHBheSU1QyU1Q01vZGVscyU1QyU1Q1BheW1lbnQlNUMlNUNQYXlwYWwlMjIlMkMlMjJpZCUyMiUzQSUyMmJhOGEzY2I0NWI5MzA1NGFhYTRjNGQ4MzMyYTI4NTIzJTIyJTJDJTIyaXNBY3RpdmUlMjIlM0ElMjIxJTIyJTJDJTIydGl0bGUlMjIlM0ElMjJQYXlwYWwlMjIlMkMlMjJwYXltZW50VHlwZSUyMiUzQSUyMkQzJTVDJTVDSGVpZGVscGF5JTVDJTVDTW9kZWxzJTVDJTVDU2V0dGluZ3MlNUMlNUNDaGFubmVscyU1QyU1Q1BheXBhbCUyMiUyQyUyMmNoYW5uZWwlMjIlM0ElMjIzMUhBMDdCQzgxNDJDNUExNzE3NDlBNjBEOTc5QjZFNCUyMiUyQyUyMnRyYW5zYWN0aW9uVHlwZSUyMiUzQSUyMiUyMiUyQyUyMmlzVGVzdENvbmZpZyUyMiUzQSUyMjElMjIlMkMlMjJveGlkcGF5bWVudElkcyUyMiUzQSU1QiU1RCUyQyUyMnNraXBQcm9wZXJ0aWVzJTIyJTNBJTVCJTIyb3hpZHBheW1lbnRJZHMlMjIlMkMlMjJza2lwUHJvcGVydGllcyUyMiUyQyUyMmhlaWRlbHBheVBheW1lbnRDbGFzc25hbWUlMjIlNUQlN0QlMjIlM0JzJTNBMzIlM0ElMjIyNTA2ODkyODAyNzAzN2E0MzI2YWQxYTI0Zjg0MDcxOCUyMiUzQnMlM0E0MDYlM0ElMjIlN0IlMjJoZWlkZWxwYXlQYXltZW50Q2xhc3NuYW1lJTIyJTNBJTIyRDMlNUMlNUNIZWlkZWxwYXklNUMlNUNNb2RlbHMlNUMlNUNQYXltZW50JTVDJTVDU29mb3J0dWViZXJ3ZWlzdW5nJTIyJTJDJTIyaWQlMjIlM0ElMjIyNTA2ODkyODAyNzAzN2E0MzI2YWQxYTI0Zjg0MDcxOCUyMiUyQyUyMmlzQWN0aXZlJTIyJTNBJTIyMSUyMiUyQyUyMnRpdGxlJTIyJTNBJTIyU29mb3J0JTIyJTJDJTIycGF5bWVudFR5cGUlMjIlM0ElMjJEMyU1QyU1Q0hlaWRlbHBheSU1QyU1Q01vZGVscyU1QyU1Q1NldHRpbmdzJTVDJTVDQ2hhbm5lbHMlNUMlNUNTb2ZvcnQlMjIlMkMlMjJjaGFubmVsJTIyJTNBJTIyMzFIQTA3QkM4MTQyQzVBMTcxNzQ5Q0RBQTQzMzY1RDIlMjIlMkMlMjJ0cmFuc2FjdGlvblR5cGUlMjIlM0ElMjIlMjIlMkMlMjJpc1Rlc3RDb25maWclMjIlM0ElMjIxJTIyJTJDJTIyb3hpZHBheW1lbnRJZHMlMjIlM0ElNUIlNUQlMkMlMjJza2lwUHJvcGVydGllcyUyMiUzQSU1QiUyMm94aWRwYXltZW50SWRzJTIyJTJDJTIyc2tpcFByb3BlcnRpZXMlMjIlMkMlMjJoZWlkZWxwYXlQYXltZW50Q2xhc3NuYW1lJTIyJTVEJTdEJTIyJTNCcyUzQTMyJTNBJTIyYmRkYjU3YTQzNGY0ZTExNTZiODc4OGY5NWFlMWFiYTMlMjIlM0JzJTNBNDM5JTNBJTIyJTdCJTIyaGVpZGVscGF5UGF5bWVudENsYXNzbmFtZSUyMiUzQSUyMkQzJTVDJTVDSGVpZGVscGF5JTVDJTVDTW9kZWxzJTVDJTVDUGF5bWVudCU1QyU1Q0dpcm9wYXklMjIlMkMlMjJpZCUyMiUzQSUyMmJkZGI1N2E0MzRmNGUxMTU2Yjg3ODhmOTVhZTFhYmEzJTIyJTJDJTIyaXNBY3RpdmUlMjIlM0ElMjIxJTIyJTJDJTIydGl0bGUlMjIlM0ElMjJHaXJvcGF5JTIyJTJDJTIycGF5bWVudFR5cGUlMjIlM0ElMjJEMyU1QyU1Q0hlaWRlbHBheSU1QyU1Q01vZGVscyU1QyU1Q1NldHRpbmdzJTVDJTVDQ2hhbm5lbHMlNUMlNUNHaXJvcGF5JTIyJTJDJTIyY2hhbm5lbCUyMiUzQSUyMjMxSEEwN0JDODE0MkM1QTE3MTc0MDE2NkFGMjc3RTAzJTIyJTJDJTIydHJhbnNhY3Rpb25UeXBlJTIyJTNBJTIyJTIyJTJDJTIyaXNUZXN0Q29uZmlnJTIyJTNBJTIyMSUyMiUyQyUyMm94aWRwYXltZW50SWRzJTIyJTNBJTVCJTVEJTJDJTIyc2tpcFByb3BlcnRpZXMlMjIlM0ElNUIlMjJveGlkcGF5bWVudElkcyUyMiUyQyUyMnNraXBQcm9wZXJ0aWVzJTIyJTJDJTIyaGVpZGVscGF5UGF5bWVudENsYXNzbmFtZSUyMiU1RCUyQyUyMm94aWQlMjIlM0ElMjJiZGRiNTdhNDM0ZjRlMTE1NmI4Nzg4Zjk1YWUxYWJhMyUyMiU3RCUyMiUzQnMlM0EzMiUzQSUyMjM5OGQ4YjhiNWUzZDAxOGY5YzE0M2UwOGNjZjJkMDI2JTIyJTNCcyUzQTQ1MSUzQSUyMiU3QiUyMmhlaWRlbHBheVBheW1lbnRDbGFzc25hbWUlMjIlM0ElMjJEMyU1QyU1Q0hlaWRlbHBheSU1QyU1Q01vZGVscyU1QyU1Q1BheW1lbnQlNUMlNUNQb3N0ZmluYW5jZSUyMiUyQyUyMmlkJTIyJTNBJTIyMzk4ZDhiOGI1ZTNkMDE4ZjljMTQzZTA4Y2NmMmQwMjYlMjIlMkMlMjJpc0FjdGl2ZSUyMiUzQSUyMjElMjIlMkMlMjJ0aXRsZSUyMiUzQSUyMlBvc3RmaW5hbmNlJTIyJTJDJTIycGF5bWVudFR5cGUlMjIlM0ElMjJEMyU1QyU1Q0hlaWRlbHBheSU1QyU1Q01vZGVscyU1QyU1Q1NldHRpbmdzJTVDJTVDQ2hhbm5lbHMlNUMlNUNQb3N0ZmluYW5jZSUyMiUyQyUyMmNoYW5uZWwlMjIlM0ElMjIzMUhBMDdCQzgxN0U1Q0Y3NDYyNDc0NjkyNTcwM0E1MSUyMiUyQyUyMnRyYW5zYWN0aW9uVHlwZSUyMiUzQSUyMiUyMiUyQyUyMmlzVGVzdENvbmZpZyUyMiUzQSUyMjElMjIlMkMlMjJveGlkcGF5bWVudElkcyUyMiUzQSU1QiU1RCUyQyUyMnNraXBQcm9wZXJ0aWVzJTIyJTNBJTVCJTIyb3hpZHBheW1lbnRJZHMlMjIlMkMlMjJza2lwUHJvcGVydGllcyUyMiUyQyUyMmhlaWRlbHBheVBheW1lbnRDbGFzc25hbWUlMjIlNUQlMkMlMjJveGlkJTIyJTNBJTIyMzk4ZDhiOGI1ZTNkMDE4ZjljMTQzZTA4Y2NmMmQwMjYlMjIlN0QlMjIlM0JzJTNBMzIlM0ElMjJhNDdhNjgwMThhYWI2MTllOTk1ZTY3NjQ5NmM0ZGQyZSUyMiUzQnMlM0E1NTQlM0ElMjIlN0IlMjJzRDNIcEhGT3JkZXJQZW5kaW5nVGltZSUyMiUzQW51bGwlMkMlMjJzRDNIcEhGT3JkZXJDYW5jZWxUeXBlJTIyJTNBbnVsbCUyQyUyMnNEM0hwSEZPcmRlckxpbWl0JTIyJTNBbnVsbCUyQyUyMmJsRDNIcEhGU2V0WmVyb09yZGVyTnVtYmVyJTIyJTNBZmFsc2UlMkMlMjJoZWlkZWxwYXlQYXltZW50Q2xhc3NuYW1lJTIyJTNBJTIyRDMlNUMlNUNIZWlkZWxwYXklNUMlNUNNb2RlbHMlNUMlNUNQYXltZW50JTVDJTVDSWRlYWwlMjIlMkMlMjJpZCUyMiUzQSUyMmE0N2E2ODAxOGFhYjYxOWU5OTVlNjc2NDk2YzRkZDJlJTIyJTJDJTIyaXNBY3RpdmUlMjIlM0ElMjIxJTIyJTJDJTIydGl0bGUlMjIlM0ElMjJpRGVhbCUyMiUyQyUyMnBheW1lbnRUeXBlJTIyJTNBJTIyRDMlNUMlNUNIZWlkZWxwYXklNUMlNUNNb2RlbHMlNUMlNUNTZXR0aW5ncyU1QyU1Q0NoYW5uZWxzJTVDJTVDSWRlYWwlMjIlMkMlMjJjaGFubmVsJTIyJTNBJTIyMzFIQTA3QkM4MTQyQzVBMTcxNzQ0QjU2RTYxMjgxRTUlMjIlMkMlMjJ0cmFuc2FjdGlvblR5cGUlMjIlM0ElMjIlMjIlMkMlMjJpc1Rlc3RDb25maWclMjIlM0ElMjIxJTIyJTJDJTIyb3hpZHBheW1lbnRJZHMlMjIlM0ElNUIlNUQlMkMlMjJza2lwUHJvcGVydGllcyUyMiUzQSU1QiUyMm94aWRwYXltZW50SWRzJTIyJTJDJTIyc2tpcFByb3BlcnRpZXMlMjIlMkMlMjJoZWlkZWxwYXlQYXltZW50Q2xhc3NuYW1lJTIyJTVEJTJDJTIyb3hpZCUyMiUzQSUyMmE0N2E2ODAxOGFhYjYxOWU5OTVlNjc2NDk2YzRkZDJlJTIyJTdEJTIyJTNCJTdE';
            }
            $modProfile->setId($oxid);
            $modProfile->assign([
                    'oxactive'   => '1',
                    'oxtitle'    => 'json configuration',
                    'oxmodid'    => $this->sModKey,
                    'oxvalue'    => $oxValue,
                ]);

            if ($modProfile->save()) {
                $blReturn = true;
            }
        }
        $this->_changeToShop($sCurrentShopid);

        return $blReturn;
    }
}
