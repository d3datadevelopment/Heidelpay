[{capture append="oxidBlock_content"}]
    [{oxscript include="js/widgets/oxdropdown.js" priority=10}]
    [{oxscript include="js/widgets/oxpaymentmethods.js" priority=10}]
    <div id="paymentSelect" class="content payment-select">
        [{* ordering steps *}]
        [{include file="page/checkout/inc/steps.tpl" active=4}]
        [{include file=$oView->d3GetAfterStepTemplate()}]
    </div>
    [{insert name="oxid_tracker" title=$template_title}]
[{/capture}]
[{include file="layout/page.tpl"}]
