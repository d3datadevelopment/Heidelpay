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

$aParams = array();

if ($argv && is_array($argv) && $argc) {
    if ($argv[1]) {
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
$myConfig = OxidEsales\Eshop\Core\Registry::getConfig();

// executing maintenance tasks..
oxNew(\D3\Heidelpay\Controllers\PaymentCollector::class)->setStartParameters($aParams)->execute();

// closing page, writing cache and so on..
$myConfig->pageClose();
