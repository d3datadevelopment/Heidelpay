[{assign var="payment" value=$oView->getPayment()}]
[{assign var='oHeidelPaySettings' value=$oHeidelpayViewConfig->getSettings()}]
[{assign var='oHeidelPayment' value=$oHeidelPaySettings->getPayment($payment)}]
[{assign var="sImageUrl" value=$oViewConf->getModuleUrl('d3heidelpay','out/img/')}]
[{assign var="storeDatas" value=$oView->getUserHPStoreData($payment->getId())}]
[{assign var="d3HeidelpayPostparameter" value=$oView->d3GetHeidelpayPostparameter()}]
<form action="[{$oViewConf->getSslSelfLink()|oxaddparams:"&heidelpaytemplate=d3_heidelpay_views_mobile_tpl_cc_input.tpl"}]" method="post">
    [{foreach from=$d3HeidelpayPostparameter key="inputName" item="inputValue"}]
        <input type="hidden" name="[{$inputName}]" value="[{$inputValue}]">
    [{/foreach}]
    [{$oViewConf->getHiddenSid()}]
    [{$oViewConf->getNavFormParams()}]
    <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
    <input type="hidden" name="fnc" value="d3PayWithStoreData">
    <input type="hidden" name="challenge" value="[{$challenge}]">
    <input type="hidden" name="sDeliveryAddressMD5" value="[{$oView->getDeliveryAddressMD5()}]">
    <ul class="form">
        [{foreach from=$storeDatas item="storeData" key="storeDataId" name="storedDataIds"}]
        <li>
            <label class="status error corners" style="background: none; display:block;">
                <input type="radio" name="usehpstore" value="[{$storeDataId}]"[{if $smarty.foreach.storedDataIds.first}] checked[{/if}]>
                [{assign var="sBrandIdent" value=$storeData->aDynValue.kktype}]
                [{include file="d3_heidelpay_views_tpl_payment_img.tpl" sImageUrl=$sImageUrl|cat:"logo_"|cat:$sBrandIdent|lower|cat:".jpg" sBrandIdent=$sBrandIdent}]
                [{$storeData->aDynValue.kknumber}]
                [{oxmultilang ident="D3HEIDELPAY_CC_INPUT_EXPIRES"}] [{$storeData->aDynValue.kkmonth}]
                /[{$storeData->aDynValue.kkyear}]
                [{oxmultilang ident="D3HEIDELPAY_CC_INPUT_OWNER"}] [{$storeData->aDynValue.kkname}]
            </label>
        </li>
        [{/foreach}]
        <li>
            <label class="status error corners" style="background: none; display:block;">
                <input type="radio" name="usehpstore" value="0">
                [{oxmultilang ident="D3PAYMENT_EXT_STOREDUID_NEW_CARD"}]
            </label>
        </li>
        <li>
            <div class="alert alert-error d3heidelpay">
                [{oxmultilang ident="D3PAYMENT_EXT_STOREDUID_CC_SECURITYINFO"}]
            </div>
        </li>
    </ul>
    <ul class="form">
            <li><button type="submit"
                        name="userform"
                        class="submitButton nextStep largeButton"
                        id="paymentNextStepBottom">[{oxmultilang ident="D3HEIDELPAY_ORDER_PAGE_NEXTSTEP"}]</button></li>
        <li><a href="[{oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=order"}]" class="btn previous"
               id="paymentBackStepBottom">[{ oxmultilang ident="D3HEIDELPAY_ORDER_PAGE_BACKSTEPT" }]</a></li>
    </ul>
</form>
