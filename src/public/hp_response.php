<?php

use D3\Heidelpay\Controllers\Response;
use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\Log\d3log;
use OxidEsales\Eshop\Core\Registry;

if (isset($_POST['CRITERION_force_sid'])) {
    $_POST['force_sid'] = $_POST['CRITERION_force_sid'];
}
if (isset($_POST['CRITERION_heidelpay_input_position'])) {
    $_POST['heidelpay_input_position'] = $_POST['CRITERION_heidelpay_input_position'];
}
if (isset($_POST['CRITERION_language'])) {
    $_POST['language'] = $_POST['CRITERION_language'];
}
if (isset($_POST['CRITERION_lang'])) {
    $_POST['lang'] = $_POST['CRITERION_lang'];
}
if (isset($_POST['CRITERION_rtoken'])) {
    $_POST['rtoken'] = $_POST['CRITERION_rtoken'];
}
if (isset($_POST['CRITERION_stoken'])) {
    $_POST['stoken'] = $_POST['CRITERION_stoken'];
}
if (isset($_POST['CRITERION_shp'])) {
    $_POST['shp'] = $_POST['CRITERION_shp'];
}
if (isset($_POST['CRITERION_cutsomerip'])) {
    $_SERVER["HTTP_X_FORWARDED_FOR"] = $_POST['CRITERION_cutsomerip'];
}

if (false == defined('D3_HEIDELPAY_PUBLIC_FILE')) {
    define('D3_HEIDELPAY_PUBLIC_FILE', basename(__FILE__));
}
/**
 * Returns shop base path.
 *
 * @return string
 */
function getShopBasePath()
{
    return realpath(dirname(__FILE__).'/../../../../').'/';
}

require_once getShopBasePath()."/bootstrap.php";
ksort($_POST);
try {
    d3_cfg_mod::get('d3heidelpay')->d3getLog()->log(
        d3log::INFO,
        D3_HEIDELPAY_PUBLIC_FILE,
        'none',
        __LINE__,
        D3_HEIDELPAY_PUBLIC_FILE." got requested",
        var_export($_POST, true)
    );
} catch (Exception $e) {
    writeToLog($e->getMessage());
    writeToLog($e->getTraceAsString());
}

/** @var Response $oResponse */
$oResponse = oxNew(Response::class);
try {
    $sReturn   = $oResponse->init();
    $returnUrl = $oResponse->getRedirectUrl();
} catch (Exception $e) {
    writeToLog($e->getMessage());
    writeToLog($e->getTraceAsString());
}

try {
    d3_cfg_mod::get('d3heidelpay')->d3getLog()->log(
        d3log::INFO,
        D3_HEIDELPAY_PUBLIC_FILE,
        'none',
        __LINE__,
        D3_HEIDELPAY_PUBLIC_FILE." return value",
        $sReturn."::".$returnUrl
    );
} catch (Exception $e) {
    writeToLog($e->getMessage());
    writeToLog($e->getTraceAsString());
}

if ($sReturn === Response::RESPONSE_REDIRECT) {
    header("HTTP/1.1 200 OK");
    header("Location: ".$returnUrl);
    header("Connection: close");
} else {
    echo $returnUrl;
}

Registry::getConfig()->pageClose();
