[{$smarty.block.parent}]
[{if $oViewConf->getActiveClassName() == 'd3_heidelpay_controllers_admin_adminlist'
|| $oViewConf->getActiveClassName() == 'd3_heidelpay_controllers_admin_transactionloglist'
|| $oViewConf->getActiveClassName() == 'd3_heidelpay_controllers_admin_order_heidelpay' }]
    [{assign var="sCssUrl" value=$oViewConf->getModuleUrl('d3heidelpay','out/src/css/')}]
    <link rel="stylesheet" href="[{$sCssUrl}]d3heidelpay_admin.css?235">
    <link rel="stylesheet" href="[{$oViewConf->getModuleUrl('d3modcfg_lib', 'out/admin/src/d3_mod_cfg.css')}]">
    <link rel="stylesheet" href="[{$oViewConf->getModuleUrl('d3modcfg_lib', 'out/admin/src/font-awesome.min.css')}]">
    <script type="text/javascript" src="[{$oViewConf->getResourceUrl()}]js/libs/jquery.min.js"></script>
[{/if}]
