[{assign var="dynvalue" value=$oView->getDynValue()}]
[{assign var="iPayError" value=$oView->getPaymentError()}]
[{assign var="sImageUrl" value=$oViewConf->getModuleUrl('d3heidelpay','out/img/')}]
[{assign var='oHeidelPaySettings' value=$oHeidelpayViewConfig->getSettings()}]
[{assign var='oHeidelPayment' value=$oHeidelPaySettings->getPayment($paymentmethod)}]
[{assign var="aBrands" value=$oHeidelpayViewConfig->getHeidelpayNgwBrands($paymentmethod, $oHeidelPayment, $oxcmp_user)}]
[{assign var="sBrandIdentELV" value='ELV'}]
[{assign var="sFullImageUrl" value=$sImageUrl|cat:'logo_elv.jpg'}]
[{assign var='blShowPaymentMethod' value=true}]
[{if get_class($oHeidelPayment) === "D3\Heidelpay\Models\Payment\Directdebit\Secured"}]
    [{assign var='blShowPaymentMethod' value=$blD3HeidelpayHasSameAdresses}]
[{/if}]


[{capture name="doNotShow"}]
<script type="text/javascript">
    [{capture name="javaScript"}]
    $('#sCountrySelected_[{$sPaymentID}]').on('change', function (e) {
        var valueSelected = this.value;
        var hideableLi    = $('#sBIC_[{$sPaymentID}]').first();

        if (valueSelected == 'DE') {
            hideableLi.hide()
            hideableLi.find('input').attr('disabled', 'disabled');
        } else {
            hideableLi.show()
            hideableLi.find('input').removeAttr('disabled');
        }
    });
    [{/capture}]
</script>
[{/capture}]
[{oxscript add=$smarty.capture.javaScript}]

