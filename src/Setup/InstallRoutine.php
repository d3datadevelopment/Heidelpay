<?php
namespace D3\Heidelpay\Setup;

use D3\Heidelpay\Models\Transactionlog\Reader\Heidelpay;
use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\d3str;
use D3\ModCfg\Application\Model\Install\d3install_updatebase;
use D3\ModCfg\Application\Model\Installwizzard\d3installconfirmmessage;
use D3\ModCfg\Application\Model\Transactionlog\d3transactionlog;
use OxidEsales\Eshop\Core\DatabaseProvider;
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
    public $sModVersion = '6.0.1.0';

    /**
     * @var string
     */
    public $sMinModCfgVersion = '5.1.0.1';

    /** @var string @deprecated since 2016-04-13 */
    public $sModRevision = '6010';

    /**
     * @var string
     */
    public $sBaseConf = '--------------------------------------------------------------------------------
6y1v2==QnlPWkJ0SE81UG5Ca3VlVERJVEd1Vzg0czVydzRHQ2ZRb1VVN1hHN1cybjJVM01vUjR2b3g5c
ktaSEhvd0s1Y1RjeG1aR1VkYTI2TFZSNGVRbU1wWEVUcDRMR0o0V0wvMXc2dEJ5VEJtczZLL20zM1JSO
W9XcDYyd01Ya2QrM3k2RjRESGg2cXNORVhkWTFaTlQ3Q2RES0E5WjNwbVJZOVRaOUxUTllWZFRNNkdYQ
0RvbGZoMmZKVmVubFNhVkVxaG1TNG8xQndzMlVtR1lLVUJaSnV4cWFGNFlyQ3g4bUtLSTRtTU9JdzNye
TROTFZrMHF1M2ZIRkVPa3hzL3ZHSGQ3TWhqOXl0SS9rVE1jNG5tOXFSNHQvbG5jUXg3WnRZTHVNNW1nS
EpneU1qRlBPMHI5RU83cVl4clZXREpnUWY0S2lCQXg0TkJMOVdvb1pHb0RDTDdRPT0=
--------------------------------------------------------------------------------';

    /**
     * @var string
     */
    public $sRequirements = '';

    /**
     * @var string
     */
    public $sBaseValue = 'TyUzQTglM0ElMjJzdGRDbGFzcyUyMiUzQTM4JTNBJTdCcyUzQTM0JTNBJTIyZDNfY2ZnX21vZF9fZDNoZWlkZWxwYXlfYmxUZXN0bW9kZSUyMiUzQnMlM0ExJTNBJTIyMSUyMiUzQnMlM0EzOSUzQSUyMmQzX2NmZ19tb2RfX2QzaGVpZGVscGF5X3NTZWN1cml0eVNlbmRlciUyMiUzQnMlM0EzMiUzQSUyMjMxSEEwN0JDODE0MkM1QTE3MTc0NUQwMEFENjNEMTgyJTIyJTNCcyUzQTMxJTNBJTIyZDNfY2ZnX21vZF9fZDNoZWlkZWxwYXlfc1VzZXJJRCUyMiUzQnMlM0EzMiUzQSUyMjMxaGEwN2JjODE0MmM1YTE3MTc0NGU1YWVmMTFmZmQzJTIyJTNCcyUzQTMzJTNBJTIyZDNfY2ZnX21vZF9fZDNoZWlkZWxwYXlfc1Bhc3N3b3JkJTIyJTNCcyUzQTglM0ElMjI5MzE2N0RFNyUyMiUzQnMlM0EzNCUzQSUyMmQzX2NmZ19tb2RfX2QzaGVpZGVscGF5X3NUcmFuc1R5cGUlMjIlM0JzJTNBNCUzQSUyMmF1dGglMjIlM0JzJTNBMzIlM0ElMjJkM19jZmdfbW9kX19kM2hlaWRlbHBheV9zQ2hhbm5lbCUyMiUzQnMlM0EzMiUzQSUyMjMxSEEwN0JDODE0MkM1QTE3MTc0OUE2MEQ5NzlCNkU0JTIyJTNCcyUzQTQwJTNBJTIyZDNfY2ZnX21vZF9fZDNoZWlkZWxwYXlfc0NoYW5uZWxfX3NvZm9ydCUyMiUzQnMlM0EzMiUzQSUyMjMxSEEwN0JDODE0MkM1QTE3MTc0OUNEQUE0MzM2NUQyJTIyJTNCcyUzQTQwJTNBJTIyZDNfY2ZnX21vZF9fZDNoZWlkZWxwYXlfc0NDSW5wdXRQb3NpdGlvbiUyMiUzQnMlM0E1JTNBJTIyc3RlcDMlMjIlM0JzJTNBMzclM0ElMjJkM19jZmdfbW9kX19kM2hlaWRlbHBheV9ibERlYml0VW5tYXNrJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTQyJTNBJTIyZDNfY2ZnX21vZF9fZDNoZWlkZWxwYXlfYmxTaG93U3RvcmVkSFBEYXRhJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTM5JTNBJTIyZDNfY2ZnX21vZF9fZDNoZWlkZWxwYXlfYmxTZXJ2aWNlRXJyb3JzJTIyJTNCcyUzQTElM0ElMjIxJTIyJTNCcyUzQTM5JTNBJTIyZDNfY2ZnX21vZF9fZDNoZWlkZWxwYXlfc1Rlc3RQT1NUU2VydmVyJTIyJTNCcyUzQTQxJTNBJTIyaHR0cHMlM0ElMkYlMkZ0ZXN0LWhlaWRlbHBheS5ocGNndy5uZXQlMkZzZ3clMkZndHd1JTIyJTNCcyUzQTM5JTNBJTIyZDNfY2ZnX21vZF9fZDNoZWlkZWxwYXlfc0xpdmVQT1NUU2VydmVyJTIyJTNCcyUzQTM2JTNBJTIyaHR0cHMlM0ElMkYlMkZoZWlkZWxwYXkuaHBjZ3cubmV0JTJGc2d3JTJGZ3R3dSUyMiUzQnMlM0EzOCUzQSUyMmQzX2NmZ19tb2RfX2QzaGVpZGVscGF5X3NUZXN0WE1MU2VydmVyJTIyJTNCcyUzQTQwJTNBJTIyaHR0cHMlM0ElMkYlMkZ0ZXN0LWhlaWRlbHBheS5ocGNndy5uZXQlMkZzZ3clMkZ4bWwlMjIlM0JzJTNBMzglM0ElMjJkM19jZmdfbW9kX19kM2hlaWRlbHBheV9zTGl2ZVhNTFNlcnZlciUyMiUzQnMlM0EzNSUzQSUyMmh0dHBzJTNBJTJGJTJGaGVpZGVscGF5LmhwY2d3Lm5ldCUyRnNndyUyRnhtbCUyMiUzQnMlM0EzOCUzQSUyMmQzX2NmZ19tb2RfX2QzaGVpZGVscGF5X3NUZXN0U2VydmVyVHlwJTIyJTNCcyUzQTE0JTNBJTIyQ09OTkVDVE9SX1RFU1QlMjIlM0JzJTNBMzglM0ElMjJkM19jZmdfbW9kX19kM2hlaWRlbHBheV9zVGVzdEVycm9yQ29kZSUyMiUzQnMlM0EwJTNBJTIyJTIyJTNCcyUzQTM5JTNBJTIyZDNfY2ZnX21vZF9fZDNoZWlkZWxwYXlfc1Rlc3RSZXR1cm5Db2RlJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMzYlM0ElMjJkM19jZmdfbW9kX19kM2hlaWRlbHBheV9pQ3VybFRpbWVPdXQlMjIlM0JzJTNBMiUzQSUyMjUwJTIyJTNCcyUzQTMyJTNBJTIyZDNfY2ZnX21vZF9fZDNoZWlkZWxwYXlfYUNDVHlwZXMlMjIlM0JzJTNBNDYlM0ElMjJhJTNBMiUzQSU3QnMlM0E0JTNBJTIyVklTQSUyMiUzQnMlM0ExJTNBJTIyMSUyMiUzQnMlM0E2JTNBJTIyTUFTVEVSJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCJTdEJTIyJTNCcyUzQTMyJTNBJTIyZDNfY2ZnX21vZF9fZDNoZWlkZWxwYXlfYUREVHlwZXMlMjIlM0JzJTNBNDAlM0ElMjJhJTNBMiUzQSU3QnMlM0EyJTNBJTIyREUlMjIlM0JzJTNBMSUzQSUyMjElMjIlM0JzJTNBMiUzQSUyMkFUJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCJTdEJTIyJTNCcyUzQTM2JTNBJTIyZDNfY2ZnX21vZF9fZDNoZWlkZWxwYXlfYVBheW1lbnRMaXN0JTIyJTNCcyUzQTc3MyUzQSUyMmElM0ExMiUzQSU3QnMlM0E4JTNBJTIyYmlsbHNhZmUlMjIlM0JzJTNBMzglM0ElMjJkM19kM2hlaWRlbHBheV9tb2RlbHNfcGF5bWVudF9iaWxsc2FmZSUyMiUzQnMlM0ExMCUzQSUyMmNyZWRpdGNhcmQlMjIlM0JzJTNBNDAlM0ElMjJkM19kM2hlaWRlbHBheV9tb2RlbHNfcGF5bWVudF9jcmVkaXRjYXJkJTIyJTNCcyUzQTklM0ElMjJkZWJpdGNhcmQlMjIlM0JzJTNBMzklM0ElMjJkM19kM2hlaWRlbHBheV9tb2RlbHNfcGF5bWVudF9kZWJpdGNhcmQlMjIlM0JzJTNBMTElM0ElMjJkaXJlY3RkZWJpdCUyMiUzQnMlM0E0MSUzQSUyMmQzX2QzaGVpZGVscGF5X21vZGVsc19wYXltZW50X2RpcmVjdGRlYml0JTIyJTNCcyUzQTMlM0ElMjJlcHMlMjIlM0JzJTNBMzMlM0ElMjJkM19kM2hlaWRlbHBheV9tb2RlbHNfcGF5bWVudF9lcHMlMjIlM0JzJTNBNyUzQSUyMmdpcm9wYXklMjIlM0JzJTNBMzclM0ElMjJkM19kM2hlaWRlbHBheV9tb2RlbHNfcGF5bWVudF9naXJvcGF5JTIyJTNCcyUzQTUlM0ElMjJpZGVhbCUyMiUzQnMlM0EzNSUzQSUyMmQzX2QzaGVpZGVscGF5X21vZGVsc19wYXltZW50X2lkZWFsJTIyJTNCcyUzQTYlM0ElMjJwYXlwYWwlMjIlM0JzJTNBMzYlM0ElMjJkM19kM2hlaWRlbHBheV9tb2RlbHNfcGF5bWVudF9wYXlwYWwlMjIlM0JzJTNBMTAlM0ElMjJwcmVwYXltZW50JTIyJTNCcyUzQTQwJTNBJTIyZDNfZDNoZWlkZWxwYXlfbW9kZWxzX3BheW1lbnRfcHJlcGF5bWVudCUyMiUzQnMlM0ExOCUzQSUyMnNvZm9ydHVlYmVyd2Vpc3VuZyUyMiUzQnMlM0E0OCUzQSUyMmQzX2QzaGVpZGVscGF5X21vZGVsc19wYXltZW50X3NvZm9ydHVlYmVyd2Vpc3VuZyUyMiUzQnMlM0E3JTNBJTIyc2VjdXJlZCUyMiUzQnMlM0E0NSUzQSUyMmQzX2QzaGVpZGVscGF5X21vZGVsc19wYXltZW50X2ludm9pY2Vfc2VjdXJlZCUyMiUzQnMlM0E5JTNBJTIydW5zZWN1cmVkJTIyJTNCcyUzQTQ3JTNBJTIyZDNfZDNoZWlkZWxwYXlfbW9kZWxzX3BheW1lbnRfaW52b2ljZV91bnNlY3VyZWQlMjIlM0IlN0QlMjIlM0JzJTNBNDIlM0ElMjJkM19jZmdfbW9kX19kM2hlaWRlbHBheV9zQ2hhbm5lbF9fYmlsbHNhZmUlMjIlM0JzJTNBMzIlM0ElMjIzMUhBMDdCQzgxNDJFRTZEMDI3MTVGNENBOTdEREQ4QiUyMiUzQnMlM0E0NCUzQSUyMmQzX2NmZ19tb2RfX2QzaGVpZGVscGF5X3NDaGFubmVsX19hc3N1cmVkaW52JTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBNDAlM0ElMjJkM19jZmdfbW9kX19kM2hlaWRlbHBheV9zQ2hhbm5lbF9fcGF5cGFsJTIyJTNCcyUzQTMyJTNBJTIyMzFIQTA3QkM4MTI0MzY1Q0E0MUQ0QkRBNzlDQ0NEMjIlMjIlM0JzJTNBMzYlM0ElMjJkM19jZmdfbW9kX19kM2hlaWRlbHBheV9zVkFUcmFuc1R5cGUlMjIlM0JzJTNBNCUzQSUyMmF1dGglMjIlM0JzJTNBMzclM0ElMjJkM19jZmdfbW9kX19kM2hlaWRlbHBheV9zQ2hhbm5lbF9fZXBzJTIyJTNCcyUzQTAlM0ElMjIlMjIlM0JzJTNBMzglM0ElMjJkM19jZmdfbW9kX19kM2hlaWRlbHBheV9zQ2hhbm5lbF9fZ2lybyUyMiUzQnMlM0EzMiUzQSUyMjMxSEEwN0JDODE0MkM1QTE3MTc0MDE2NkFGMjc3RTAzJTIyJTNCcyUzQTM5JTNBJTIyZDNfY2ZnX21vZF9fZDNoZWlkZWxwYXlfc0NoYW5uZWxfX2lkZWFsJTIyJTNCcyUzQTMyJTNBJTIyMzFIQTA3QkM4MTQyQzVBMTcxNzQ0QjU2RTYxMjgxRTUlMjIlM0JzJTNBNDYlM0ElMjJkM19jZmdfbW9kX19kM2hlaWRlbHBheV9vcmRlckV4ZWN1dGVQb3N0RmllbGRzJTIyJTNCcyUzQTEwMiUzQSUyMm9yZF9hZ2IlMjAlM0QlM0UlMjAxJTBEJTBBb3JkX2N1c3RpbmZvJTIwJTNEJTNFJTIwMSUwRCUwQW94ZG93bmxvYWRhYmxlcHJvZHVjdHNhZ3JlZW1lbnQlMjAlM0QlM0UlMjAxJTBEJTBBb3hzZXJ2aWNlcHJvZHVjdHNhZ3JlZW1lbnQlMjAlM0QlM0UlMjAxJTIyJTNCcyUzQTM2JTNBJTIyZDNfY2ZnX21vZF9fZDNoZWlkZWxwYXlfYmxDYXJkc1VzZVJHJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTQ0JTNBJTIyZDNfY2ZnX21vZF9fZDNoZWlkZWxwYXlfc0NoYW5uZWxfX3ByemVsZXd5MjQlMjIlM0JzJTNBMzIlM0ElMjIzMUhBMDdCQzgxMUJBRjlCRUQxMTI5RDExNjBCRjMxOCUyMiUzQnMlM0EzNSUzQSUyMmQzX2NmZ19tb2RfX3NEM0hwSEZPcmRlclBlbmRpbmdUaW1lJTIyJTNCcyUzQTIlM0ElMjIyNiUyMiUzQnMlM0EyOSUzQSUyMmQzX2NmZ19tb2RfX3NEM0hwSEZPcmRlckxpbWl0JTIyJTNCcyUzQTMlM0ElMjIxMDAlMjIlM0JzJTNBMzQlM0ElMjJkM19jZmdfbW9kX19zRDNIcEhGT3JkZXJDYW5jZWxUeXBlJTIyJTNCcyUzQTEyJTNBJTIyQ0FOQ0VMX09SREVSJTIyJTNCcyUzQTM4JTNBJTIyZDNfY2ZnX21vZF9fYmxEM0hwSEZTZXRaZXJvT3JkZXJOdW1iZXIlMjIlM0JzJTNBMSUzQSUyMjAlMjIlM0JzJTNBNDQlM0ElMjJkM19jZmdfbW9kX19kM2hlaWRlbHBheV9zQ2hhbm5lbF9fbWFzdGVycGFzcyUyMiUzQnMlM0EzMiUzQSUyMjMxSEEwN0JDODE0OTQ4RTcyRUY2NjlDQTNCQjE0MzFGJTIyJTNCcyUzQTM2JTNBJTIyZDNfY2ZnX21vZF9fZDNoZWlkZWxwYXlfc1dUVHJhbnNUeXBlJTIyJTNCcyUzQTQlM0ElMjJhdXRoJTIyJTNCJTdE';

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
            'check' => 'hasOldOxconfigEntries',               // Update 3.2.3.1 XE4 => 4.0.0.0 XE4
            'do'    => 'migrateOldOxconfigEntries'
        ),
        array(
            'check' => 'checkModCfgItemExist', // Prueft auf Datenbankeintrag
            'do'    => 'updateModCfgItemExist'
        ),
        array(
            'check' => 'checkTableOxpaylogsExist', // Prueft ob alte Tabellen geloescht werden muessen
            'do'    => 'dropTableOxpaylogsExist'   // Update 3.2.3.1 XE4 => 4.0.0.0 XE4
        ),
        array(
            'check' => 'checkTableOxobject2heidelpayExist', // Prueft ob alte Tabellen geloescht werden muessen
            'do'    => 'migrateOldPaymentAssignments'   // Update 3.2.3.1 XE4 => 4.0.0.0 XE4
        ),
        array(
            'check' => 'checkRenameD3Tables', // Prueft auf umzubenennende Tabellen
            'do'    => 'renameD3Tables'       // Update 3.2.3.1 XE4 => 4.0.0.0 XE4
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
            'check' => 'hasLegacyAssignments',
            'do'    => 'updateLegacyAssigments'
        ),
        array(
            'check' => 'ishpprepaymentdataTableExist',
            'do'    => 'deletehpprepaymentdataTableExist'
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
            'check' => 'hasOldModuleItems', //nicht vorhandene Moduldatei-Eintraege entfernen
            'do' => 'deleteOldModuleItems'
        ),
        array(
            'check' => 'checkFields',
            'do'    => 'fixFields'
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

    // Standardwerte zum umbenennen Tables
    /**
     * @var array
     */
    public $aRenameTables = array(
        array(
            'mOldTableNames' => 'oxhpuid', // is case insensitive
            'sTableName'     => 'd3hpuid',
        ),
        array(
            'mOldTableNames' => 'oxhperrortexts', // is case insensitive
            'sTableName'     => 'd3hperrortexts',
        ),
    );

    // Standardwerte fuer checkFields(), _addTable() und fixFields()
    /**
     * @var array
     */
    public $aFields = array(
        'OXID_d3hpuid'              => array(
            'sTableName'  => 'd3hpuid',
            'sFieldName'  => 'OXID',
            'sType'       => 'VARCHAR(32)',
            'blNull'      => false,
            'sDefault'    => '',
            'sComment'    => 'D3 Heidelpay',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'OXUSERID_d3hpuid'          => array(
            'sTableName'  => 'd3hpuid',
            'sFieldName'  => 'OXUSERID',
            'sType'       => 'VARCHAR(32)',
            'blNull'      => false,
            'sDefault'    => '',
            'sComment'    => 'D3 Heidelpay',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'OXPAYMENTID_d3hpuid'       => array(
            'sTableName'  => 'd3hpuid',
            'sFieldName'  => 'OXPAYMENTID',
            'sType'       => 'VARCHAR(32)',
            'blNull'      => false,
            'sDefault'    => '',
            'sComment'    => 'D3 Heidelpay',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'OXUID_d3hpuid'             => array(
            'sTableName'  => 'd3hpuid',
            'sFieldName'  => 'OXUID',
            'sType'       => 'VARCHAR(50)',
            'blNull'      => false,
            'sDefault'    => '',
            'sComment'    => 'D3 Heidelpay',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'OXTIME_d3hpuid'            => array(
            'sTableName'  => 'd3hpuid',
            'sFieldName'  => 'OXTIME',
            'sType'       => 'DATETIME',
            'blNull'      => false,
            'sDefault'    => '0000-00-00 00:00:00',
            'sComment'    => 'D3 Heidelpay',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'OXPAYMENTDATA_d3hpuid'     => array(
            'sTableName'  => 'd3hpuid',
            'sFieldName'  => 'OXPAYMENTDATA',
            'sType'       => 'TEXT',
            'blNull'      => false,
            'sDefault'    => '',
            'sComment'    => 'D3 Heidelpay',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'OXID_d3hperrortexts'       => array(
            'sTableName'  => 'd3hperrortexts',
            'sFieldName'  => 'OXID',
            'sType'       => 'VARCHAR(32)',
            'blNull'      => false,
            'sDefault'    => '',
            'sComment'    => 'D3 Heidelpay',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'OXCODE_d3hperrortexts'     => array(
            'sTableName'  => 'd3hperrortexts',
            'sFieldName'  => 'OXCODE',
            'sType'       => 'VARCHAR(20)',
            'blNull'      => false,
            'sDefault'    => '',
            'sComment'    => 'D3 Heidelpay',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'OXTYPE_d3hperrortexts'     => array(
            'sTableName'  => 'd3hperrortexts',
            'sFieldName'  => 'OXTYPE',
            'sType'       => 'INT(1)',
            'blNull'      => false,
            'sDefault'    => '0',
            'sComment'    => 'D3 Heidelpay',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'OXTITLE_d3hperrortexts'    => array(
            'sTableName'  => 'd3hperrortexts',
            'sFieldName'  => 'OXTITLE',
            'sType'       => 'VARCHAR(255)',
            'blNull'      => false,
            'sDefault'    => '',
            'sComment'    => 'D3 Heidelpay',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'OXTITLE_1_d3hperrortexts'  => array(
            'sTableName'  => 'd3hperrortexts',
            'sFieldName'  => 'OXTITLE_1',
            'sType'       => 'VARCHAR(255)',
            'blNull'      => false,
            'sDefault'    => '',
            'sComment'    => 'D3 Heidelpay',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'OXREALTEXT_d3hperrortexts' => array(
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

    // Standardwerte fuer checkIndizes() und fixIndizes()
    /**
     * @var array
     */
    public $aIndizes = array(
        array(
            'sTableName'  => 'd3hpuid',
            'sType'       => 'PRIMARY',
            'sName'       => 'PRIMARY',
            'aFields'     => array(
                'OXID' => 'OXID',
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

    /**
     * @var array
     */
    public $aMapArraySettings = array(
        'Heidelpay_blCCType__AMEX'         => 'd3heidelpay_aCCTypes',
        'Heidelpay_blCCType__DINERS'       => 'd3heidelpay_aCCTypes',
        'Heidelpay_blCCType__DISCOVER'     => 'd3heidelpay_aCCTypes',
        'Heidelpay_blCCType__JCB'          => 'd3heidelpay_aCCTypes',
        'Heidelpay_blCCType__MASTER'       => 'd3heidelpay_aCCTypes',
        'Heidelpay_blCCType__VISA'         => 'd3heidelpay_aCCTypes',
        'Heidelpay_blDCType__4B'           => 'd3heidelpay_aDCTypes',
        'Heidelpay_blDCType__CARTEBLEUE'   => 'd3heidelpay_aDCTypes',
        'Heidelpay_blDCType__EURO6000'     => 'd3heidelpay_aDCTypes',
        'Heidelpay_blDCType__MAESTRO'      => 'd3heidelpay_aDCTypes',
        'Heidelpay_blDCType__POSTEPAY'     => 'd3heidelpay_aDCTypes',
        'Heidelpay_blDCType__SERVIRED'     => 'd3heidelpay_aDCTypes',
        'Heidelpay_blDCType__SOLO'         => 'd3heidelpay_aDCTypes',
        'Heidelpay_blDCType__VISAELECTRON' => 'd3heidelpay_aDCTypes',
        'Heidelpay_blDDType__AT'           => 'd3heidelpay_aDDTypes',
        'Heidelpay_blDDType__DE'           => 'd3heidelpay_aDDTypes',
    );

    /**
     * @var array
     */
    public $aMapSettings = array(
        'Heidelpay_blDebitUnmask'          => 'd3_cfg_mod__d3heidelpay_blDebitUnmask',
        'Heidelpay_blServiceErrors'        => 'd3_cfg_mod__d3heidelpay_blServiceErrors',
        'Heidelpay_blShowStoredHPData'     => 'd3_cfg_mod__d3heidelpay_blShowStoredHPData',
        'Heidelpay_blTestmode'             => 'd3_cfg_mod__d3heidelpay_blTestmode',
        'Heidelpay_iCurlTimeOut'           => 'd3_cfg_mod__d3heidelpay_iCurlTimeOut',
        'Heidelpay_sChannel'               => 'd3_cfg_mod__d3heidelpay_sChannel',
        'Heidelpay_sChannel__eps'          => 'd3_cfg_mod__d3heidelpay_sChannel__eps',
        'Heidelpay_sChannel__giro'         => 'd3_cfg_mod__d3heidelpay_sChannel__giro',
        'Heidelpay_sChannel__ideal'        => 'd3_cfg_mod__d3heidelpay_sChannel__ideal',
        'Heidelpay_sChannel__sofort'       => 'd3_cfg_mod__d3heidelpay_sChannel__sofort',
        'Heidelpay_sCCInputPosition'       => 'd3_cfg_mod__d3heidelpay_sCCInputPosition',
        'Heidelpay_sPassword'              => 'd3_cfg_mod__d3heidelpay_sPassword',
        'Heidelpay_sSecuritySender'        => 'd3_cfg_mod__d3heidelpay_sSecuritySender',
        'Heidelpay_sTransType'             => 'd3_cfg_mod__d3heidelpay_sTransType',
        'Heidelpay_sUserID'                => 'd3_cfg_mod__d3heidelpay_sUserID',
        'Heidelpay_blCCType__AMEX'         => 'AMEX',
        'Heidelpay_blCCType__DINERS'       => 'DINERS',
        'Heidelpay_blCCType__DISCOVER'     => 'DISCOVER',
        'Heidelpay_blCCType__JCB'          => 'JCB',
        'Heidelpay_blCCType__MASTER'       => 'MASTER',
        'Heidelpay_blCCType__VISA'         => 'VISA',
        'Heidelpay_blDCType__4B'           => '4B',
        'Heidelpay_blDCType__CARTEBLEUE'   => 'CARTEBLEUE',
        'Heidelpay_blDCType__EURO6000'     => 'EURO6000',
        'Heidelpay_blDCType__MAESTRO'      => 'MAESTRO',
        'Heidelpay_blDCType__POSTEPAY'     => 'POSTEPAY',
        'Heidelpay_blDCType__SERVIRED'     => 'SERVIRED',
        'Heidelpay_blDCType__SOLO'         => 'SOLO',
        'Heidelpay_blDCType__VISAELECTRON' => 'VISAELECTRON',
        'Heidelpay_blDDType__AT'           => 'AT',
        'Heidelpay_blDDType__DE'           => 'DE',
    );

    /**
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
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
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
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
            'SELECT d3transactionlog.oxid as oxid FROM d3hpuid
LEFT JOIN d3transactionlog ON d3hpuid.`OXUID` = d3transactionlog.D3REFERENCE
WHERE d3transactionlog.oxid IS NOT NULL;'
        );

        $deleteIds = array();
        /** @var Heidelpay $reader */
        $reader = oxNew(Heidelpay::class);
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
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     */
    public function checkD3hperrortextsItemsExist()
    {
        $blReturn = $this->_checkUpdateFile('d3/heidelpay/Setup/d3hp_errortextsQuerys.php');

        return $blReturn;
    }

    /**
     * @return bool
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function insertD3hperrortextsItemsIfNotExist()
    {
        return $this->_doUpdateFile('d3/heidelpay/Setup/d3hp_errortextsQuerys.php');
    }

    /****************************************************
     * Tabellen anlegen                                 *
     ****************************************************/
    /**
     * @return bool TRUE, if table is missing
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function ishpprepaymentdataTableExist()
    {
        return false == $this->_checkTableNotExist('PrepaymentData')
        || false == $this->_checkTableNotExist('oxhpprepaymentdata');
    }

    /**
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function deletehpprepaymentdataTableExist()
    {
        $blRet = true;

        if (false == $this->_checkTableNotExist('PrepaymentData')) {
            $aRet  = $this->_dropTable('PrepaymentData');
            $blRet = $aRet['blRet'];
            $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
        }

        if (false == $this->_checkTableNotExist('oxhpprepaymentdata')) {
            $aRet  = $this->_dropTable('oxhpprepaymentdata');
            $blRet = $aRet['blRet'];
            $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
        }

        return $blRet;
    }

    /**
     * @return bool TRUE, if table is missing
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function checkD3hpuidTableExist()
    {
        return $this->_checkTableNotExist('d3hpuid');
    }

    /**
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
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
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function checkD3hperrortextsTableExist()
    {
        return $this->_checkTableNotExist('d3hperrortexts');
    }

    /**
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
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

    /****************************************************
     * Tabelle oxcontents & oxpayments                  *
     * if entrys not exist -> insert                    *
     ****************************************************/
    /**
     * @return bool
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     */
    public function checkOxcontentItemsExist()
    {
        $blReturn = $this->_hasExecuteFileQuery('d3/heidelpay/Setup/d3hp_oxcontentsQuerys.php');

        return $blReturn;
    }

    /**
     * @return bool
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function insertOxcontentItemsIfNotExist()
    {
        Registry::getSession()->setVariable('d3hp_update_skip_oxcontents', 1);

        $blReturn = $this->_executeFileQueries('d3/heidelpay/Setup/d3hp_oxcontentsQuerys.php');

        return $blReturn;
    }

    /**
     * @return bool
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     */
    public function checkOxpaymentsItemsExist()
    {
        $blReturn = $this->_checkUpdateFile('d3/heidelpay/Setup/d3hp_oxpaymentsQuerys.php');

        return $blReturn;
    }

    /**
     * @return bool
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function insertOxpaymentsItemsIfNotExist()
    {
        return $this->_doUpdateFile('d3/heidelpay/Setup/d3hp_oxpaymentsQuerys.php');
    }

    /****************************************************
     * Tabelle oxcontents                               *
     * No Autoupdate if exist -> Message                *
     ****************************************************/
    /**
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     */
    public function checkOxcontentEntrysExist()
    {
        $blRet       = false;
        $bSkipUpdate = Registry::getSession()->getVariable('d3hp_update_skip_oxcontents');

        if ($bSkipUpdate) {
            return $blRet;
        }

        foreach ($this->getShopList() as $oShop) {
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

    /****************************************************
     * Update 4.0.1.0 => 4.0.2.0                        *
     *                                                  *
     * UPDATE `d3hperrortexts` SET `OXTYPE` = '2'       *
     * WHERE `OXCODE` = '800.100.153';                  *
     ****************************************************/
    /**
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
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
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
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

    /****************************************************
     * Tabellen umbenennen - 3.2.3.1 => 4.0.0.0         *
     ****************************************************/
    /**
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function checkRenameD3Tables()
    {
        return $this->checkRenameTables();
    }

    /**
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function renameD3Tables()
    {
        /** @param string $sMethodName */
        return $this->fixRenameTables(__METHOD__);
    }

    /****************************************************
     * Alte Tabellen loeschen - 3.2.3.1 => 4.0.0.0       *
     ****************************************************/
    /**
     * @return bool
     * FALSE, if table is missing, so nothing is to do
     * TRUE, if table is not missing, delete it
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function checkTableOxpaylogsExist()
    {
        $blRet = !($this->_checkTableNotExist('oxpaylogs'));

        return $blRet;
    }

    /**
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function dropTableOxpaylogsExist()
    {
        $blRet = true;

        if ($this->checkTableOxpaylogsExist()) {
            $blRet = $this->_dropTable('oxpaylogs');
        }

        return $blRet;
    }

    /**
     * @return bool
     * FALSE, if table is missing, so nothing is to do
     * TRUE, if table is not missing, delete it
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function checkTableOxobject2heidelpayExist()
    {
        $blRet = !($this->_checkTableNotExist('oxobject2heidelpay'));

        return $blRet;
    }

    /**
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function migrateOldPaymentAssignments()
    {
        $blReturn = true;

        $oDb             = DatabaseProvider::getDb(DatabaseProvider::FETCH_MODE_ASSOC);
        $sOriginalShopid = Registry::getConfig()->getShopId();

        foreach ($this->getShopList() as $oShop) {
            /** @var $oShop BaseModel */
            if ($blReturn === false) {
                //if error occured, do not keep working
                continue;
            }

            $sGetAllPaymentAssigments = <<<MYSQL
SELECT oxpaymentid AS oxpaymentid, oxtype AS oxtype
FROM oxobject2heidelpay
WHERE oxshopid = {$oDb->quote($oShop->getId())}
MYSQL;
            $aOldAssigments           = $oDb->getAll($sGetAllPaymentAssigments);
            $this->_changeToShop($oShop->getId());

            if (false == isset($aOldAssigments[0])) {
                continue;
            }

            $oModuleConfiguration = d3_cfg_mod::getNoCache($this->sModKey);
            $this->_convertOldAssignmentsToSettings($aOldAssigments, $oModuleConfiguration);

            $aInsertFields = array(
                'OXVALUE' => array(
                    'content'      => $oModuleConfiguration->getFieldData('oxvalue'),
                    'force_update' => true,
                    'use_quote'    => true,
                )
            );
            $aWhereFields  = array('oxshopid' => $oShop->getId(), 'oxmodid' => $this->sModKey);

            $this->setInitialExecMethod(__METHOD__);
            $blReturn = $this->_updateTableItem2('d3_cfg_mod', $aInsertFields, $aWhereFields);
        }

        $this->_changeToShop($sOriginalShopid);

        if ($blReturn) {
            $blReturn = $this->_dropTable('oxobject2heidelpay');
        }


        return $blReturn;
    }

    /**
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function hasLegacyAssignments()
    {
        $return          = false;
        $sOriginalShopid = Registry::getConfig()->getShopId();

        foreach ($this->getShopList() as $oShop) {
            /** @var $oShop BaseModel */
            $this->_changeToShop($oShop->getId());
            $aOldPayments = (array)unserialize(d3_cfg_mod::getNoCache($this->sModKey)->getValue('d3heidelpay_aPaymentList'));

            foreach ($aOldPayments as $sOldValue) {
                if (in_array(
                    $sOldValue,
                    array(
                        0  => 'IV__billsafe',
                        1  => 'CC',
                        2  => 'DC',
                        3  => 'DD',
                        4  => 'OT__eps',
                        5  => 'OT__giro',
                        6  => 'OT__ideal',
                        7  => 'VA__paypal',
                        8  => 'PP',
                        9  => 'OT__sofort',
                        10 => 'IV__assuredinv',
                        11 => 'IV__nassuredinv',
                    )
                )
                ) {
                    $return = true;
                    break 2;
                }
            }
        }

        $this->_changeToShop($sOriginalShopid);

        return $return;
    }

    /**
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function updateLegacyAssigments()
    {
        $sOriginalShopid = Registry::getConfig()->getShopId();
        $return          = true;
        foreach ($this->getShopList() as $oShop) {
            /** @var $oShop BaseModel */
            $this->_changeToShop($oShop->getId());

            $oModuleConfiguration = d3_cfg_mod::getNoCache($this->sModKey);
            $aOldPayments = (array)unserialize($oModuleConfiguration->getValue('d3heidelpay_aPaymentList'));
            $aMapPayments = array(
                'IV__billsafe'    => 'D3_Heidelpay_models_payment_billsafe',
                'CC'              => 'D3_Heidelpay_models_payment_creditcard',
                'DC'              => 'D3_Heidelpay_models_payment_debitcard',
                'DD'              => 'D3_Heidelpay_models_payment_directdebit',
                'OT__eps'         => 'D3_Heidelpay_models_payment_eps',
                'OT__giro'        => 'D3_Heidelpay_models_payment_giropay',
                'OT__ideal'       => 'D3_Heidelpay_models_payment_ideal',
                'VA__paypal'      => 'D3_Heidelpay_models_payment_paypal',
                'PP'              => 'D3_Heidelpay_models_payment_prepayment',
                'OT__sofort'      => 'D3_Heidelpay_models_payment_sofortueberweisung',
                'IV__assuredinv'  => 'D3_Heidelpay_models_payment_invoice_secured',
                'IV__nassuredinv' => 'D3_Heidelpay_models_payment_invoice_unsecured',
            );
            $aResult = array();

            foreach ($aOldPayments as $sPaymentId => $sOldKey) {
                if ($sOldKey) {
                    $aResult[$sPaymentId] = $aMapPayments[$sOldKey];
                }
            }

            //set value and encode it
            $oModuleConfiguration->setValue('d3heidelpay_aPaymentList', serialize($aResult));

            $aInsertFields = array(
                'OXVALUE' => array(
                    'content'      => $oModuleConfiguration->getFieldData('oxvalue'),
                    'force_update' => true,
                    'use_quote'    => true,
                )
            );
            $aWhereFields  = array('oxid' => $oModuleConfiguration->getId(), 'oxshopid' => $oShop->getId(), 'oxmodid' => $this->sModKey);

            $this->setInitialExecMethod(__METHOD__);
            if (false == $this->_updateTableItem2('d3_cfg_mod', $aInsertFields, $aWhereFields)) {
                $return = false;
                break;
            }
        }

        $this->_changeToShop($sOriginalShopid);

        return $return;
    }

    /**
     *
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function hasOldOxconfigEntries()
    {

        $oDb             = DatabaseProvider::getDb(DatabaseProvider::FETCH_MODE_ASSOC);
        $sOriginalShopid = Registry::getConfig()->getShopId();

        foreach ($this->getShopList() as $oShop) {
            /** @var $oShop BaseModel */
            $this->_changeToShop($oShop->getId());

            if (false == version_compare(d3_cfg_mod::getNoCache($this->sModKey)->getModVersion(), '4.0.0.0', '<')) {
                continue;
            }

            $sCountHeidelpayEntries = <<<MYSQL
SELECT count(*)
FROM `oxconfig`
WHERE
    `OXVARNAME` LIKE {$oDb->quote('Heidelpay_%')}
    AND `OXSHOPID` LIKE {$oDb->quote($oShop->getId())}
MYSQL;
            if (false == $oDb->getOne($sCountHeidelpayEntries)) {
                continue;
            }

            $this->_changeToShop($sOriginalShopid);

            return true;
        }

        $this->_changeToShop($sOriginalShopid);

        return false;
    }

    /**
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function migrateOldOxconfigEntries()
    {
        if (false == $this->hasOldOxconfigEntries()) {
            return false;
        }

        $blReturn        = false;
        $oDb             = DatabaseProvider::getDb(DatabaseProvider::FETCH_MODE_ASSOC);
        $sOriginalShopid = Registry::getConfig()->getShopId();

        foreach ($this->getShopList() as $oShop) {
            /** @var $oShop BaseModel */
            $sGetOldHeidelpayOxconfigEntries = <<<MYSQL
SELECT `OXVARNAME` as oxvarname
FROM `oxconfig`
WHERE
    `OXVARNAME` LIKE {$oDb->quote('Heidelpay_%')}
    AND `OXSHOPID` LIKE {$oDb->quote($oShop->getId())}
MYSQL;
            $aOldSettings                    = $oDb->getAll($sGetOldHeidelpayOxconfigEntries);

            $this->_changeToShop($oShop->getId());

            if (false == isset($aOldSettings[0])) {
                continue;
            }

            $oModuleConfiguration = d3_cfg_mod::getNoCache($this->sModKey);
            $this->_convertOldSettingsToModuleConfiguration($aOldSettings, $oModuleConfiguration);

            $aInsertFields = array(
                'OXVALUE' => array(
                    'content'      => $oModuleConfiguration->getFieldData('oxvalue'),
                    'force_update' => true,
                    'use_quote'    => true,
                )
            );
            $aWhereFields  = array('oxshopid' => $oShop->getId(), 'oxmodid' => $this->sModKey);

            $this->setInitialExecMethod(__METHOD__);
            $blReturn = $this->_updateTableItem2('d3_cfg_mod', $aInsertFields, $aWhereFields);

            if ($blReturn) {
                $sDeleteOldHeidelpayOxconfigEntries = <<<MYSQL
DELETE
FROM `oxconfig`
WHERE
    `OXVARNAME` LIKE {$oDb->quote('Heidelpay_%')}
    AND `OXSHOPID` LIKE {$oDb->quote($oShop->getId())}
MYSQL;
                $blRet                              = $this->sqlExecute($sDeleteOldHeidelpayOxconfigEntries);
                $aRet                               = array('sql' => $sDeleteOldHeidelpayOxconfigEntries, 'blRet' => $blRet);

                $this->setUpdateBreak(false);
                $this->setActionLog('SQL', $aRet['sql'], $this->getInitialExecMethod(__METHOD__));
            }
        }
        $this->_changeToShop($sOriginalShopid);

        return $blReturn;
    }

    /**
     * @param array      $aOldSettings
     * @param d3_cfg_mod $oModuleConfiguration
     *
     */
    protected function _convertOldSettingsToModuleConfiguration(array $aOldSettings, d3_cfg_mod $oModuleConfiguration)
    {
        foreach ($aOldSettings as $aOldSetting) {
            if (false == isset($aOldSetting['oxvarname'])) {
                continue;
            }

            $sSettingsName = $aOldSetting['oxvarname'];

            if (isset($this->aMapArraySettings[$sSettingsName])) {
                $aSettings = $oModuleConfiguration->getValue($this->aMapArraySettings[$sSettingsName]);
                if (false == $aSettings) {
                    $aSettings = 'a:0:{}';
                }

                $aSettings = unserialize($aSettings);

                $aSettings[$this->aMapSettings[$sSettingsName]] = Registry::getConfig()->getConfigParam(
                    $sSettingsName
                );
                $oModuleConfiguration->setValue($this->aMapArraySettings[$sSettingsName], serialize($aSettings));

            } elseif (isset($this->aMapSettings[$sSettingsName])) {
                $oModuleConfiguration->setValue(
                    $this->aMapSettings[$sSettingsName],
                    Registry::getConfig()->getConfigParam($sSettingsName)
                );
            }
        }

    }

    /**
     * @param array      $aOldAssignments
     * @param d3_cfg_mod $oModuleConfiguration
     *
     */
    protected function _convertOldAssignmentsToSettings(array $aOldAssignments, d3_cfg_mod $oModuleConfiguration)
    {
        $aPayments = array();
        foreach ($aOldAssignments as $aOldAssignment) {
            if (false == isset($aOldAssignment['oxpaymentid']) || false == isset($aOldAssignment['oxtype'])) {
                continue;
            }

            $sOxidPaymentId             = $aOldAssignment['oxpaymentid'];
            $sPaymentType               = $aOldAssignment['oxtype'];
            $aPayments[$sOxidPaymentId] = $sPaymentType;
        }

        $oModuleConfiguration->setValue('d3_cfg_mod__d3heidelpay_aPaymentList', serialize($aPayments));
    }

    /**
     * @param $sFileName
     *
     * @return bool
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     */
    protected function _hasExecuteFileQuery($sFileName)
    {
        startProfile(__METHOD__);
        $result = false;

        $sCurrentShopId = $this->getConfig()->getShopId();
        foreach ($this->getShopList() as $oShop) {
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
     * @param $sFileName
     *
     * @return bool
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    protected function _executeFileQueries($sFileName)
    {
        startProfile(__METHOD__);

        $blRet   = true;
        $aDoList = array();

        $sCurrentShopId = $this->getConfig()->getShopId();

        foreach ($this->getShopList() as $oShop) {
            /** @var $oShop BaseModel */
            $this->_changeToShop($oShop->getId());
            $aList = $this->_parseUpdateFile($sFileName);

            $oD3Str = oxNew(d3str::class);
            $oD3Str->convert2utf_8($aList, false);

            foreach ($aList['check'] as $sKey => $sCheckQuery) {
                if (DatabaseProvider::getDb(DatabaseProvider::FETCH_MODE_ASSOC)->getOne($sCheckQuery)) {
                    $aList['do'][$sKey] = utf8_encode($aList['do'][$sKey]);
                    $aDoList[] = $aList['do'][$sKey];
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

    /**
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function checkForChangeHaendlerKontoMsg()
    {
        $sCurrentShopid = $this->getConfig()->getShopId();

        $result = false;
        foreach ($this->getShopList() as $oShop) {
            /** @var $oShop BaseModel */
            $this->_changeToShop($oShop->getId());

            $oldVersionNumber = (int)d3_cfg_mod::getNoCache($this->sModKey)->getFieldData('oxversionnum');

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
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function showForChangeHaendlerKontoMsg()
    {
        $oConfirmMessage = oxNew(d3installconfirmmessage::class, $this);
        if (false == $this->hasExecute()) {
            $oConfirmMessage->showConfigConfirmMessage('blD3checkForModHaendlerKontoMsg', 'D3_HEIDELPAY_UPDATE_CHANGE_HAENDLERKONTO');
        }

        if ($this->hasExecute() && $this->checkForChangeHaendlerKontoMsg()) {
            $sCurrentShopid = $this->getConfig()->getShopId();

            foreach ($this->getShopList() as $oShop) {
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
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function checkModCfgorderExecutePostFields()
    {

        $blReturn       = false;
        $sCurrentShopid = $this->getConfig()->getShopId();
        foreach ($this->getShopList() as $oShop) {
            /** @var $oShop BaseModel */
            $this->_changeToShop($oShop->getId());
            if (false == is_string(
                    d3_cfg_mod::getNoCache($this->sModKey)->getValue('d3heidelpay_orderExecutePostFields')
                ) || strlen(
                    d3_cfg_mod::getNoCache($this->sModKey)->getValue('d3heidelpay_orderExecutePostFields')
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
     * @throws \D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException
     * @throws \D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \OxidEsales\Eshop\Core\Exception\StandardException
     */
    public function updateModCfgorderExecutePostFields()
    {
        $aDefaultConfig = unserialize(rawurldecode(base64_decode($this->sBaseValue)));

        $sCurrentShopid = $this->getConfig()->getShopId();
        foreach ($this->getShopList() as $oShop) {
            /** @var $oShop BaseModel */
            $this->_changeToShop($oShop->getId());
            /** @var $oShop BaseModel */
            /** @var d3_cfg_mod $oModCfg */
            $oModCfg = d3_cfg_mod::getNoCache($this->sModKey);
            $oModCfg->setValue(
                'd3heidelpay_orderExecutePostFields',
                $aDefaultConfig->d3_cfg_mod__d3heidelpay_orderExecutePostFields
            );

            if ($this->hasExecute()) {
                $oModCfg->save();
            }

            $sQuery = 'UPDATE ' . $oModCfg->getCoreTableName() //
                . ' SET oxvalue = ' //
                . DatabaseProvider::getDb(DatabaseProvider::FETCH_MODE_ASSOC)->quote($oModCfg->getFieldData('oxvalue')) //
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
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function usingModCfgStoredDataWithoutRG()
    {
        startProfile(__METHOD__);

        $return   = false;
        $currentShopId = $this->getConfig()->getShopId();

        foreach ($this->getShopList() as $oShop) {
            /** @var $oShop BaseModel */
            $this->_changeToShop($oShop->getId());

            $modConfig = d3_cfg_mod::getNoCache('d3heidelpay');
            $config = $oShop->getConfig();

            if($config->getShopConfVar('d3HeidelpayNoteStoredDataWithoutRG')) {
                continue;
            }

            if($modConfig->getValue('d3heidelpay_blShowStoredHPData') && false == $modConfig->getValue('d3heidelpay_blCardsUseRG')) {
                $return = true;
            }
        }

        $this->_changeToShop($currentShopId);

        stopProfile(__METHOD__);

        return $return;
    }

    /**
     * @return bool
     * @throws \D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException
     * @throws \D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \OxidEsales\Eshop\Core\Exception\StandardException
     */
    public function updateModCfStoredDataWithRG()
    {
        startProfile(__METHOD__);

        $return   = false;
        $currentShopId = $this->getConfig()->getShopId();

        foreach ($this->getShopList() as $oShop) {
            /** @var $oShop BaseModel */
            $this->_changeToShop($oShop->getId());
            $modConfig = d3_cfg_mod::getNoCache('d3heidelpay');
            $config = $oShop->getConfig();

            if($config->getShopConfVar('d3HeidelpayNoteStoredDataWithoutRG')) {
                continue;
            }

            if($modConfig->getValue('d3heidelpay_blShowStoredHPData') && false == $modConfig->getValue('d3heidelpay_blCardsUseRG')) {
                $oConfirmMessage = oxNew(d3installconfirmmessage::class, $this);
                $message = Registry::getLang()->translateString('D3HEIDELPAYNOTESTOREDDATAWITHOUTRG');
                $message .= Registry::getLang()->translateString('HELP_D3DYN_HEIDELPAY_PARAM_CARDS_USE_RG');

                $oConfirmMessage->confirmCustomMessage($message);

                if($this->hasExecute()) {
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
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     */
    public function hasEmptyCMSShopId()
    {
        $oDb = DatabaseProvider::getDb();
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
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function removeEmptyCMSShopId()
    {
        // ggf deleteTableitem benutzen?
        $oDb = DatabaseProvider::getDb();
        $sHasEmptyCMSShopIdQuery = <<<MYSQL
DELETE FROM `oxcontents`
WHERE
    `OXLOADID` LIKE {$oDb->quote('d3%')}
    AND `OXSHOPID` IN ('0', '')
MYSQL;
        $return  = $this->sqlExecute($sHasEmptyCMSShopIdQuery);
        $this->setActionLog('SQL', $sHasEmptyCMSShopIdQuery, __METHOD__);
        return $return;
    }

    /**
     * @return bool
     * @throws \D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException
     * @throws \D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \OxidEsales\Eshop\Core\Exception\StandardException
     */
    public function hasMultilangConfigButNoSetting()
    {
        startProfile(__METHOD__);

        $return        = false;
        $currentShopId = $this->getConfig()->getShopId();

        foreach ($this->getShopList() as $oShop) {
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
                $this->getSession()->setVariable('d3heidelpay_skip_multilangcheck'.$currentShopId, true);

                return false;
            }

            $moduleConfig = oxNew(d3_cfg_mod::class);
            $moduleConfig->setEnableMultilang(false);
            $moduleConfig->init();
            $moduleConfig->load(d3_cfg_mod::getNoCache('d3heidelpay')->getId());
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
     */
    public function showMultilangConfigButNoSettingMessage()
    {
        startProfile(__METHOD__);

        $currentShopId = $this->getConfig()->getShopId();

        foreach ($this->getShopList() as $oShop) {
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
                $this->getSession()->setVariable('d3heidelpay_skip_multilangcheck'.$currentShopId, true);
            }

            return true;
        }

        stopProfile(__METHOD__);

        return false;
    }
}
