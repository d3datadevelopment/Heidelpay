<?php

$aParams = array();

if ($argv && is_array($argv) && $argc) {
    if (isset($argv[1]) && $argv[1]) {
        $aParams['shp'] = $argv[1];
    }

    if (isset($argv[2]) && $argv[2]) {
        $sDate = (string)$argv[2];
        if ($sDate) {
            $aParams['date'] = substr($sDate, 0, 10);
        }
    }
    $aParams['exec'] = "command_line";

} else {
    $aParams['shp']  = $_GET['shp'];
    $aParams['date'] = (string)$_GET['date'];
    $aParams['key']  = (string)$_GET['key'];
    $aParams['exec'] = "url";
}

/**
 * Returns shop base path.
 *
 * @return string
 */
function getShopBasePath()
{
    return realpath(dirname(__FILE__) . '/../../../../') . '/';
}

require_once getShopBasePath() . "/bootstrap.php";

/** @var D3\Heidelpay\Models\Bankaccount $oResponse */
$oResponse = oxNew(D3\Heidelpay\Models\Bankaccount::class);

$oResponse->setStartParameters($aParams);
try {
    $oResponse->checkBankAccount();
} catch (\OxidEsales\Eshop\Core\Exception\StandardException $e) {
    echo 'Error occurred: ', $e->getMessage(), PHP_EOL, $e->getTraceAsString();
} catch (\Doctrine\DBAL\DBALException $e) {
    echo 'DB Error occurred: ', $e->getMessage(), PHP_EOL, $e->getTraceAsString();
}

\OxidEsales\Eshop\Core\Registry::getConfig()->pageClose();

