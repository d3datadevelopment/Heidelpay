[{d3modcfgcheck modid="d3heidelpay"}][{/d3modcfgcheck}][{if $mod_d3heidelpay }][{assign var="oPrePaymentData" value=$order->getHeidelpayBankTransferData()}]
[{assign var="easyCreditInformations" value=$order->getHeidelpayEasyCreditInformations()}]
[{if $oPrePaymentData}]
##########################################################

[{oxmultilang ident="D3HEIDELPAY_EMAIL_PREPAYMENT_INFOTEXT1"}]
[{oxmultilang ident="D3HEIDELPAY_EMAIL_PREPAYMENT_INFOTEXT2"}]

[{oxmultilang ident="D3HEIDELPAY_EMAIL_PREPAYMENT_ACCOUNTHOLDER"}] [{$oPrePaymentData->Holder}]
[{oxmultilang ident="D3HEIDELPAY_EMAIL_PREPAYMENT_IBAN"}] [{$oPrePaymentData->Iban}]
[{oxmultilang ident="D3HEIDELPAY_EMAIL_PREPAYMENT_BIC"}] [{$oPrePaymentData->Bic}]
[{oxmultilang ident="D3HEIDELPAY_EMAIL_PREPAYMENT_AMOUNT"}] [{$oPrePaymentData->Amount}] [{$oPrePaymentData->Currency}]
[{oxmultilang ident="D3HEIDELPAY_EMAIL_PREPAYMENT_REASON"}] [{$oPrePaymentData->Reference}]


##########################################################
[{/if}]
[{if $easyCreditInformations}]##########################################################
[{oxmultilang ident="D3HEIDELPAY_ORDER_EASYCREDIT_ACCRUINGINTEREST"}] [{oxprice price=$easyCreditInformations.criterion_easycredit_accruinginterest currency=$currency}]
[{oxmultilang ident="D3HEIDELPAY_ORDER_EASYCREDIT_TOTALAMOUNT"}] [{oxprice price=$easyCreditInformations.criterion_easycredit_totalamount currency=$currency}]
[{oxmultilang ident="D3HEIDELPAY_ORDER_EASYCREDIT_LINK"}]: [{$easyCreditInformations.criterion_easycredit_precontractinformationurl}]
##########################################################[{/if}]
[{/if}]
[{$smarty.block.parent}]