[{block name="heidelpay_debitnote"}]
    [{if get_class($oHeidelPayment) === "D3\Heidelpay\Models\Payment\Invoice\Secured"}]
        [{assign var="iBirthdayMonth" value=0}]
        [{assign var="iBirthdayDay" value=0}]
        [{assign var="iBirthdayYear" value=0}]

        [{if $oxcmp_user->oxuser__oxbirthdate->value && $oxcmp_user->oxuser__oxbirthdate->value != "0000-00-00"}]
            [{assign var="iBirthdayMonth" value=$oxcmp_user->oxuser__oxbirthdate->value|regex_replace:"/^([0-9]{4})[-]/":""|regex_replace:'/[-]([0-9]{1,2})$/':""}]
            [{assign var="iBirthdayDay" value=$oxcmp_user->oxuser__oxbirthdate->value|regex_replace:"/^([0-9]{4})[-]([0-9]{1,2})[-]/":""}]
            [{assign var="iBirthdayYear" value=$oxcmp_user->oxuser__oxbirthdate->value|regex_replace:'/[-]([0-9]{1,2})[-]([0-9]{1,2})$/':""}]
        [{/if}]
    [{/if}]

    <dl>
        <dt>
            <input type="radio"
                [{if $blShowPaymentMethod}]
                    id="payment_[{$sPaymentID}]"
                    name="paymentid" value="[{$sPaymentID}]"
                    [{if $oView->getCheckedPaymentId() == $paymentmethod->oxpayments__oxid->value}]checked[{/if}]
                [{else}]
                    disabled
                [{/if}]
                >
            <label for="payment_[{$sPaymentID}]"><b>[{$paymentmethod->oxpayments__oxdesc->value}]
                    [{if $paymentmethod->getPrice()}]
                        [{assign var="oPaymentPrice" value=$paymentmethod->getPrice()}]
                        [{if $oViewConf->isFunctionalityEnabled('blShowVATForPayCharge')}]
                            ( [{oxprice price=$oPaymentPrice->getNettoPrice() currency=$currency}]
                            [{if $oPaymentPrice->getVatValue() > 0}]
                                [{oxmultilang ident="PLUS_VAT"}] [{oxprice price=$oPaymentPrice->getVatValue() currency=$currency}]
                            [{/if}])
                        [{else}]
                            ([{oxprice price=$oPaymentPrice->getBruttoPrice() currency=$currency}])
                        [{/if}]
                    [{/if}]
                </b></label>
            [{include file="d3_heidelpay_views_tpl_payment_img.tpl" sImageUrl=$sFullImageUrl sBrandIdent=$sBrandIdentELV}]
            [{if false == $blShowPaymentMethod}]
                <sup class="d3HeidelaySameAddressNotice">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_NOTSAMEADDRESS_NOTICE"}]</sup>
            [{/if}]
        </dt>
        <dd class="[{if $oView->getCheckedPaymentId() == $paymentmethod->oxpayments__oxid->value}]activePayment[{/if}]">
            [{if get_class($oHeidelPayment) === "D3\Heidelpay\Models\Payment\Invoice\Secured"}]
                <div class="oxDate">
                    <label class="req">[{ oxmultilang ident="BIRTHDATE" suffix="COLON" }]</label>
                    <label class="innerLabel" for="oxDay_[{$sPaymentID}]">[{ oxmultilang ident="DAY" }]</label>
                    <input id="oxDay_[{$sPaymentID}]" class='oxDay js-oxValidate' name='d3birthdate[[{$sPaymentID}]][day]' type="text" data-fieldsize="xsmall" maxlength="2" value="[{if $iBirthdayDay > 0 }][{$iBirthdayDay }][{/if}]" />
                    [{oxscript include="js/widgets/oxinnerlabel.js" priority=10 }]
                    [{oxscript add='$(\'#oxDay_'|cat:$sPaymentID|cat:'\').oxInnerLabel();'}]
                    <select class='oxMonth js-oxValidate js-oxValidate_date js-oxValidate_notEmpty' name='d3birthdate[[{$sPaymentID}]][month]'>
                        [{section name="month" start=1 loop=13 }]
                            <option value="[{$smarty.section.month.index}]" [{if $iBirthdayMonth == $smarty.section.month.index}] selected="selected" [{/if}]>
                                [{oxmultilang ident="MONTH_NAME_"|cat:$smarty.section.month.index}]
                            </option>
                        [{/section}]
                    </select>
                    <label class="innerLabel" for="oxYear_[{$sPaymentID}]">[{ oxmultilang ident="YEAR" }]</label>
                    <input id="oxYear_[{$sPaymentID}]" class='oxYear js-oxValidate' name='d3birthdate[[{$sPaymentID}]][year]' type="text" data-fieldsize="small" maxlength="4" value="[{if $iBirthdayYear }][{$iBirthdayYear }][{/if}]" />
                    [{oxscript include="js/widgets/oxinnerlabel.js" priority=10 }]
                    [{oxscript add='$(\'#oxYear_'|cat:$sPaymentID|cat:'\').oxInnerLabel();'}]
                    <p class="oxValidateError">
                        <span class="js-oxError_notEmpty">[{ oxmultilang ident="ERROR_MESSAGE_INPUT_NOTALLFIELDS" }]</span>
                        <span class="js-oxError_incorrectDate">[{ oxmultilang ident="ERROR_MESSAGE_INCORRECT_DATE" }]</span>
                    </p>
                </div>
            [{/if}]

            <ul class="form">
                <li>
                    <label for="sCountrySelected_[{$sPaymentID}]">[{oxmultilang ident="D3HEIDELPAY_CC_INPUT_COUNTRY"}]</label>
                    <select id="sCountrySelected_[{$sPaymentID}]" name="dynvalue[lsland]">
                        <option value="">[{oxmultilang ident="D3PAYMENT_EXT_SELECTPLEASE"}]</option>
                        [{foreach from=$aBrands item='sBrandName' key='sBrandIdent'}]
                            <option value="[{$sBrandIdent}]">[{$sBrandName}]</option>
                        [{/foreach}]
                    </select>
                    [{if !empty($dynvalue.lsland)}]
                        [{oxscript add='$(\'#sCountrySelected_'|cat:$sPaymentID|cat:"').val('":cat|$dynvalue.lsland|cat:"').trigger('change');"}]
                    [{/if}]
                </li>
                <li [{if $iPayError == -4}]class="oxInValid"[{/if}] id="sBIC_[{$sPaymentID}]">
                    <label for="sCountrySelected_[{$sPaymentID}]lsblz">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_INPUT_BANK_BIC"}]</label>
                    <input id="sCountrySelected_[{$sPaymentID}]lsblz" type="text" class="js-oxValidate" size="20" maxlength="64" name="dynvalue[lsblz]" autocomplete="off" value="[{$dynvalue.lsblz}]">
                    <p class="oxValidateError">
                        <span class="js-oxError_notEmpty">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_PAGE_EXCEPTION_INPUT_NOTALLFIELDS"}]</span>
                    </p>
                </li>
                <li [{if $iPayError == -5}]class="oxInValid"[{/if}]>
                    <label for="sCountrySelected_[{$sPaymentID}]lsktonr">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_INPUT_BANK_IBAN"}]</label>
                    <input id="sCountrySelected_[{$sPaymentID}]lsktonr" type="text" class="js-oxValidate js-oxValidate_notEmpty" size="20" maxlength="64" name="dynvalue[lsktonr]" autocomplete="off" value="[{$dynvalue.lsktonr}]">
                    <p class="oxValidateError">
                        <span class="js-oxError_notEmpty">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_PAGE_EXCEPTION_INPUT_NOTALLFIELDS"}]</span>
                    </p>
                </li>
                <li>
                    <label for="sCountrySelected_[{$sPaymentID}]lsktoinhaber">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_INPUT_BANK_ACCOUNTHOLDER"}]</label>
                    <input id="sCountrySelected_[{$sPaymentID}]lsktoinhaber" type="text" class="js-oxValidate js-oxValidate_notEmpty" size="20" maxlength="64" name="dynvalue[lsktoinhaber]" value="[{if $dynvalue.lsktoinhaber}][{$dynvalue.lsktoinhaber}][{else}][{$oxcmp_user->oxuser__oxfname->value}] [{$oxcmp_user->oxuser__oxlname->value}][{/if}]">
                    <p class="oxValidateError">
                        <span class="js-oxError_notEmpty">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_PAGE_EXCEPTION_INPUT_NOTALLFIELDS"}]</span>
                    </p>
                </li>
            </ul>

            [{block name="checkout_payment_longdesc"}]
                [{if $paymentmethod->oxpayments__oxlongdesc->value}]
                    <div class="desc">
                        [{$paymentmethod->oxpayments__oxlongdesc->getRawValue()}]
                    </div>
                [{/if}]
            [{/block}]
        </dd>
    </dl>
[{/block}]
