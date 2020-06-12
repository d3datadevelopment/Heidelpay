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
use OxidEsales\ComposerPlugin\Installer\Package\ShopPackageInstaller;

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

// initializes singleton config class
$config = OxidEsales\Eshop\Core\Registry::getConfig();

// force init a new session (e.g. to determine the voucher values from the shopping cart saved in the session)
oxRegistry::getSession()->setForceNewSession();

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
