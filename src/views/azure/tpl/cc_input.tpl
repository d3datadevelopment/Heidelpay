[{capture append="oxidBlock_content"}]
    [{* ordering steps *}]
    <!-- ordering steps -->
    [{include file="page/checkout/inc/steps.tpl" active=4}]
    <h1 class="pageHead">[{oxmultilang ident="D3HEIDELPAY_CC_INPUT_TITLENR"}]</h1>
    <div id="payment">
        [{include file=$oView->d3GetAfterStepTemplate()}]
    </div>
    [{insert name="oxid_tracker" title=$template_title}]
[{/capture}]
[{include file="layout/page.tpl"}]
