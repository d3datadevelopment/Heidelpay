[{assign var='oHeidelPaySettings' value=$oHeidelpayViewConfig->getSettings()}]
[{assign var='oHeidelPayment' value=$oHeidelPaySettings->getPayment($paymentmethod)}]
[{assign var='blShowPaymentMethod' value=true}]
[{if get_class($oHeidelPayment) === "D3\Heidelpay\Models\Payment\Invoice\Secured"}]
    [{assign var='blShowPaymentMethod' value=$blD3HeidelpayAllowInvoiceSecured}]
[{/if}]

[{block name="heidelpay_invoice"}]
    [{assign var="iBirthdayMonth" value=0}]
    [{assign var="iBirthdayDay" value=0}]
    [{assign var="iBirthdayYear" value=0}]

    [{if $oxcmp_user->oxuser__oxbirthdate->value && $oxcmp_user->oxuser__oxbirthdate->value != "0000-00-00"}]
        [{assign var="iBirthdayMonth" value=$oxcmp_user->oxuser__oxbirthdate->value|regex_replace:"/^([0-9]{4})[-]/":""|regex_replace:'/[-]([0-9]{1,2})$/':""}]
        [{assign var="iBirthdayDay" value=$oxcmp_user->oxuser__oxbirthdate->value|regex_replace:"/^([0-9]{4})[-]([0-9]{1,2})[-]/":""}]
        [{assign var="iBirthdayYear" value=$oxcmp_user->oxuser__oxbirthdate->value|regex_replace:'/[-]([0-9]{1,2})[-]([0-9]{1,2})$/':""}]
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
            <label for="payment_[{$sPaymentID}]"><b>[{ $paymentmethod->oxpayments__oxdesc->value}]
                    [{if $paymentmethod->getPrice()}]
                        [{assign var="oPaymentPrice" value=$paymentmethod->getPrice() }]
                        [{if $oViewConf->isFunctionalityEnabled('blShowVATForPayCharge') }]
                            ( [{oxprice price=$oPaymentPrice->getNettoPrice() currency=$currency}]
                            [{if $oPaymentPrice->getVatValue() > 0}]
                                [{ oxmultilang ident="PLUS_VAT" }] [{oxprice price=$oPaymentPrice->getVatValue() currency=$currency }]
                            [{/if}])
                        [{else}]
                            ([{oxprice price=$oPaymentPrice->getBruttoPrice() currency=$currency}])
                        [{/if}]
                    [{/if}]
                </b></label>
            [{if false == $blShowPaymentMethod}]
                <sup id="d3HeidelayInvoiceSecuredNotice"
                     class="alert alert-danger desc">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_INVOICESECURED_NOTICE" args=$iD3HeidelpayInvoiceSecuredLimits}]</sup>
            [{/if}]
            [{if false == $blD3HeidelpayHasSameAdresses}]
                <sup class="alert alert-danger d3HeidelaySameAddressNotice">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_NOTSAMEADDRESS_NOTICE"}]</sup>
            [{/if}]
        </dt>
        <dd class="[{if $oView->getCheckedPaymentId() == $paymentmethod->oxpayments__oxid->value}]activePayment[{/if}]">
            [{if $blShowPaymentMethod}]
                <div class="oxDate">
                    <label class="req">[{ oxmultilang ident="BIRTHDATE" suffix="COLON" }]</label>
                    <label class="innerLabel" for="oxDay_[{$sPaymentID}]">[{ oxmultilang ident="DAY" }]</label>
                    <input id="oxDay_[{$sPaymentID}]" class='oxDay js-oxValidate'
                           name='d3birthdate[[{$sPaymentID}]][day]' type="text" data-fieldsize="xsmall" maxlength="2"
                           value="[{if $iBirthdayDay > 0 }][{$iBirthdayDay }][{/if}]"/>
                    [{oxscript include="js/widgets/oxinnerlabel.js" priority=10 }]
                    [{oxscript add='$(\'#oxDay_'|cat:$sPaymentID|cat:'\').oxInnerLabel();'}]
                    <select class='oxMonth js-oxValidate js-oxValidate_date js-oxValidate_notEmpty'
                            name='d3birthdate[[{$sPaymentID}]][month]'>
                        [{section name="month" start=1 loop=13 }]
                            <option value="[{$smarty.section.month.index}]" [{if $iBirthdayMonth == $smarty.section.month.index}] selected="selected" [{/if}]>
                                [{oxmultilang ident="MONTH_NAME_"|cat:$smarty.section.month.index}]
                            </option>
                        [{/section}]
                    </select>
                    <label class="innerLabel" for="oxYear_[{$sPaymentID}]">[{ oxmultilang ident="YEAR" }]</label>
                    <input id="oxYear_[{$sPaymentID}]" class='oxYear js-oxValidate'
                           name='d3birthdate[[{$sPaymentID}]][year]' type="text" data-fieldsize="small" maxlength="4"
                           value="[{if $iBirthdayYear }][{$iBirthdayYear }][{/if}]"/>
                    [{oxscript include="js/widgets/oxinnerlabel.js" priority=10 }]
                    [{oxscript add='$(\'#oxYear_'|cat:$sPaymentID|cat:'\').oxInnerLabel();'}]
                    <p class="oxValidateError">
                        <span class="js-oxError_notEmpty">[{ oxmultilang ident="ERROR_MESSAGE_INPUT_NOTALLFIELDS" }]</span>
                        <span class="js-oxError_incorrectDate">[{ oxmultilang ident="ERROR_MESSAGE_INCORRECT_DATE" }]</span>
                    </p>
                </div>
            [{/if}]

            [{block name="checkout_payment_longdesc"}]
                [{if $paymentmethod->oxpayments__oxlongdesc->value|trim}]
                    <div class="desc">
                        [{ $paymentmethod->oxpayments__oxlongdesc->getRawValue()}]
                    </div>
                [{/if}]
            [{/block}]
        </dd>
    </dl>
[{/block}]
