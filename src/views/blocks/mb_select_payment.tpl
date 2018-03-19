[{d3modcfgcheck modid="d3heidelpay"}][{/d3modcfgcheck}]

[{if $mod_d3heidelpay && $oView->d3IsHeidelpayPaymentMethode($paymentmethod)}]
    [{include file=$oView->d3GetPaymentFormTemplateName($paymentmethod, 'mobile')}]
[{else}]
    [{$smarty.block.parent}]
[{/if}]
