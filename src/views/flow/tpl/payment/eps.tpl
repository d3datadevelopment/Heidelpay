[{assign var="sImageUrl" value=$oViewConf->getModuleUrl('d3heidelpay','out/img/')}]
[{assign var="dynvalue" value=$oView->getDynValue()}]
[{assign var='oHeidelPaySettings' value=$oHeidelpayViewConfig->getSettings()}]
[{assign var='oHeidelPayment' value=$oHeidelPaySettings->getPayment($paymentmethod)}]
[{assign var="aBrands" value=$oHeidelpayViewConfig->getHeidelpayNgwBrands($paymentmethod, $oHeidelPayment, $oxcmp_user)}]
[{assign var="sBrandIdentEPS" value='EPS'}]
[{assign var="sFullImageUrl" value=$sImageUrl|cat:'logo_eps.jpg'}]

[{block name="heidelpay_eps"}]
    <dl>
        <dt>
            <input id="payment_[{$sPaymentID}]"
                   type="radio"
                   name="paymentid"
                   value="[{$sPaymentID}]"
                   [{if $oView->getCheckedPaymentId() == $paymentmethod->oxpayments__oxid->value}]checked[{/if}]>
            <label for="payment_[{$sPaymentID}]">
                <b>[{$paymentmethod->oxpayments__oxdesc->value}]</b>
                [{include file="d3_heidelpay_views_tpl_payment_img.tpl" sImageUrl=$sFullImageUrl sBrandIdent=$sBrandIdent}]
            </label>
        </dt>
        <dd class="[{if $oView->getCheckedPaymentId() == $paymentmethod->oxpayments__oxid->value}]activePayment[{/if}]">
            <div class="form-group">
                <label class="req control-label col-lg-3">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_INPUT_BANK_ACCOUNTHOLDER"}]</label>
                <div class="col-lg-9">
                    <input type="text"
                           class="form-control js-oxValidate js-oxValidate_notEmpty"
                           size="20"
                           maxlength="64"
                           name="dynvalue[lsktoinhaber]"
                           title="[{oxmultilang ident="D3HEIDELPAY_PAYMENT_INPUT_BANK_ACCOUNTHOLDER"}]"
                           value="[{if $dynvalue.lsktoinhaber}][{$dynvalue.lsktoinhaber}][{else}][{$oxcmp_user->oxuser__oxfname->value}] [{$oxcmp_user->oxuser__oxlname->value}][{/if}]">
                </div>
            </div>
            <div class="form-group">
                <label class="req control-label col-lg-3"
                       for="payment_[{$sPaymentID}]_1">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_INPUT_BANK"}]</label>
                <input type="hidden" name="dynvalue[lsland]" value="AT">
                <div class="col-lg-9">
                    <select class="form-control" id="payment_[{$sPaymentID}]_1" name="dynvalue[lsbankname]">
                        <option value="">[{oxmultilang ident="D3PAYMENT_EXT_SELECTPLEASE"}]</option>
                        [{foreach from=$aBrands item='sBrandName' key='sBrandIdent'}]
                            <option value="[{$sBrandIdent}]"
                                    [{if ($dynvalue.lsbankname == $sBrandIdent)}]selected[{/if}]>[{$sBrandName}]</option>
                        [{/foreach}]
                    </select>
                </div>
            </div>
            [{if $paymentmethod->oxpayments__oxlongdesc->value}]
                <div class="alert alert-info desc">
                    [{$paymentmethod->oxpayments__oxlongdesc->value}]
                </div>
            [{/if}]
        </dd>
    </dl>
[{/block}]
