[{$smarty.block.parent}]
[{d3modcfgcheck modid="d3heidelpay"}]
[{/d3modcfgcheck}]

[{if $mod_d3heidelpay}]
    [{include file=$oView->d3GetTemplateName('shippingandpayment')}]
[{/if}]
