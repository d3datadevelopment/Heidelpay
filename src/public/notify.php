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

use OxidEsales\Eshop\Core\Registry;

/**
 * Returns shop base path.
 *
 * @return string
 */
function getShopBasePath()
{
    return realpath(dirname(__FILE__) . '/../../../../') . '/';
}

$request = file_get_contents('php://input');
//$request = file_get_contents("/home/vagrant/shared_folder/module/HeidelpayV6/pppa.xml");
//$request = file_get_contents("/home/vagrant/shared_folder/module/HeidelpayV6/pprc.xml");
//$request = file_get_contents("/home/vagrant/shared_folder/module/HeidelpayV6/pprv.xml");

$noCriterionFound = false;
if (preg_match('/<Criterion name="shp">(.+)<\/Criterion>/', $request, $matches) !== 1) {
    $noCriterionFound = true;
}
$_POST['shp'] = $matches[1];

require_once getShopBasePath() . "/bootstrap.php";

if ($noCriterionFound) {
    try {
        D3\ModCfg\Application\Model\Configuration\d3_cfg_mod::get('d3heidelpay')->d3getLog()->log(
            D3\ModCfg\Application\Model\Log\d3log::WARNING,
            basename(__FILE__),
            'none',
            __LINE__,
            basename(__FILE__) . " has no criterions",
            var_export($request, true)
        );
    } catch (\Exception $e) {
        $content = basename(__FILE__) . PHP_EOL
            . __LINE__ . PHP_EOL
            . basename(__FILE__) . " has no criterions" . PHP_EOL
            . var_export($request, true) . PHP_EOL;
        writeToLog($content);
        writeToLog($e->getMessage());
        writeToLog($e->getTraceAsString());
    }

    exit(1);
}

try {
    D3\ModCfg\Application\Model\Configuration\d3_cfg_mod::get('d3heidelpay')->d3getLog()->log(
        D3\ModCfg\Application\Model\Log\d3log::INFO,
        basename(__FILE__),
        'none',
        __LINE__,
        basename(__FILE__) . " got requested",
        var_export($request, true)
    );
} catch (\Exception $e) {
    $content = basename(__FILE__) . PHP_EOL
        . __LINE__ . PHP_EOL
        . basename(__FILE__) . " got requested" . PHP_EOL
        . var_export($request, true) . PHP_EOL;
    writeToLog($content);
    writeToLog($e->getMessage());
    writeToLog($e->getTraceAsString());
}
//TODO: reactive php header output
try {
    /** @var D3\Heidelpay\Controllers\Notify $notify */
    $notify = oxNew(
        D3\Heidelpay\Controllers\Notify::class, Registry::get(Registry::class),
        D3\ModCfg\Application\Model\Configuration\d3_cfg_mod::get('d3heidelpay')
    );
    $notify->init($request);
} catch (\Exception $e) {
    writeToLog($e->getMessage());
    writeToLog($e->getTraceAsString());
}
header("HTTP/1.1 200 OK");
header("Connection: close");

Registry::getConfig()->pageClose();

exit(0);
