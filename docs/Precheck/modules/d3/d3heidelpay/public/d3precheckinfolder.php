<?php

/**
 * This Software is the property of Data Development and is protected
 * by copyright law - it is NOT Freeware.
 * http://www.shopmodule.com
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development - <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

date_default_timezone_set('Europe/Berlin');

/**
 * Class d3PreCheckInFolder
 */
class d3PreCheckInFolder
{
    public $sVersion = '4.10.2';

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->sVersion;
    }

    /**
     * @return bool
     */
    public function hasMinPhpVersion()
    {
        $aArgs = func_get_args();

        if (version_compare(phpversion(), $aArgs[0]['version'], '>=')) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function hasMaxPhpVersion()
    {
        $aArgs = func_get_args();

        if (version_compare(phpversion(), $aArgs[0]['version'], '<=')) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function hasFromToPhpVersion()
    {
        $aArgs = func_get_args();

        if ((version_compare(phpversion(), $aArgs[0]['from'], '>=')) && (version_compare(
                phpversion(),
                $aArgs[0]['to'],
                '<'
            ))
        ) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function hasZendLoaderOptimizer()
    {
        if ((version_compare(phpversion(), '5.2.0', '>=')
            && version_compare(phpversion(), '5.2.900', '<')
            && function_exists('zend_optimizer_version')
        ) || (
            version_compare(phpversion(), '5.3.0', '>=')
            && version_compare(phpversion(), '5.6.900', '<')
            && function_exists('zend_loader_version')
        )) {
            if (function_exists('opcache_get_status')
                && ($aOpCacheStatus = opcache_get_status())
                && $aOpCacheStatus['opcache_enabled']
            ) {
                return null;
            } else {
                return true;
            }
        }

        return false;
    }

    /**
     * @return bool
     */
    public function hasIonCubeLoader()
    {
        if (function_exists('ioncube_loader_version')) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function hasExtension()
    {
        $aArgs = func_get_args();

        if (extension_loaded($aArgs[0]['type'])) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function hasMinCurlVersion()
    {
        $aArgs = func_get_args();

        $aCurlVersion = curl_version();
        return version_compare($aCurlVersion['version'], $aArgs[0]['version'], '>=');
    }

    /**
     * @return bool
     */
    public function hasMinOpenSSLVersion()
    {
        $aArgs = func_get_args();
        return version_compare($this->get_openssl_version_number(true), $aArgs[0]['version'], '>=');
    }

    /**
     * @param bool $patch_as_number
     * @param null $openssl_version_number
     * @return bool|string
     */
    protected function get_openssl_version_number($patch_as_number=false,$openssl_version_number=null) {
        if (is_null($openssl_version_number)) $openssl_version_number = OPENSSL_VERSION_NUMBER;
        $openssl_numeric_identifier = str_pad((string)dechex($openssl_version_number),8,'0',STR_PAD_LEFT);

        $openssl_version_parsed = array();
        $preg = '/(?<major>[[:xdigit:]])(?<minor>[[:xdigit:]][[:xdigit:]])(?<fix>[[:xdigit:]][[:xdigit:]])';
        $preg.= '(?<patch>[[:xdigit:]][[:xdigit:]])(?<type>[[:xdigit:]])/';
        preg_match_all($preg, $openssl_numeric_identifier, $openssl_version_parsed);
        $openssl_version = false;
        if (!empty($openssl_version_parsed)) {
            $alphabet = array(1=>'a',2=>'b',3=>'c',4=>'d',5=>'e',6=>'f',7=>'g',8=>'h',9=>'i',10=>'j',11=>'k',
                12=>'l',13=>'m',14=>'n',15=>'o',16=>'p',17=>'q',18=>'r',19=>'s',20=>'t',21=>'u',
                22=>'v',23=>'w',24=>'x',25=>'y',26=>'z');
            $openssl_version = intval($openssl_version_parsed['major'][0]).'.';
            $openssl_version.= intval($openssl_version_parsed['minor'][0]).'.';
            $openssl_version.= intval($openssl_version_parsed['fix'][0]);
            $patchlevel_dec = hexdec($openssl_version_parsed['patch'][0]);
            if (!$patch_as_number && array_key_exists($patchlevel_dec, $alphabet)) {
                $openssl_version.= $alphabet[$patchlevel_dec]; // ideal for text comparison
            }
            else {
                $openssl_version.= '.'.$patchlevel_dec; // ideal for version_compare
            }
        }
        return $openssl_version;
    }
}

/**
 * @param $mVar
 */
function dumpvar($mVar)
{
    echo "<pre>";
    print_r($mVar);
    echo "</pre>";
}

if (!isset($_SERVER['REMOTE_ADDR']) || !isset($_SERVER['HTTP_USER_AGENT'])) {
    $oPreCheck = new d3PreCheckInFolder();
    if (isset($_GET['fnc']) && $_GET['fnc']) {
        $aParams = isset($_GET['params']) ? unserialize(stripslashes(urldecode($_GET['params']))) : array();
        echo serialize(call_user_func(array($oPreCheck, $_GET['fnc']), $aParams));
    }
}