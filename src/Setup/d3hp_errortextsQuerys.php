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

$aQueries = array(
    array(
        'check' => "SELECT if(count(OXID), 1, 0) FROM d3hperrortexts WHERE oxid = 'OXID';",
        'do'    => "DELETE FROM `d3hperrortexts` WHERE `d3hperrortexts`.`OXID` = 'OXID';",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '1';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('1', '000.000.000', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'Transaction succeeded');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '2';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('2', '000.100.110', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'Request successfully processed in \"Merchant in Integrator Test Mode\"');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '3';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('3', '000.100.111', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'Request successfully processed in \"Merchant in Validator Test Mode\"');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '4';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('4', '000.100.112', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'Request successfully processed in \"Merchant in Connector Test Mode\"');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '5';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('5', '000.100.121', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'Request successfully processed but Merchant Connector is disabled');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '6';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('6', '000.100.122', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'Request successfully processed in \"Merchant Connector Test Mode\"');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '7';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('7', '000.100.200', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'Reason not Specified');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '8';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('8', '000.100.201', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'Account or Bank Details Incorrect');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '9';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('9', '000.100.202', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'Account Closed');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '10';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('10', '000.100.203', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'Insufficient Funds');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '11';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('11', '000.100.204', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'Mandate not Valid');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '12';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('12', '000.100.205', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'Mandate Cancelled');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '13';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('13', '000.100.206', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'Revocation or Dispute');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '14';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('14', '000.100.207', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'Cancellation in Clearing Network');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '15';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('15', '000.100.208', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'Account Blocked');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '16';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('16', '000.100.209', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'Account does not exist');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '17';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('17', '000.100.210', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'Invalid Amount');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '18';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('18', '000.100.220', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'Fraudulent Transaction');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '19';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('19', '000.100.221', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'Merchandise Not Received');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '20';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('20', '000.100.222', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'Transaction Not Recognized By Cardholder');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '21';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('21', '000.100.223', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'Service Not Rendered');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '22';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('22', '000.100.224', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'Duplicate Processing');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '23';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('23', '000.100.225', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'Credit Not Processed');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '24';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('24', '000.100.230', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'Unauthorised Charge');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '25';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('25', '000.100.299', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'Unspecified (Technical)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '26';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('26', '000.200.000', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'Transaction pending');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '27';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('27', '000.300.000', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'Two-step transaction succeeded');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '28';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('28', '000.400.000', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'Transaction succeeded (please review manually due to fraud suspicion)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '29';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('29', '000.400.010', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'Transaction succeeded (please review manually due to AVS return code)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '30';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('30', '000.400.101', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'card not participating');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '31';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('31', '000.400.102', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'user not enrolled');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '32';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('32', '000.400.103', 0, 'Transaktion erfolgreich', 'Transaction succeeded', '3D system not available');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '33';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('33', '000.400.104', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'Missing or malformed 3DSecure Configuration for Channel');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '34';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('34', '000.400.105', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'Unsupported User Device - Authentication not possible');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '35';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('35', '000.400.106', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'invalid payer authentication response(PARes) in 3DSecure Transaction');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '36';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('36', '000.400.107', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Communication Error to VISA/Mastercard Directory Server');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '37';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('37', '000.400.108', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Cardholder Not Found - card number provided is not found in the ranges of the issuer');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '38';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('38', '000.400.200', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'intercard risk management check communication error');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '39';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('39', '000.500.000', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'Transaction succeeded - very good rating');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '40';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('40', '000.500.100', 0, 'Transaktion erfolgreich', 'Transaction succeeded', 'Transaction succeeded (address corrected)');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '41';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('41', '100.100.100', 1, 'Keine Kreditkarte oder Kontonummer angegeben', 'request contains no creditcard/bank account number', 'request contains no creditcard/bank account number');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '42';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('42', '100.100.101', 1, 'Kreditkarten- oder Kontonummer ungültig', 'invalid creditcard/bank account number', 'invalid creditcard/bank account number');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '43';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('43', '100.100.200', 1, 'Kein Monat angegeben', 'request contains no month', 'request contains no month');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '44';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('44', '100.100.201', 1, 'Ungültiger Monat', 'invalid month', 'invalid month');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '45';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('45', '100.100.300', 1, 'Kein Jahr angegeben', 'request contains no year', 'request contains no year');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '46';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('46', '100.100.301', 1, 'Ungültiges Jahr', 'invalid year', 'invalid year');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '47';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('47', '100.100.303', 1, 'Karte abgelaufen', 'card expired', 'card expired');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '48';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('48', '100.100.304', 1, 'Karte nicht gültig', 'card not yet valid', 'card not yet valid');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '49';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('49', '100.100.400', 1, 'Kreditkarten bzw. Kontonummer ist leer', 'request contains no cc/bank account holder', 'request contains no cc/bank account holder');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '50';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('50', '100.100.401', 1, 'Name des Inhabers zu kurz', 'cc/bank account holder too short or too long', 'cc/bank account holder too short or too long');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '51';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('51', '100.100.402', 1, 'Daten des Kartenbesitzers nicht korrekt', 'cc/bank account holder not valid', 'cc/bank account holder not valid');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '52';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('52', '100.100.500', 1, 'Kein Kreditkartentyp gewählt', 'request contains no credit card brand', 'request contains no credit card brand');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '53';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('53', '100.100.501', 1, 'Ungültiger Kreditkartentyp', 'invalid credit card brand', 'invalid credit card brand');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '54';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('54', '100.100.600', 1, 'Keine Prüfziffer eingetragen', 'empty CVV for VISA,MASTER, AMEX not allowed', 'empty CVV for VISA,MASTER, AMEX not allowed');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '55';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('55', '100.100.601', 1, 'Falsche Prüfziffer/KK-Typ Kombination', 'invalid CVV/brand combination', 'invalid CVV/brand combination');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '56';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('56', '100.100.602', 1, 'Ungültige Prüfziffer2', 'invalid CVV2', 'invalid CVV2');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '57';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('57', '100.100.650', 1, 'MAESTRO-Kartennummer leer', 'empty CreditCardIssueNumber for MAESTRO not allowed', 'empty CreditCardIssueNumber for MAESTRO not allowed');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '58';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('58', '100.100.651', 1, 'ungültige Kreditkartennummer', 'invalid cc number', 'invalid CreditCardIssueNumber');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '59';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('59', '100.100.700', 1, 'Ungültige Nummer/Kartentyp Kombination', 'invalid cc number/brand combination', 'invalid cc number/brand combination');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '60';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('60', '100.100.701', 3, 'Zahlung abgelehnt', 'transaction declined', 'suspecting fraud invalid cc number');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '61';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('61', '100.100.900', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'authorisation too long');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '62';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('62', '100.150.100', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'request contains no Account data and no registration id');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '63';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('63', '100.150.101', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid length for specified registration id (must be 32 chars)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '64';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('64', '100.150.200', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'registration does not exist');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '65';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('65', '100.150.201', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'registration is not confirmed yet');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '66';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('66', '100.150.202', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'registration is already deregistered');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '67';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('67', '100.150.203', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'registration is not valid, probably initially rejected');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '68';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('68', '100.150.204', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'account registration reference pointed to no registration transaction');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '69';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('69', '100.150.205', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'referenced registration does not contain an account');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '70';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('70', '100.150.300', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'payment only allowed with valid initial registration');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '71';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('71', '100.200.100', 1, 'Kontodaten falsch', 'bank account contains no or invalid country', 'bank account contains no or invalid country');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '72';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('72', '100.200.101', 1, 'Ungültige Kreditkarten bzw. Kontonummer', 'invalid creditcard/bank account number', 'invalid creditcard/bank account number');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '73';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('73', '100.200.102', 1, 'Kontonummer fehlt', 'bank account contains no account number/id', 'bank account contains no account number/id');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '74';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('74', '100.200.103', 1, 'BLZ und Kontonummer Kombination ungültig', 'bank account has invalid bankcode/name account number combination', 'bank account has invalid bankcode/name account number combination');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '75';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('75', '100.200.104', 1, 'Falsches Format der Kontonummer', 'bank account has invalid acccount number format', 'bank account has invalid acccount number format');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '76';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('76', '100.200.200', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'bank account needs to be registered and confirmed first. Country is mandate based.');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '77';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('77', '100.210.101', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'virtual account contains no or invalid Id');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '78';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('78', '100.210.102', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'virtual account contains no or invalid brand');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '79';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('79', '100.211.101', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'user account contains no or invalid Id');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '80';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('80', '100.211.102', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'user account contains no or invalid brand');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '81';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('81', '100.211.103', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'no password defined for user account');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '82';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('82', '100.211.104', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'password does not meet safety requirements (needs 8 digits at least and must contain letters and numbers)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '83';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('83', '100.211.105', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'wallet id has to be a valid email address');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '84';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('84', '100.211.106', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'voucher ids have 32 digits allways');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '85';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('85', '100.212.101', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'wallet account registration must not have an initial balance');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '86';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('86', '100.212.102', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'wallet account contains no or invalid brand');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '87';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('87', '100.212.103', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'wallet account payment transaction needs to reference a registration');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '88';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('88', '100.250.100', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'job contains no execution information');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '89';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('89', '100.250.105', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid or missing action type');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '90';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('90', '100.250.106', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid or missing duration unit');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '91';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('91', '100.250.107', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid or missing notice unit');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '92';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('92', '100.250.110', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'missing job execution');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '93';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('93', '100.250.111', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'missing job expression');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '94';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('94', '100.250.120', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid execution parameters, combination does not conform to quartz standard');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '95';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('95', '100.250.121', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid execution parameters, hour must be between 0 and 23');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '96';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('96', '100.250.122', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid execution parameters, minute and seconds must be between 0 and 59');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '97';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('97', '100.250.123', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid execution parameters, Day of month must be between 1 and 31');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '98';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('98', '100.250.124', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid execution parameters, month must be between 1 and 12');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '99';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('99', '100.250.125', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid execution parameters, Day of week must be between 1 and 7');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '100';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('100', '100.250.250', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Job tag missing');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '101';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('101', '100.300.100', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'request contains no test mode');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '102';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('102', '100.300.101', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid test mode (please use LIVE or INTEGRATOR_TEST or CONNECTOR_TEST)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '103';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('103', '100.300.200', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction id too long');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '104';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('104', '100.300.300', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid reference id');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '105';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('105', '100.300.301', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'reference id not found');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '106';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('106', '100.300.400', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'missing or invalid channel id');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '107';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('107', '100.300.401', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'missing or invalid sender id');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '108';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('108', '100.300.402', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'missing or invalid version');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '109';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('109', '100.300.500', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'request contains no response id');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '110';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('110', '100.300.501', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid response id');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '111';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('111', '100.300.600', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid or missing user login');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '112';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('112', '100.300.601', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid or missing user pwd');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '113';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('113', '100.300.700', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid relevance');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '114';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('114', '100.300.701', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid relevance for given payment type');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '115';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('115', '100.350.100', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'referenced session is REJECTED (no action possible).');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '116';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('116', '100.350.101', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'referenced session is CLOSED (no action possible)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '117';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('117', '100.350.200', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'undefined session state');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '118';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('118', '100.350.201', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'unknown registration type');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '119';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('119', '100.350.301', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'confirmation (CF) must be registered (RG) first');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '120';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('120', '100.350.302', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'session already confirmed (CF)');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '121';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('121', '100.350.303', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'cannot deregister (DR) unregistered account and/or customer');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '122';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('122', '100.350.310', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'cannot confirm (CF) session via XML');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '123';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('123', '100.350.311', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'cannot confirm (CF) on a registration passthrough channel');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '124';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('124', '100.350.312', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'cannot do passthrough on non-internal connector');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '125';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('125', '100.350.313', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'registration of this type has to provide confirmation url');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '126';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('126', '100.350.314', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'customer could not be notified of pin to confirm registration (channel)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '127';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('127', '100.350.315', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'customer could not be notified of pin to confirm registration (sending failed)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '128';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('128', '100.350.400', 1, 'no or invalid PIN (email or SMS authentication) entered', 'no or invalid PIN (email or SMS authentication) entered', 'no or invalid PIN (email or SMS authentication) entered');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '129';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('129', '100.350.500', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'unable to obtain personal (virtual) account - most likely no more accounts available');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '130';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('130', '100.350.600', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'UserAccount-numbers have to be unique');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '131';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('131', '100.350.601', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'registration is not allowed to reference another transaction');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '132';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('132', '100.350.610', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Referencing to unknown UserAccount Id/Username');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '133';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('133', '100.360.201', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'unknown schedule type');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '134';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('134', '100.360.300', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'cannot schedule(SD) unscheduled job');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '135';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('135', '100.360.303', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'cannot deschedule(DS) unscheduled job');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '136';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('136', '100.360.400', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'schedule module not configured for LIVE transaction mode');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '137';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('137', '100.370.100', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction declined by InterCard');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '138';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('138', '100.370.101', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'responseUrl not set in Transaction/Frontend');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '139';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('139', '100.370.102', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'malformed responseUrl in Transaction/Frontend');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '140';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('140', '100.370.110', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction must be executed for German address');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '141';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('141', '100.370.111', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'sessionID not set in Transaction/Frontend');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '142';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('142', '100.370.121', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'no or unknown ECI Type defined in Authentication');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '143';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('143', '100.370.122', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'paramter with null key provided in 3DSecure Authentication');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '144';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('144', '100.370.123', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'no or unknown verification type defined in 3DSecure Authentication');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '145';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('145', '100.370.124', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'unknown parameter key in 3DSecure Authentication');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '146';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('146', '100.370.125', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Invalid 3DSecure Verification_ID. Must have Base64 encoding a Length of 28 digits');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '147';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('147', '100.370.131', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'no or unknown authentication type defined in Transaction/Authentication@type');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '148';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('148', '100.370.132', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'no result indicator defined Transaction/Authentication/resultIndicator');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '149';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('149', '100.380.100', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction declined');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '150';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('150', '100.380.101', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction contains no risk management part');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '151';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('151', '100.380.110', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction must be executed for German address');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '152';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('152', '100.380.201', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'no risk management process type specified');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '153';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('153', '100.380.202', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'unknown risk management process type');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '154';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('154', '100.380.302', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'wrong type of referenced transaction in risk management');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '155';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('155', '100.380.305', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'no frontend information provided for asynchronous transaction');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '156';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('156', '100.380.306', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'no authentication data provided in risk management transaction');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '157';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('157', '100.380.401', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'User Authentication Failed');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '158';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('158', '100.380.501', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'risk management transaction timeout');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '169';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('159', '100.390.101', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'purchase amount/currency mismatch');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '160';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('160', '100.390.102', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'PARes Validation failed');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '161';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('161', '100.390.103', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'PARes Validation failed - problem with signature');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '162';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('162', '100.390.104', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'XID mismatch');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '163';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('163', '100.390.105', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Transaction rejected because of technical error in 3DSecure system');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '164';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('164', '100.390.106', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Transaction rejected because of error in 3DSecure configuration');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '165';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('165', '100.390.107', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Transaction rejected because cardholder authentication unavailable');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '166';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('166', '100.390.108', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Transaction rejected because merchant not participating in 3DSecure program');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '167';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('167', '100.390.109', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Transaction rejected because of VISA status \"U\" in 3DSecure program');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '168';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('168', '100.395.101', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Bank not supported for online transfer');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '169';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('169', '100.395.102', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Account not enabled for online transfer e.g. test account');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '170';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('170', '100.395.501', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Previously pending online transfer transaction timed out');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '171';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('171', '100.395.502', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Acquirer/Bank reported timeout on online transfer transaction');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '172';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('172', '100.396.101', 1, 'Kundenabbruch', 'Canceled by user', 'Canceled by user');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '173';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('173', '100.396.102', 1, 'kein Passwort eingegeben', 'password empty', 'Not confirmed by user');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '174';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('174', '100.396.103', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Previously pending transaction timed out');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '175';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('175', '100.396.104', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Uncertain status - probably canceled by user');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '176';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('176', '100.400.000', 1, 'falsche Adresse', 'invalid address', 'transaction declined (Wrong Address)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '177';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('177', '100.400.001', 1, 'falsches Passwort eingegeben', 'invalid password', 'transaction declined (Wrong Identification)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '178';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('178', '100.400.002', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction declined (Insufficient credibility score)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '179';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('179', '100.400.005', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction must be executed for German address');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '180';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('180', '100.400.007', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'System error ( possible incorrect/missing input data)');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '181';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('181', '100.400.020', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction declined');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '182';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('182', '100.400.021', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction declined for country');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '183';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('183', '100.400.030', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction not authorized. Please check manually');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '184';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('184', '100.400.039', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction declined for other error');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '185';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('185', '100.400.040', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'authorization failure');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '186';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('186', '100.400.041', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction must be executed for German address');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '187';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('187', '100.400.042', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction declined by SCHUFA (Insufficient credibility score)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '188';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('188', '100.400.043', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction declined because of missing obligatory parameter(s)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '189';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('189', '100.400.044', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction not authorized. Please check manually');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '190';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('190', '100.400.045', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'SCHUFA result not definite. Please check manually');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '191';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('191', '100.400.051', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'SCHUFA system error (possible incorrect/missing input data)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '192';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('192', '100.400.060', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'authorization failure');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '193';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('193', '100.400.061', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction declined (Insufficient credibility score)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '194';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('194', '100.400.063', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction declined because of missing obligatory parameter(s)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '195';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('195', '100.400.064', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction must be executed for Austrian, German or Swiss address');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '196';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('196', '100.400.065', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'result ambiguous. Please check manually');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '197';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('197', '100.400.071', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'system error (possible incorrect/missing input data)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '198';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('198', '100.400.080', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'authorization failure');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '199';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('199', '100.400.081', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction declined');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '200';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('200', '100.400.083', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction declined because of missing obligatory parameter(s)');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '201';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('201', '100.400.084', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction can not be executed for given country');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '202';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('202', '100.400.085', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'result ambiguous. Please check manually');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '203';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('203', '100.400.086', 1, 'falsche Adresse ', 'invalid address', 'transaction declined (Wrong Address)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '204';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('204', '100.400.087', 1, 'falsches Passwort eingegeben', 'invalid password', 'transaction declined (Wrong Identification)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '205';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('205', '100.400.091', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'system error (possible incorrect/missing input data)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '206';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('206', '100.400.100', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction declined - very bad rating');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '207';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('207', '100.400.120', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'authorization failure');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '208';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('208', '100.400.121', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'account blacklisted');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '209';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('209', '100.400.122', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction must be executed for valid German account');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '210';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('210', '100.400.123', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction declined because of missing obligatory parameter(s)');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '211';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('211', '100.400.130', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'system error (possible incorrect/missing input data)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '212';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('212', '100.500.100', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'request contains no payment method');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '213';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('213', '100.500.101', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'payment method invalid');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '214';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('214', '100.500.200', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'request contains no payment type');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '215';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('215', '100.500.201', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'payment type invalid');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '216';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('216', '100.550.300', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'request contains no amount or too low amount');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '217';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('217', '100.550.301', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'amount too large');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '218';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('218', '100.550.302', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'amount invalid');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '219';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('219', '100.550.303', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'amount format invalid (only two decimals allowed).');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '220';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('220', '100.550.310', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'amount exceeds limit for the registered account.');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '221';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('221', '100.550.311', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'exceeding account balance');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '222';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('222', '100.550.312', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Amount is outside allowed ticket size boundaries');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '223';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('223', '100.550.400', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'request contains no currency');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '224';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('224', '100.550.401', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid currency');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '225';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('225', '100.600.500', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'usage field too long');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '226';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('226', '100.700.100', 1, 'Kein Familienname angegeben', 'request contains no family name', 'request contains no family name');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '227';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('227', '100.700.101', 1, 'Familienname zu lang', 'family name too long', 'family name too long');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '228';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('228', '100.700.102', 1, 'Ungültiger Familienname', 'invalid family name (contains no vowel)', 'invalid family name (contains no vowel)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '229';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('229', '100.700.200', 1, 'Kein Vorname angegeben', 'request contains no given name', 'request contains no given name');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '230';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('230', '100.700.201', 1, 'Vorname zu lang', 'given name too long', 'given name too long');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '231';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('231', '100.700.202', 1, 'Ungültiger Vorname', 'invalid given name (contains no vowel)', 'invalid given name (contains no vowel)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '232';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('232', '100.700.300', 1, 'Ungültige Anrede', 'invalid salutation', 'invalid salutation');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '233';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('233', '100.700.400', 1, 'Ungültiger Titel', 'invalid title', 'invalid title');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '234';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('234', '100.700.500', 1, 'Firmenname zu lang', 'company name too long', 'company name too long');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '235';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('235', '100.700.600', 1, 'Vor- oder Familienname ungültig', 'family and/or given name invalid', 'family and/or given name invalid');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '236';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('236', '100.700.800', 1, 'identity contains no or invalid \"paper\"', 'identity contains no or invalid \"paper\"', 'identity contains no or invalid \"paper\"');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '237';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('237', '100.700.801', 1, 'identity contains no or invalid identification value', 'identity contains no or invalid identification value', 'identity contains no or invalid identification value');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '238';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('238', '100.700.802', 1, 'identification value too long', 'identification value too long', 'identification value too long');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '239';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('239', '100.700.810', 1, 'specify at least one identity', 'specify at least one identity', 'specify at least one identity');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '240';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('240', '100.800.100', 1, 'Keine Straße angegeben', 'request contains no street', 'request contains no street');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '241';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('241', '100.800.101', 1, 'Straßenname zu lang', 'street too long', 'street too long');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '242';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('242', '100.800.102', 1, 'Ungültige Straße', 'invalid street', 'invalid street');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '243';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('243', '100.800.200', 1, 'Keine Postleitzahl angegeben', 'request contains no zip', 'request contains no zip');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '244';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('244', '100.800.201', 1, 'Postleitzahl zu lang', 'zip too long', 'zip too long');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '245';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('245', '100.800.202', 1, 'Ungültige Postleitzahl', 'invalid zip', 'invalid zip');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '246';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('246', '100.800.300', 1, 'Kein Stadtname angegeben', 'request contains no city', 'request contains no city');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '247';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('247', '100.800.301', 1, 'Stadtname zu lang', 'city to long', 'city to long');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '248';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('248', '100.800.302', 1, 'Ungültige Stadt', 'invalid city', 'invalid city');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '249';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('249', '100.800.400', 1, 'Ungültige Staat/Land-Kombination', 'invalid state/country combination', 'invalid state/country combination');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '250';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('250', '100.800.401', 1, 'Staat zu lang', 'state to long', 'state to long');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '251';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('251', '100.800.500', 1, 'Kein Land übergeben', 'request contains no country', 'request contains no country');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '252';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('252', '100.800.501', 1, 'Ungültiges Land', 'invalid country', 'invalid country');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '253';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('253', '100.900.100', 1, 'Keine eMail-Adresse angegeben', 'request contains no email address', 'request contains no email address');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '254';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('254', '100.900.101', 1, 'Ungültige eMail-Adresse', 'invalid email address (probably invalid syntax)', 'invalid email address (probably invalid syntax)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '255';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('255', '100.900.102', 1, 'Kein eMail-Server gefunden', 'non existing email server', 'non existing email server');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '256';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('256', '100.900.103', 1, 'eMail-Konto nicht gefunden', 'non existing email address (mailbox non existing on server)', 'non existing email address (mailbox non existing on server)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '257';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('257', '100.900.105', 1, 'eMail-Adresse zu lang', 'email address too long (max 50 chars)', 'email address too long (max 50 chars)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '258';",
        'do'    => 'INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES("258", "100.900.200", 1, "Ungültige Tel.-Nr", "invalid phone number (has to start with a digit or a \"+\", at least 7 and max 25 chars long)", "invalid phone number (has to start with a digit or a \"+\", at least 7 and max 25 chars long)");',
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '259';",
        'do'    => 'INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES("259", "100.900.300", 1, "Ungültige Mobiltel.-Nr", "invalid mobile phone number (has to start with a digit or a \"+\", at least 7 and max 25 chars long)", "invalid mobile phone number (has to start with a digit or a \"+\", at least 7 and max 25 chars long)");',
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '260';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('260', '100.900.301', 1, 'Mobiltelefon Nummer fehlt', 'request contains no mobile phone number ', 'mobile phone number mandatory');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '261';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('261', '100.900.400', 1, 'Keine IP-Nummer gefunden', 'request contains no ip number', 'request contains no ip number');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '262';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('262', '100.900.401', 1, 'Ungültige IP-Nummer', 'invalid ip number', 'invalid ip number');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '263';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('263', '100.900.450', 1, 'ungültiges Geburtsdatum', 'invalid birthdate', 'invalid birthdate');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '264';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('264', '100.900.500', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid recurrence mode');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '265';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('265', '200.100.100', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid Request. Serious Structure Error!');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '266';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('266', '200.100.101', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid Request Message. No valid XML. XML must be url-encoded! maybe it contains a not encoded ampersand or something similar.');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '267';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('267', '200.100.102', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid Request. XML load missing (XML string must be sent within parameter \"load\")');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '268';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('268', '200.100.103', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid Request Message. The request contains structural errors');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '269';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('269', '200.100.150', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction of multirequest not processed because of subsequent problems');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '270';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('270', '200.100.151', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'multi-request is allowed with a maximum of 10 transactions only');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '271';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('271', '200.100.199', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Wrong Web Interface / URL used. Please check out the Tech Quick Start Doc Chapter 3.');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '272';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('272', '200.100.201', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid Request/Transaction tag (not present or [paritially] empty)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '273';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('273', '200.100.300', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid Request/Transaction/Payment tag (no or invalid code specified)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '274';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('274', '200.100.301', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid Request/Transaction/Payment tag (not present or [paritially] empty)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '275';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('275', '200.100.302', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid Request/Transaction/Payment/Presentation tag (not present or [paritially] empty)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '276';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('276', '200.100.401', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid Request/Transaction/Account tag (not present or [paritially] empty)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '277';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('277', '200.100.402', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid Request/Transaction/Account(Customer) tag (either Account or Customer must be present)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '278';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('278', '200.100.403', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid Request/Transaction/Account(Customer, Relevance) tag (one of Account/Customer/Relevance must be present)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '279';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('279', '200.100.404', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid Request/Transaction/Account (must not be present)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '280';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('280', '200.100.501', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid Request/Transaction/Customer tag (not present or [paritially] empty)');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '281';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('281', '200.100.502', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid Request/Transaction/Customer/Name tag (not present or [paritially] empty)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '282';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('282', '200.100.503', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid Request/Transaction/Customer/Contact tag (not present or [paritially] empty)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '283';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('283', '200.100.504', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid Request/Transaction/Customer/Address tag (not present or [paritially] empty)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '284';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('284', '200.200.101', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid format for processing by gateway');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '285';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('285', '200.200.102', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid format for processing by gateway (no merchant id)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '286';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('286', '200.200.103', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid format for processing by gateway (no refenrence id)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '287';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('287', '200.200.104', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid format for processing by gateway (no/invalid amount)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '288';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('288', '200.200.105', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid format for processing by gateway (no/invalid brand)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '289';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('289', '200.200.106', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid format for processing by gateway (no/invalid currency)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '290';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('290', '200.200.107', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid format for processing by gateway (no accountnumber)');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '291';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('291', '200.200.108', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid format for processing by gateway (no expirydate)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '292';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('292', '200.200.109', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid format for processing by gateway (no bankcode)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '293';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('293', '200.200.110', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid format for processing by gateway (no/invalid paymentmethod)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '294';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('294', '200.200.111', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid format for processing by gateway (no gateway supplied id)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '295';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('295', '200.200.112', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid format for processing by gateway (no holder)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '296';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('296', '500.100.201', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Channel/Merchant is disabled (no processing possible)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '297';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('297', '500.100.202', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Channel/Merchant is new (no processing possible yet)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '298';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('298', '500.100.203', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Channel/Merchant is closed (no processing possible)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '299';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('299', '500.100.301', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Merchant-Connector is disabled (no processing possible)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '300';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('300', '500.100.302', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Merchant-Connector is new (no processing possible yet)');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '301';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('301', '500.100.303', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Merchant-Connector is closed (no processing possible)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '302';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('302', '500.100.304', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Merchant-Connector is disabled at gateway (no processing possible)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '303';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('303', '500.100.401', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Connector is unavailable (no processing possible)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '304';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('304', '500.100.402', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Connector is new (no processing possible yet)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '305';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('305', '500.100.403', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Connector is unavailable (no processing possible)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '306';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('306', '500.200.101', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'No target account configured for DD transaction');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '307';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('307', '600.100.100', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Unexpected Integrator Error (Request could not be processed)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '308';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('308', '600.200.100', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid Payment Method');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '309';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('309', '600.200.200', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Unsupported Payment Method');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '310';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('310', '600.200.201', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Channel/Merchant not configured for this payment method');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '311';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('311', '600.200.202', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Channel/Merchant not configured for this payment type');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '312';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('312', '600.200.300', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid Payment Type');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '313';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('313', '600.200.310', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid Payment Type for given Payment Method');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '314';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('314', '600.200.400', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Unsupported Payment Type');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '315';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('315', '600.200.500', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Invalid payment data. You are not configured for this currency or sub type (country or brand)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '316';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('316', '600.200.600', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid payment code (type or method)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '317';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('317', '600.200.700', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid payment mode (you are not configured for the requested transaction mode)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '318';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('318', '600.200.800', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid brand for given payment method and payment mode (you are not configured for the requested transaction mode)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '319';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('319', '600.200.810', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid return code provided');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '320';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('320', '700.100.100', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'reference id not existing');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '321';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('321', '700.100.200', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'non matching reference amount');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '322';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('322', '700.100.300', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid amount (probably too large)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '323';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('323', '700.100.400', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'referenced payment method does not match with requested payment method');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '324';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('324', '700.100.500', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'referenced payment currency does not match with requested payment currency');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '325';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('325', '700.100.600', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'referenced mode does not match with requested payment mode');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '326';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('326', '700.100.700', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'referenced transaction is of inappropriate type');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '327';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('327', '700.100.710', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'cross-linkage of two transaction-trees');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '328';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('328', '700.200.100', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'referenced year does not match');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '329';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('329', '700.200.200', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'referenced month does not match');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '330';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('330', '700.200.250', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'referenced expirydate does not match');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '331';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('331', '700.200.300', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'referenced account does not match');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '332';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('332', '700.200.400', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'referenced cvv does not match');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '333';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('333', '700.200.500', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'referenced holder does not match');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '334';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('334', '700.200.600', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'referenced currency does not match');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '335';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('335', '700.300.100', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'referenced tx can not be refunded, captured or reversed (invalid type)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '336';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('336', '700.300.200', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'referenced tx was rejected');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '337';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('337', '700.300.300', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'referenced tx can not be refunded, captured or reversed (already refunded, captured or reversed)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '338';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('338', '700.300.400', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'referenced tx can not be captured (cut off time reached)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '339';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('339', '700.300.500', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'chargeback error (multiple chargebacks)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '340';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('340', '700.300.600', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'referenced tx can not be refunded or reversed (was chargebacked)');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '341';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('341', '700.300.700', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'referenced tx can not be reversed (reversal not possible anymore)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '342';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('342', '700.400.000', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'serious workflow error (call support)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '343';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('343', '700.400.100', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'cannot capture (PA value exceeded or invalid workflow?)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '344';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('344', '700.400.101', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'cannot capture (Not supported by authorization system)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '345';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('345', '700.400.200', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'cannot refund (refund volume exceeded or tx reversed or invalid workflow?)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '346';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('346', '700.400.300', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'cannot reverse (already refunded|reversed or invalid workflow?)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '347';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('347', '700.400.400', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'cannot chargeback (already chargebacked or invalid workflow?)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '348';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('348', '700.400.402', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'chargeback can only be generated internally by the payment system');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '349';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('349', '700.400.410', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'cannot reversal chargeback (chargeback is already reversaled or invalid workflow?)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '350';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('350', '700.400.420', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'cannot reversal chargeback (no chargeback existing or invalid workflow?)');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '351';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('351', '700.400.510', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'capture needs at least one successful transaction of type (PA)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '352';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('352', '700.400.520', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'refund needs at least one successful transaction of type (CP or DB or RB or RC)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '353';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('353', '700.400.530', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'reversal needs at least one successful transaction of type (CP or DB or RB)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '354';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('354', '700.400.540', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'reconceile needs at least one successful transaction of type (CP or DB or RB)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '355';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('355', '700.400.550', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'chargeback needs at least one successful transaction of type (CP or DB or RB)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '356';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('356', '700.400.560', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'receipt needs at least one successful transaction of type (PA or CP or DB or RB)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '357';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('357', '700.400.561', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'receipt on a registration needs a successfull registration in state \"OPEN\"');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '358';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('358', '700.400.562', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'receipts can only be generated internally by the payment system');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '359';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('359', '700.400.570', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'cannot reference a waiting/pending transaction');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '360';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('360', '700.400.700', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'initial and referencing channel-ids do not match');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '361';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('361', '700.450.001', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'cannot transfer money from one account to the same account');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '362';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('362', '800.100.100', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction declined for unknown reason');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '363';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('363', '800.100.150', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction declined (refund on gambling tx not allowed)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '364';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('364', '800.100.151', 3, 'Ungültige Karte', 'transaction declined (invalid card)', 'transaction declined (invalid card)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '365';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('365', '800.100.152', 3, 'Zahlung abgelehnt', 'transaction declined', 'transaction declined by authorization system');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '366';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('366', '800.100.153', 2, 'Ungültige Prüfziffer', 'transaction declined (invalid CVV)', 'transaction declined (invalid CVV)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '367';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('367', '800.100.154', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction declined (transaction marked as invalid)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '368';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('368', '800.100.155', 3, 'Zahlung abgelehnt', 'transaction declined', 'transaction declined (amount exceeds credit)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '369';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('369', '800.100.156', 3, 'Zahlung abgelehnt', 'transaction declined', 'transaction declined (format error)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '370';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('370', '800.100.157', 1, 'Karte abgelaufen', 'transaction declined (expiry date exceeded)', 'transaction declined (expiry date exceeded)');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '371';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('371', '800.100.158', 3, 'Zahlung abgelehnt', 'transaction declined', 'transaction declined (suspecting manipulation)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '372';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('372', '800.100.159', 3, 'Zahlung abgelehnt', 'transaction declined', 'transaction declined (stolen card)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '373';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('373', '800.100.160', 3, 'Zahlung abgelehnt', 'transaction declined', 'transaction declined (card blocked)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '374';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('374', '800.100.161', 3, 'Zahlung abgelehnt', 'transaction declined', 'transaction declined (too many invalid tries)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '375';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('375', '800.100.162', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction declined (limit exceeded)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '376';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('376', '800.100.163', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction declined (maximum transaction frequency exceeded)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '377';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('377', '800.100.164', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction declined (merchants limit exceeded)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '378';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('378', '800.100.165', 3, 'Zahlung abgelehnt', 'transaction declined', 'transaction declined (card lost)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '379';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('379', '800.100.166', 3, 'Zahlung abgelehnt', 'transaction declined', 'transaction declined (Incorrect personal identification number)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '380';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('380', '800.100.167', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction declined (referencing transaction does not match)');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '381';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('381', '800.100.168', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction declined (restricted card)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '382';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('382', '800.100.169', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction declined (card type is not processed by the authorization center)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '383';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('383', '800.100.170', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction declined (transaction not permitted)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '384';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('384', '800.100.171', 3, 'Konto gesperrt', 'account blocked', 'transaction declined (pick up card)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '385';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('385', '800.100.172', 3, 'Zahlung abgelehnt', 'transaction declined', 'transaction declined (account blocked)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '386';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('386', '800.100.173', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction declined (invalid currency, not processed by authorization center)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '387';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('387', '800.100.174', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction declined (invalid amount)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '388';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('388', '800.100.175', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction declined (invalid brand)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '389';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('389', '800.100.176', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction declined (account temporarily not available. Please try again later)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '390';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('390', '800.100.190', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction declined (invalid configuration data)');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '391';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('391', '800.100.191', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction declined (transaction in wrong state on aquirer side)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '392';",
        'do'    => 'INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES("392", "800.100.192", 2, "Es ist ein allgemeiner technischer Fehler aufgetreten", "general technical system error", "transaction declined (invalid CVV, Amount has still been reserved on the customer\'s card and will be released in a few business days. Please ensure the CVV code is accurate before retrying the transaction)");',
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '393';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('393', '800.100.195', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction declined (UserAccount Number/ID unknown)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '394';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('394', '800.100.196', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction declined (registration error)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '395';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('395', '800.100.197', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction declined (registration canceled externally)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '396';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('396', '800.100.500', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Card holder has advised his bank to stop this recurring payment');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '397';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('397', '800.100.501', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Card holder has advised his bank to stop all recurring payments for this merchant');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '398';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('398', '800.110.100', 2, 'Dopppelte Transaktion. Bitte melden Sie sich beim Shopinhaber!', 'doublicate transaction', 'doublicate transaction');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '399';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('399', '800.120.100', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'maximum number of transactions already exceeded');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '400';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('400', '800.120.101', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'maximum number of transactions per account already exceeded');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '401';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('401', '800.120.102', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'maximum number of transactions per ip already exceeded');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '402';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('402', '800.120.103', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'maximum number of transactions per email already exceeded');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '403';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('403', '800.120.200', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'maximum total volume of transactions already exceeded');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '404';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('404', '800.120.201', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'maximum total volume of transactions per account already exceeded');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '405';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('405', '800.120.202', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'maximum total volume of transactions per ip already exceeded');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '406';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('406', '800.120.203', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'maximum total volume of transactions per email already exceeded');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '407';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('407', '800.120.300', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'chargeback rate per bin exceeded');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '408';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('408', '800.120.401', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'maximum number of transactions or total volume for configured MIDs or CIs exceeded');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '409';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('409', '800.121.100', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Channel not configured for given source type. Please contact your account manager.');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '410';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('410', '800.130.100', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Transaction with same TransactionId already exists');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '411';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('411', '800.140.100', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'maximum number of registrations per mobile number exceeded');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '412';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('412', '800.140.101', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'maximum number of registrations per email address exceeded');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '413';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('413', '800.140.110', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'maximum number of registrations of mobile per credit card number exceeded');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '414';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('414', '800.140.111', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'maximum number of registrations of credit card number per mobile exceeded');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '415';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('415', '800.140.112', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'maximum number of registrations of email per credit card number exceeded');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '416';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('416', '800.140.113', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'maximum number of registrations of credit card per number email exceeded');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '417';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('417', '800.150.100', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Account Holder does not match Customer Name');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '418';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('418', '800.160.100', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Invalid payment data for configured Shopper Dispatching Type');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '419';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('419', '800.160.110', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Invalid payment data for configured Payment Dispatching Type');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '420';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('420', '800.160.120', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Invalid payment data for configured Recurring Transaction Dispatching Type');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '421';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('421', '800.200.101', 3, 'Zahlung abgelehnt', 'transaction declined', 'creditcard / bank account declined by clearing house');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '422';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('422', '800.200.159', 3, 'Zahlung abgelehnt', 'transaction declined', 'account or user is blacklisted (card stolen)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '423';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('423', '800.200.160', 3, 'Zahlung abgelehnt', 'transaction declined', 'account or user is blacklisted (card blocked)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '424';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('424', '800.200.165', 3, 'Zahlung abgelehnt', 'transaction declined', 'account or user is blacklisted (card lost)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '425';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('425', '800.200.202', 3, 'Zahlung abgelehnt', 'transaction declined', 'account or user is blacklisted (account closed)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '426';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('426', '800.200.208', 3, 'Zahlung abgelehnt', 'transaction declined', 'account or user is blacklisted (account blocked)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '427';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('427', '800.200.220', 3, 'Zahlung abgelehnt', 'transaction declined', 'account or user is blacklisted (fraudulent transaction)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '428';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('428', '800.300.101', 3, 'Zahlung abgelehnt', 'transaction declined', 'account or user is blacklisted');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '429';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('429', '800.300.102', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'country blacklisted');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '430';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('430', '800.300.200', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'email is blacklisted');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '431';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('431', '800.300.301', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'ip blacklisted');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '432';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('432', '800.300.302', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'ip is anonymous proxy');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '433';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('433', '800.300.401', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'bin blacklisted');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '434';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('434', '800.300.500', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction declined (too many invalid CVV tries, temporary blacklisted)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '435';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('435', '800.300.501', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction declined (too many invalid \"expire date\" tries, temporary blacklisted)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '436';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('436', '800.400.100', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'AVS Check Failed');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '437';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('437', '800.400.101', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Mismatch of AVS street value');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '438';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('438', '800.400.102', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Mismatch of AVS street number');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '439';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('439', '800.400.103', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Mismatch of AVS PO box value fatal');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '440';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('440', '800.400.104', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Mismatch of AVS zip code value fatal');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '441';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('441', '800.400.105', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Mismatch of AVS settings (AVSkip, AVIgnore, AVSRejectPolicy) value');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '442';",
        'do'    => 'INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES("442", "800.400.110", 2, "Es ist ein allgemeiner technischer Fehler aufgetreten", "general technical system error", "AVS Check Failed. Amount has still been reserved on the customer\'s card and will be released in a few business days. Please ensure the billing address is accurate before retrying the transaction.");',
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '443';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('443', '800.400.150', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Implausible address data');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '444';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('444', '800.400.151', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Implausible address state data');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '445';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('445', '800.500.100', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'direct debit transaction declined for unknown reason');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '446';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('446', '800.500.110', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Unable to process transaction - ran out of terminalIds - please contact acquirer');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '447';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('447', '800.600.100', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction is being already processed');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '448';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('448', '800.700.100', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'transaction for the same session is currently being processed, please try again later.');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '449';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('449', '800.800.800', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'The payment system is currenty unavailable, please contact suport@ctpe.net in case this happens again.');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '450';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('450', '800.800.801', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'The payment system is currenty unter maintenance. Please apologize for the inconvenience this may cause. If you were not informed of this maintenance window in advance, contact your sales representative.');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '451';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('451', '800.900.100', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'sender authorization failed');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '452';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('452', '800.900.200', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'unknown channel');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '453';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('453', '800.900.300', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'user authorization failed');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '454';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('454', '800.900.301', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'user authorization failed, user has no sufficient rights to process transaction');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '455';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('455', '900.100.100', 2, 'Bank sendet keine Rückmeldung.', 'unexpected communication error with connector/acquirer', 'unexpected communication error with connector/acquirer');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '456';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('456', '900.100.200', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'error response from connector/acquirer');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '457';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('457', '900.100.200', 2, 'Bank meldet Fehler', 'error response from connector/acquirer', 'error response from connector/acquirer');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '458';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('458', '900.100.201', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'serious error on gateway');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '459';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('459', '900.100.202', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'invalid message flow');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '460';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('460', '900.100.300', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'no response from connector/acquirer [uncertain result]');",
    ),
    //-------------------------------------------
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '461';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('461', '900.100.400', 2, 'Bank sendet keine Rückmeldung.', 'timeout at connectors/acquirer side', 'timeout at connectors/acquirer side');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '462';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('462', '900.100.500', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'timeout at connectors/acquirer side (try later)');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '463';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('463', '900.100.600', 2, 'Bank antwortet nicht', 'acquirer currently down', 'connector/acquirer currently down');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '464';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('464', '900.200.100', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'Message Sequence Number of Connector out of sync');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '465';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('465', '900.300.600', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'user session timeout');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '466';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('466', '900.400.100', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'unexpected communication error with external risk provider');",
    ),
    array(
        'check' => "SELECT if(count(OXID), 0, 1) FROM d3hperrortexts WHERE oxid = '467';",
        'do'    => "INSERT IGNORE INTO `d3hperrortexts` (`OXID`, `OXCODE`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXREALTEXT`) VALUES('467', '999.999.999', 2, 'Es ist ein allgemeiner technischer Fehler aufgetreten', 'general technical system error', 'UNDEFINED CONNECTOR/ACQUIRER ERROR');",
    ),
);
