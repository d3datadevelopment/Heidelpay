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

use D3\Heidelpay\Controllers\PaymentCollector;
use Doctrine\DBAL\DBALException;
use OxidEsales\Eshop\Core\Exception\StandardException;

$aParams = array();

if ($argv && is_array($argv) && $argc) {
    if (isset($argv[1]) && false == empty($argv[1])) {
        $aParams['shp'] = $argv[1];
    }
    $aParams['exec'] = "command_line";
} else {
    $aParams['shp']  = $_GET['shp'];
    $aParams['key']  = (string)$_GET['key'];
    $aParams['exec'] = "url";
}

$sPath = realpath(dirname(__FILE__) . "/../../../../bootstrap.php");

require_once $sPath;

// initializes singleton config class
$config = OxidEsales\Eshop\Core\Registry::getConfig();

// executing maintenance tasks..
try {
    /** @var PaymentCollector $collector */
    $collector = oxNew(PaymentCollector::class);
    $collector->setStartParameters($aParams)->execute();
} catch (StandardException $e) {
    echo $e->getMessage();
} catch (DBALException $e) {
    echo $e->getMessage();
}

// closing page, writing cache and so on..
$config->pageClose();
