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
        <label for="payment_[{$sPaymentID}]"><b>[{$paymentmethod->oxpayments__oxdesc->value}]</b></label>
        [{include file="d3_heidelpay_views_tpl_payment_img.tpl" sImageUrl=$sFullImageUrl sBrandIdent=$sBrandIdent}]
    </dt>
    <dd class="[{if $oView->getCheckedPaymentId() == $paymentmethod->oxpayments__oxid->value}]activePayment[{/if}]">
        <ul class="form">
            <li>
                <label>[{oxmultilang ident="D3HEIDELPAY_PAYMENT_INPUT_BANK_ACCOUNTHOLDER"}]</label>
                <input type="text"
                       class="js-oxValidate js-oxValidate_notEmpty"
                       size="20"
                       maxlength="64"
                       name="dynvalue[lsktoinhaber]"
                       title="[{oxmultilang ident="D3HEIDELPAY_PAYMENT_INPUT_BANK_ACCOUNTHOLDER"}]"
                       value="[{if $dynvalue.lsktoinhaber}][{$dynvalue.lsktoinhaber}][{else}][{$oxcmp_user->oxuser__oxfname->value}] [{$oxcmp_user->oxuser__oxlname->value}][{/if}]">

                <p class="oxValidateError">
                    <span class="js-oxError_notEmpty">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_PAGE_EXCEPTION_INPUT_NOTALLFIELDS"}]</span>
                </p>
            </li>
            <li>
                <label for="payment_[{$sPaymentID}]_1">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_INPUT_BANK"}]</label>
                <input type="hidden" name="dynvalue[lsland]" value="AT">
                <select id="payment_[{$sPaymentID}]_1" name="dynvalue[lsbankname]">
                    <option value="">[{oxmultilang ident="D3PAYMENT_EXT_SELECTPLEASE"}]</option>
                    [{foreach from=$aBrands item='sBrandName' key='sBrandIdent'}]
                        <option value="[{$sBrandIdent}]" [{if ($dynvalue.lsbankname == $sBrandIdent)}]selected[{/if}]>[{$sBrandName}]</option>
                    [{/foreach}]
                </select>
            </li>
        </ul>
        [{if $paymentmethod->oxpayments__oxlongdesc->value}]
            <div class="desc">
                [{$paymentmethod->oxpayments__oxlongdesc->value}]
            </div>
        [{/if}]
    </dd>
</dl>
[{/block}]
