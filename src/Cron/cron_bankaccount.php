<?php

use Doctrine\DBAL\DBALException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\ComposerPlugin\Installer\Package\ShopPackageInstaller;

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

require_once(__DIR__.'/../../../../../vendor/autoload.php');

$bootstrapFileName = getenv('ESHOP_BOOTSTRAP_PATH');
if (!empty($bootstrapFileName)) {
    $bootstrapFileName = realpath(trim(getenv('ESHOP_BOOTSTRAP_PATH')));
} else {
    $count = 0;
    $bootstrapFileName = '../../../'. ShopPackageInstaller::SHOP_SOURCE_DIRECTORY .'/bootstrap.php';
    $currentDirectory = __DIR__ . '/';
    while ($count < 5) {
        $count++;
        if (file_exists($currentDirectory . $bootstrapFileName)) {
            $bootstrapFileName = $currentDirectory . $bootstrapFileName;
            break;
        }
        $bootstrapFileName = '../' . $bootstrapFileName;
    }
}

if (!(file_exists($bootstrapFileName) && !is_dir($bootstrapFileName))) {
    $items = [
        "Unable to find eShop bootstrap.php file.",
        "You can override the path by using ESHOP_BOOTSTRAP_PATH environment variable.",
        "\n"
    ];

    $message = implode(" ", $items);

    die($message);
}

require_once($bootstrapFileName);

/** @var D3\Heidelpay\Models\Bankaccount $oResponse */
$oResponse = oxNew(D3\Heidelpay\Models\Bankaccount::class);

$oResponse->setStartParameters($aParams);
try {
    $oResponse->checkBankAccount();
} catch (StandardException $e) {
    echo 'Error occurred: ', $e->getMessage(), PHP_EOL, $e->getTraceAsString();
} catch (DBALException $e) {
    echo 'DB Error occurred: ', $e->getMessage(), PHP_EOL, $e->getTraceAsString();
}

Registry::getConfig()->pageClose();
