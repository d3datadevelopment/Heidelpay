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

use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\Registry;

$sShopid = Registry::getConfig()->getShopId();
try {
    $ShopIdQuery = " AND oxshopid = " . DatabaseProvider::getDb()->quote($sShopid);
} catch (\OxidEsales\Eshop\Core\Exception\DatabaseConnectionException $e) {
    $ShopIdQuery = " AND oxshopid =  '{$sShopid}' ";
}

$aQueries = array(
    array(
        'check' => "SELECT if(count(`OXID`), 0, 1) FROM `oxcontents` WHERE `oxloadid` = 'd3_hp_vorkassemail_cust_text' $ShopIdQuery ;",
        'do'    => 'INSERT IGNORE INTO `oxcontents` (`OXID`, `OXLOADID`, `OXSHOPID`, `OXSNIPPET`, `OXTYPE`, `OXACTIVE`, `OXACTIVE_1`, `OXPOSITION`, `OXTITLE`, `OXCONTENT`, `OXTITLE_1`, `OXCONTENT_1`, `OXACTIVE_2`, `OXTITLE_2`, `OXCONTENT_2`, `OXACTIVE_3`, `OXTITLE_3`, `OXCONTENT_3`, `OXCATID`, `OXFOLDER`, `OXTERMVERSION`) VALUES(md5("d3_hp_vorkassemail_cust_text_' . $sShopid . '"), "d3_hp_vorkassemail_cust_text", "' . $sShopid . '", 1, 0, 1, 1, "", "Heidelpay Vorkasseinfomail Kunde Text", "Sehr geehrter Kunde,<br/><br/>' . PHP_EOL . PHP_EOL . '<p>Sie haben bei Ihrer Bestellung die Bezahlart \"Vorkasse\" oder \"Rechnung\" gewählt. ' . PHP_EOL . 'Wir konnten heute Ihren Zahlungseingang verbuchen.<br/><br/>' . PHP_EOL . '[{if $order->blDifferentAmount}]Achtung, der von Ihnen überwiesene Betrag ([{$order->fPayAmount}] [{$order->oxorder__oxcurrency->value}]) stimmt nicht mit dem Gesamtbetrag der Bestellung ([{$order->getTotalOrderSum()}] [{$order->oxorder__oxcurrency->value}]) überein!<br/><br/>' . PHP_EOL . 'Bitte kontaktieren Sie uns umgehend per eMail oder Telefon.' . PHP_EOL . '[{else}]' . PHP_EOL . 'Ihre Bestellung wird nun umgehend von uns bearbeitet und versandt.' . PHP_EOL . '[{/if}]' . PHP_EOL . '</p><br/><br/>' . PHP_EOL . PHP_EOL . 'Vielen Dank.<br/><br/>' . PHP_EOL . PHP_EOL . 'Beste Grüße<br/>' . PHP_EOL . 'Ihr Shop Team", "", "", 1, "", "", 1, "", "", "8a142c3e4143562a5.46426637", "CMSFOLDER_EMAILS", "");',
    ),
    array(
        'check' => "SELECT if(count(`OXID`), 0, 1) FROM `oxcontents` WHERE `oxloadid` = 'd3_hp_vorkassemail_cust_subject' $ShopIdQuery;",
        'do'    => 'INSERT IGNORE INTO `oxcontents` (`OXID`, `OXLOADID`, `OXSHOPID`, `OXSNIPPET`, `OXTYPE`, `OXACTIVE`, `OXACTIVE_1`, `OXPOSITION`, `OXTITLE`, `OXCONTENT`, `OXTITLE_1`, `OXCONTENT_1`, `OXACTIVE_2`, `OXTITLE_2`, `OXCONTENT_2`, `OXACTIVE_3`, `OXTITLE_3`, `OXCONTENT_3`, `OXCATID`, `OXFOLDER`, `OXTERMVERSION`) VALUES(md5("d3_hp_vorkassemail_cust_subject_' . $sShopid . '"), "d3_hp_vorkassemail_cust_subject", "' . $sShopid . '", 1, 0, 1, 1, "", "Heidelpay Vorkasseinfomail Kunde Betreff", "Zahlungseingang zu Ihrer Bestellung [{$order->oxorder__oxordernr->value}] in unserem Online Shop", "", "", 1, "", "", 1, "", "", "8a142c3e4143562a5.46426637", "CMSFOLDER_EMAILS", "");',
    ),
    array(
        'check' => "SELECT if(count(`OXID`), 0, 1) FROM `oxcontents` WHERE `oxloadid` = 'd3_hp_vorkassemail_cust_plain' $ShopIdQuery;",
        'do'    => 'INSERT IGNORE INTO `oxcontents` (`OXID`, `OXLOADID`, `OXSHOPID`, `OXSNIPPET`, `OXTYPE`, `OXACTIVE`, `OXACTIVE_1`, `OXPOSITION`, `OXTITLE`, `OXCONTENT`, `OXTITLE_1`, `OXCONTENT_1`, `OXACTIVE_2`, `OXTITLE_2`, `OXCONTENT_2`, `OXACTIVE_3`, `OXTITLE_3`, `OXCONTENT_3`, `OXCATID`, `OXFOLDER`, `OXTERMVERSION`) VALUES(md5("d3_hp_vorkassemail_cust_plain_' . $sShopid . '"), "d3_hp_vorkassemail_cust_plain", "' . $sShopid . '", 0, 3, 1, 1, "", "Heidelpay Vorkasseinfomail Kunde Plain", "Sehr geehrter Kunde,' . PHP_EOL . PHP_EOL . 'Sie haben bei Ihrer Bestellung die Bezahlart \"Vorkasse\" oder \"Rechnung\" gewählt. ' . PHP_EOL . 'Wir konnten heute Ihren Zahlungseingang verbuchen.' . PHP_EOL . PHP_EOL . '[{if $order->blDifferentAmount}]' . PHP_EOL . 'Achtung, der von Ihnen überwiesene Betrag ([{$order->fPayAmount}] [{$order->oxorder__oxcurrency->value}]) stimmt nicht mit dem Gesamtbetrag der Bestellung ([{$order->getTotalOrderSum()}] [{ $order->oxorder__oxcurrency->value}]) überein! ' . PHP_EOL . 'Bitte kontaktieren Sie uns umgehend per eMail oder Telefon.' . PHP_EOL . '[{else}]' . PHP_EOL . 'Ihre Bestellung wird nun umgehend von uns bearbeitet und versandt.' . PHP_EOL . '[{/if}]' . PHP_EOL . PHP_EOL . 'Vielen Dank.' . PHP_EOL . PHP_EOL . 'Beste Grüße' . PHP_EOL . 'Ihr Shop Team", "", "", 1, "", "", 1, "", "", "8a142c3e4143562a5.46426637", "CMSFOLDER_EMAILS", "");',
    ),
    array(
        'check' => "SELECT if(count(`OXID`), 0, 1) FROM `oxcontents` WHERE `oxloadid` = 'd3_hp_vorkassemail_owner_text' $ShopIdQuery;",
        'do'    => 'INSERT IGNORE INTO `oxcontents` (`OXID`, `OXLOADID`, `OXSHOPID`, `OXSNIPPET`, `OXTYPE`, `OXACTIVE`, `OXACTIVE_1`, `OXPOSITION`, `OXTITLE`, `OXCONTENT`, `OXTITLE_1`, `OXCONTENT_1`, `OXACTIVE_2`, `OXTITLE_2`, `OXCONTENT_2`, `OXACTIVE_3`, `OXTITLE_3`, `OXCONTENT_3`, `OXCATID`, `OXFOLDER`, `OXTERMVERSION`) VALUES(md5("d3_hp_vorkassemail_owner_text_' . $sShopid . '"), "d3_hp_vorkassemail_owner_text", "' . $sShopid . '", 1, 0, 1, 1, "", "Heidelpay Vorkasseinfomail Shopinhaber Text", "Hallo,<br/><br/>' . PHP_EOL . PHP_EOL . 'Soeben konnte für Bestellung Nr. [{$order->oxorder__oxordernr->value}] ein Zahlungseingang verbucht werden.<br/><br/>' . PHP_EOL . PHP_EOL . '[{if $order->blDifferentAmount}]' . PHP_EOL . '<div style=\"color: red; font-weight: bold;\">' . PHP_EOL . 'Achtung, der überwiesene Betrag ([{$order->fPayAmount}] [{$order->oxorder__oxcurrency->value}]) stimmt NICHT mit dem Gesamtbetrag der Bestellung ([{$order->getTotalOrderSum()}] [{$order->oxorder__oxcurrency->value}]) überein!' . PHP_EOL . '</div><br/>' . PHP_EOL . '[{else}]' . PHP_EOL . '<div style=\"color: #123123; font-weight: bold;\">' . PHP_EOL . 'Der überwiesene Betrag ([{$order->getTotalOrderSum()}] [{$order->oxorder__oxcurrency->value}]) stimmt mit der Bestellsumme überein. Die Bestellung kann versandt werden.' . PHP_EOL . '</div><br/>' . PHP_EOL . '[{/if}]", "", "", 1, "", "", 1, "", "", "46e600fc114cfaa0788622a07c6c3fec", "CMSFOLDER_EMAILS", "");',
    ),
    array(
        'check' => "SELECT if(count(`OXID`), 0, 1) FROM `oxcontents` WHERE `oxloadid` = 'd3_hp_vorkassemail_owner_subject' $ShopIdQuery;",
        'do'    => 'INSERT IGNORE INTO `oxcontents` (`OXID`, `OXLOADID`, `OXSHOPID`, `OXSNIPPET`, `OXTYPE`, `OXACTIVE`, `OXACTIVE_1`, `OXPOSITION`, `OXTITLE`, `OXCONTENT`, `OXTITLE_1`, `OXCONTENT_1`, `OXACTIVE_2`, `OXTITLE_2`, `OXCONTENT_2`, `OXACTIVE_3`, `OXTITLE_3`, `OXCONTENT_3`, `OXCATID`, `OXFOLDER`, `OXTERMVERSION`) VALUES(md5("d3_hp_vorkassemail_owner_subject_' . $sShopid . '"), "d3_hp_vorkassemail_owner_subject", "' . $sShopid . '", 1, 0, 1, 1, "", "Heidelpay Vorkasseinfomail Shopinhaber Betreff", "Zahlungseingang für Bestellung [{$order->oxorder__oxordernr->value}]", "", "", 1, "", "", 1, "", "", "8a142c3e4143562a5.46426637", "CMSFOLDER_EMAILS", "");',
    ),
    array(
        'check' => "SELECT if(count(`OXID`), 0, 1) FROM `oxcontents` WHERE `oxloadid` = 'd3_hp_vorkassemail_owner_plain' $ShopIdQuery;",
        'do'    => 'INSERT IGNORE INTO `oxcontents` (`OXID`, `OXLOADID`, `OXSHOPID`, `OXSNIPPET`, `OXTYPE`, `OXACTIVE`, `OXACTIVE_1`, `OXPOSITION`, `OXTITLE`, `OXCONTENT`, `OXTITLE_1`, `OXCONTENT_1`, `OXACTIVE_2`, `OXTITLE_2`, `OXCONTENT_2`, `OXACTIVE_3`, `OXTITLE_3`, `OXCONTENT_3`, `OXCATID`, `OXFOLDER`, `OXTERMVERSION`) VALUES(md5("d3_hp_vorkassemail_owner_plain_' . $sShopid . '"), "d3_hp_vorkassemail_owner_plain", "' . $sShopid . '", 1, 0, 1, 1, "", "Heidelpay Vorkasseinfomail Shopinhaber Plain", "Hallo,' . PHP_EOL . PHP_EOL . 'Soeben konnte für Bestellung Nr. [{$order->oxorder__oxordernr->value}] ein Zahlungseingang verbucht werden.' . PHP_EOL . PHP_EOL . '[{if $order->blDifferentAmount}]' . PHP_EOL . 'Achtung, der überwiesene Betrag ([{$order->fPayAmount}] [{$order->oxorder__oxcurrency->value}]) stimmt NICHT mit dem Gesamtbetrag der Bestellung ([{$order->getTotalOrderSum()}] [{$order->oxorder__oxcurrency->value}]) überein!' . PHP_EOL . '[{else}]' . PHP_EOL . 'Der überwiesene Betrag ([{$order->getTotalOrderSum()}] [{$order->oxorder__oxcurrency->value}]) stimmt mit der Bestellsumme überein. Die Bestellung kann versandt werden.' . PHP_EOL . '[{/if}]", "", "", 1, "", "", 1, "", "", "46e600fc114cfaa0788622a07c6c3fec", "CMSFOLDER_EMAILS", "");',
    ),
);
