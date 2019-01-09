<?php
//this file is an example for integration of banktransferdata into a ERP System or in invoice PDF or else
//include('bootstrap.php');

//load order
/** @var \D3\Heidelpay\Modules\Application\Model\Order $order */
$order = oxNew(\OxidEsales\Eshop\Application\Model\Order::class);
$order->load('88e7da68e5a6bf8ac7d5299f317869ed');

$order->getHeidelpayBankTransferData();
/* returns false or :
stdClass::__set_state(array(
    'Type' => 'd3_d3heidelpay_models_payment_invoice_unsecured',
    'Currency' => 'EUR',
    'Amount' => '33.80',
    'ShortID' => '3457.1523.6672',
    'UniqueID' => '31HA07BC81287D6A78968151B24C6A22',
    'TransactionID' => '4387__@@2016-12-15 09:00:36',
    'Bank' => '37040044',
    'Number' => '5320130',
    'Holder' => 'heidelpay GmbH',
    'Iban' => 'DE89370400440532013000',
    'Bic' => 'COBADEFFXXX',
    'Country' => 'DE',
    'Reference' => '3457.1523.6672',
))
*/
