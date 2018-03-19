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
 * @author    D3 Data Development <support@shopmodule.com>
 * @link      http://www.oxidmodule.com
 */

$aQueries = array(
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM oxpayments WHERE oxid = 'd3debitcard';",
        'do'    => "INSERT IGNORE INTO `oxpayments` (`OXID`, `OXACTIVE`, `OXDESC`, `OXADDSUM`, `OXADDSUMTYPE`, `OXFROMBONI`, `OXFROMAMOUNT`, `OXTOAMOUNT`, `OXVALDESC`, `OXCHECKED`, `OXDESC_1`, `OXVALDESC_1`, `OXDESC_2`, `OXVALDESC_2`, `OXDESC_3`, `OXVALDESC_3`, `OXLONGDESC`, `OXLONGDESC_1`, `OXLONGDESC_2`, `OXLONGDESC_3`, `OXSORT`) VALUES('d3debitcard', 0, 'Debitkarte', 0, 'abs', 0, 0, 999999999, '', 0, '', '', '', '', '', '', '', '', '', '', 0);",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM oxpayments WHERE oxid = 'd3sofortueberweisung';",
        'do'    => "INSERT IGNORE INTO `oxpayments` (`OXID`, `OXACTIVE`, `OXDESC`, `OXADDSUM`, `OXADDSUMTYPE`, `OXFROMBONI`, `OXFROMAMOUNT`, `OXTOAMOUNT`, `OXVALDESC`, `OXCHECKED`, `OXDESC_1`, `OXVALDESC_1`, `OXDESC_2`, `OXVALDESC_2`, `OXDESC_3`, `OXVALDESC_3`, `OXLONGDESC`, `OXLONGDESC_1`, `OXLONGDESC_2`, `OXLONGDESC_3`, `OXSORT`) VALUES('d3sofortueberweisung', 0, 'Sofortüberweisung', 0, 'abs', 0, 0, 999999999, 'lsblz__@@lsktonr__@@lsktoinhaber__@@lsland__@@', 0, '', '', '', '', '', '', '', '', '', '', 0);",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM oxpayments WHERE oxid = 'd3idealpayment';",
        'do'    => "INSERT IGNORE INTO `oxpayments` (`OXID`, `OXACTIVE`, `OXDESC`, `OXADDSUM`, `OXADDSUMTYPE`, `OXFROMBONI`, `OXFROMAMOUNT`, `OXTOAMOUNT`, `OXVALDESC`, `OXCHECKED`, `OXDESC_1`, `OXVALDESC_1`, `OXDESC_2`, `OXVALDESC_2`, `OXDESC_3`, `OXVALDESC_3`, `OXLONGDESC`, `OXLONGDESC_1`, `OXLONGDESC_2`, `OXLONGDESC_3`, `OXSORT`) VALUES('d3idealpayment', 0, 'iDeal Niederlande', 0, 'abs', 0, 0, 999999999, 'lsbankname__@@lsland__@@', 0, '', '', '', '', '', '', '', '', '', '', 0);",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM oxpayments WHERE oxid = 'd3giropay';",
        'do'    => "INSERT IGNORE INTO `oxpayments` (`OXID`, `OXACTIVE`, `OXDESC`, `OXADDSUM`, `OXADDSUMTYPE`, `OXFROMBONI`, `OXFROMAMOUNT`, `OXTOAMOUNT`, `OXVALDESC`, `OXCHECKED`, `OXDESC_1`, `OXVALDESC_1`, `OXDESC_2`, `OXVALDESC_2`, `OXDESC_3`, `OXVALDESC_3`, `OXLONGDESC`, `OXLONGDESC_1`, `OXLONGDESC_2`, `OXLONGDESC_3`, `OXSORT`) VALUES('d3giropay', 0, 'Giropay Deutschland', 0, 'abs', 0, 0, 999999999, 'lsktonr__@@lsblz__@@lsland__@@', 0, '', '', '', '', '', '', '', '', '', '', 0);",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM oxpayments WHERE oxid = 'd3epspayment';",
        'do'    => "INSERT IGNORE INTO `oxpayments` (`OXID`, `OXACTIVE`, `OXDESC`, `OXADDSUM`, `OXADDSUMTYPE`, `OXFROMBONI`, `OXFROMAMOUNT`, `OXTOAMOUNT`, `OXVALDESC`, `OXCHECKED`, `OXDESC_1`, `OXVALDESC_1`, `OXDESC_2`, `OXVALDESC_2`, `OXDESC_3`, `OXVALDESC_3`, `OXLONGDESC`, `OXLONGDESC_1`, `OXLONGDESC_2`, `OXLONGDESC_3`, `OXSORT`) VALUES('d3epspayment', 0, 'EPS Österreich', 0, 'abs', 0, 0, 999999999, 'lsbankname__@@lsktoinhaber__@@lsland__@@', 0, '', '', '', '', '', '', '', '', '', '', 0);",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM oxpayments WHERE oxid = 'd3paypal';",
        'do'    => "INSERT IGNORE INTO `oxpayments` (`OXID`, `OXACTIVE`, `OXDESC`, `OXADDSUM`, `OXADDSUMTYPE`, `OXFROMBONI`, `OXFROMAMOUNT`, `OXTOAMOUNT`, `OXVALDESC`, `OXCHECKED`, `OXDESC_1`, `OXVALDESC_1`, `OXDESC_2`, `OXVALDESC_2`, `OXDESC_3`, `OXVALDESC_3`, `OXLONGDESC`, `OXLONGDESC_1`, `OXLONGDESC_2`, `OXLONGDESC_3`, `OXSORT`) VALUES('d3paypal', 0, 'Heidelpay Paypal', 0, 'abs', 0, 0, 999999999, '', 0, '', '', '', '', '', '', '', '', '', '', 0);",
    ),
