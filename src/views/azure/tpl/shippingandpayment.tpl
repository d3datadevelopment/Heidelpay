[{if $d3HpShowEasyCreditParameter}]
    [{assign var="sImageUrl" value=$oViewConf->getModuleUrl('d3heidelpay','out/img/')}]
    [{assign var="sBrandIdent" value='EASYCREDIT'}]
    [{assign var="sFullImageUrl" value=$sImageUrl|cat:'logo_ratenkauf_ec.jpg'}]
    <div class="d3EasyCreditNotesAzure">
        <h3 class="section">
            <strong>[{oxmultilang ident="D3HEIDELPAY_ORDER_EASYCREDIT_TITLE"}]</strong>
            [{include file="d3_heidelpay_views_tpl_payment_img.tpl" sImageUrl=$sFullImageUrl sBrandIdent=$sBrandIdent}]
        </h3>
        <div>
            <div>[{$d3HPEASYCREDIT_AMORTISATIONTEXT}]</div>
            <a href="[{$d3HPEASYCREDIT_PRECONTRACTINFORMATIONURL}]"
               target="easyCredit">[{oxmultilang ident="D3HEIDELPAY_ORDER_EASYCREDIT_LINK"}]</a>
        </div>
    </div>
[{/if}]

