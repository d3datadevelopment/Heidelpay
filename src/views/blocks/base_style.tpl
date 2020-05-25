[{$smarty.block.parent}]

[{d3modcfgcheck modid="d3heidelpay"}]
[{/d3modcfgcheck}]

[{if $oViewConf->getActiveClassName() == 'payment' || $oViewConf->getActiveClassName() == 'order'}]
    [{if $mod_d3heidelpay}]
        [{oxstyle include=$oViewConf->getModuleUrl('d3heidelpay', 'out/src/css/d3heidelpay.css')}]
    [{/if}]
[{/if}]

