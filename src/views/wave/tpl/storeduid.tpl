[{assign var="payment" value=$oView->getPayment()}]
[{assign var='oHeidelPaySettings' value=$oHeidelpayViewConfig->getSettings()}]
[{assign var='oHeidelPayment' value=$oHeidelPaySettings->getPayment($payment)}]
[{assign var="sImageUrl" value=$oViewConf->getModuleUrl('d3heidelpay','out/img/')}]
[{assign var="storeDatas" value=$oView->getUserHPStoreData($payment->getId())}]
[{assign var="d3HeidelpayPostparameter" value=$oView->d3GetHeidelpayPostparameter()}]
<form action="[{$oViewConf->getSslSelfLink()|oxaddparams:"&heidelpaytemplate=d3_heidelpay_views_wave_tpl_cc_input.tpl"}]"
      method="post">
    [{foreach from=$d3HeidelpayPostparameter key="inputName" item="inputValue"}]
        <input type="hidden" name="[{$inputName}]" value="[{$inputValue}]">
    [{/foreach}]
    [{$oViewConf->getHiddenSid()}]
    [{$oViewConf->getNavFormParams()}]
    <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
    <input type="hidden" name="fnc" value="d3PayWithStoreData">
    <input type="hidden" name="challenge" value="[{$challenge}]">
    <input type="hidden" name="sDeliveryAddressMD5" value="[{$oView->getDeliveryAddressMD5()}]">
    <div class="list-group">
        [{foreach from=$storeDatas item="storeData" key="storeDataId" name="storedDataIds"}]
            <div class="radio list-group-item">
                <label style="width:100%">
                    <input type="radio" name="usehpstore"
                           value="[{$storeDataId}]"[{if $smarty.foreach.storedDataIds.first}] checked[{/if}]>
                    [{assign var="sBrandIdent" value=$storeData->aDynValue.kktype}]
                    [{include file="d3_heidelpay_views_tpl_payment_img.tpl" sImageUrl=$sImageUrl|cat:"logo_"|cat:$sBrandIdent|lower|cat:".jpg" sBrandIdent=$sBrandIdent}]
                    [{$storeData->aDynValue.kknumber}]
                    [{oxmultilang ident="D3HEIDELPAY_CC_INPUT_EXPIRES"}] [{$storeData->aDynValue.kkmonth}]
                    /[{$storeData->aDynValue.kkyear}]
                    [{oxmultilang ident="D3HEIDELPAY_CC_INPUT_OWNER"}] [{$storeData->aDynValue.kkname}]
                </label>
            </div>
        [{/foreach}]

        <div class="radio list-group-item">
            <label style="width:100%">
                <input type="radio" name="usehpstore" value="0">
                [{oxmultilang ident="D3PAYMENT_EXT_STOREDUID_NEW_CARD"}]
            </label>
        </div>
    </div>
    <div class="alert alert-info">
        [{oxmultilang ident="D3PAYMENT_EXT_STOREDUID_CC_SECURITYINFO"}]
    </div>

    <div class="card bg-light cart-buttons">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6">
                    <a href="[{oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=order"}]" class="btn btn-outline-dark float-left prevStep submitButton largeButton" id="userBackStepBottom"><i class="fa fa-caret-left"></i> [{oxmultilang ident="D3HEIDELPAY_ORDER_PAGE_BACKSTEPT"}]</a>
                </div>
                <div class="col-12 col-md-6 text-right">
                    <button id="paymentNextStepBottom" class="btn btn-primary pull-right submitButton largeButton nextStep" name="userform" type="submit">[{oxmultilang ident="D3HEIDELPAY_ORDER_PAGE_NEXTSTEP"}] <i class="fa fa-caret-right"></i></button>
                </div>
            </div>
        </div>
    </div>


</form>
