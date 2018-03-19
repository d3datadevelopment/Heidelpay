[{$smarty.block.parent}]
[{d3modcfgcheck modid="d3heidelpay"}][{/d3modcfgcheck}]

[{if $mod_d3heidelpay && $oViewConf->getActiveClassname() === 'order'}]
    [{assign var="easyCreditInformations" value=$oView->getHeidelpayEasyCreditInformations()}]
    [{if isset($easyCreditInformations)}]
        [{include file=$oView->d3GetTemplateName('order_easycreditcriterions') easyCreditInformations=$easyCreditInformations}]
    [{/if}]
[{/if}]
