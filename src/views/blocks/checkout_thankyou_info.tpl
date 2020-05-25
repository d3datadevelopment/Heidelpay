[{$smarty.block.parent}]

[{d3modcfgcheck modid="d3heidelpay"}][{/d3modcfgcheck}]

[{if $mod_d3heidelpay }]
    [{assign var="oPrePaymentData" value=$order->getHeidelpayBankTransferData()}]
    [{assign var="easyCreditInformations" value=$order->getHeidelpayEasyCreditInformations()}]

    [{if $oPrePaymentData}]
        [{include file=$oView->d3GetBankTransferDataTemplateName()}]
    [{/if}]

    [{if isset($easyCreditInformations)}]
        [{assign var="currency" value=$oView->getActCurrency()}]
        [{include file=$oView->d3GetTemplateName('thankyou_easycreditcriterions') easyCreditInformations=$easyCreditInformations}]
    [{/if}]
[{/if}]
