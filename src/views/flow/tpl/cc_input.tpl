[{capture append="oxidBlock_content"}]
    [{* ordering steps *}]
    [{include file="page/checkout/inc/steps.tpl" active=4}]
    <div class="panel panel-default">
        <div class="panel-heading text-center">[{oxmultilang ident="D3HEIDELPAY_CC_INPUT_TITLENR"}]</div>
        <div id="payment" class="panel-body">
            [{include file=$oView->d3GetAfterStepTemplate()}]
        </div>
    </div>
    [{insert name="oxid_tracker" title=$template_title}]
[{/capture}]
[{include file="layout/page.tpl"}]
