[{capture append="oxidBlock_content"}]
    [{* ordering steps *}]
    [{include file="page/checkout/inc/steps.tpl" active=4}]
    <div class="card card-default">
        <div class="card-header text-center">[{oxmultilang ident="D3HEIDELPAY_CC_INPUT_TITLENR"}]</div>
        <div id="payment" class="card-body">
            [{include file=$oView->d3GetAfterStepTemplate()}]
        </div>
    </div>
    [{insert name="oxid_tracker" title=$template_title}]
[{/capture}]
[{include file="layout/page.tpl"}]