//    array(
//        'check' => "SELECT if(count(OXID), 0, 1) FROM oxpayments WHERE oxid = 'd3postfinance';",
//        'do'    => "INSERT IGNORE INTO `oxpayments` (`OXID`, `OXACTIVE`, `OXDESC`, `OXADDSUM`, `OXADDSUMTYPE`, `OXFROMBONI`, `OXFROMAMOUNT`, `OXTOAMOUNT`, `OXVALDESC`, `OXCHECKED`, `OXDESC_1`, `OXVALDESC_1`, `OXDESC_2`, `OXVALDESC_2`, `OXDESC_3`, `OXVALDESC_3`, `OXLONGDESC`, `OXLONGDESC_1`, `OXLONGDESC_2`, `OXLONGDESC_3`, `OXSORT`) VALUES('d3postfinance', 0, 'Heidelpay PostFinance', 0, 'abs', 0, 0, 999999999, '', 0, '', '', '', '', '', '', '', '', '', '', 0);",
//    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM oxpayments WHERE oxid = 'd3przelewy24';",
        'do'    => "INSERT IGNORE INTO `oxpayments` (`OXID`, `OXACTIVE`, `OXDESC`, `OXADDSUM`, `OXADDSUMTYPE`, `OXFROMBONI`, `OXFROMAMOUNT`, `OXTOAMOUNT`, `OXVALDESC`, `OXCHECKED`, `OXDESC_1`, `OXVALDESC_1`, `OXDESC_2`, `OXVALDESC_2`, `OXDESC_3`, `OXVALDESC_3`, `OXLONGDESC`, `OXLONGDESC_1`, `OXLONGDESC_2`, `OXLONGDESC_3`, `OXSORT`) VALUES('d3przelewy24', 0, 'Heidelpay Przelewy24', 0, 'abs', 0, 0, 999999999, '', 0, '', '', '', '', '', '', '', '', '', '', 0);",
    ),
);