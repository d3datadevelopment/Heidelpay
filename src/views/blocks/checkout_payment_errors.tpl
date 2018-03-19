[{d3modcfgcheck modid="d3heidelpay"}]
[{/d3modcfgcheck}]

[{if $mod_d3heidelpay && $d3heidelpayErrorCodes && $oHeidelpayViewConfig->getPaymentError() == -99}]
    [{include file=$oView->d3GetMessageTemplateName()}]
[{else}]
    [{$smarty.block.parent}]
[{/if}]
