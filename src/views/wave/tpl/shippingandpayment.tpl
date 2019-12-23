[{if $d3HpShowEasyCreditParameter}]
    [{assign var="sImageUrl" value=$oViewConf->getModuleUrl('d3heidelpay','out/img/')}]
    [{assign var="sBrandIdent" value='EASYCREDIT'}]
    [{assign var="sFullImageUrl" value=$sImageUrl|cat:'logo_ratenkauf_ec.jpg'}]
    <div class="card card-default d3EasyCreditNotes">
        <div class="card-header">
            <h3 class="card-title">
                [{oxmultilang ident="D3HEIDELPAY_ORDER_EASYCREDIT_TITLE"}]
                [{include file="d3_heidelpay_views_tpl_payment_img.tpl" sImageUrl=$sFullImageUrl sBrandIdent=$sBrandIdent}]
            </h3>
        </div>
        <div class="card-body">
            <div>[{$d3HPEASYCREDIT_AMORTISATIONTEXT}]</div>
            <a href="[{$d3HPEASYCREDIT_PRECONTRACTINFORMATIONURL}]" target="easyCredit"
               class="fontunderline">[{oxmultilang ident="D3HEIDELPAY_ORDER_EASYCREDIT_LINK"}]</a>
        </div>
    </div>
[{/if}]

