[{assign var='oHeidelPaySettings' value=$oHeidelpayViewConfig->getSettings()}]
[{assign var='oHeidelPayment' value=$oHeidelPaySettings->getPayment($paymentmethod)}]
[{assign var='blShowPaymentMethod' value=true}]
[{if get_class($oHeidelPayment)  === "D3\Heidelpay\Models\Payment\Invoice\Secured"}]
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
    <div class="well well-sm">
        <dl>
            <dt>
                <input type="radio"
                        [{if $blShowPaymentMethod}]
                            id="payment_[{$sPaymentID}]"
                            name="paymentid"
                            value="[{$sPaymentID}]"
                            [{if $oView->getCheckedPaymentId() == $paymentmethod->oxpayments__oxid->value}]checked[{/if}]
                        [{else}]
                            disabled
                        [{/if}]
                >
                <label for="payment_[{$sPaymentID}]">
                    <b>[{$paymentmethod->oxpayments__oxdesc->value}]</b>
                </label>
                [{if false == $blShowPaymentMethod}]
                    <dfn id="d3HeidelayInvoiceSecuredNotice"
                         class="alert alert-danger desc">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_INVOICESECURED_NOTICE" args=$iD3HeidelpayInvoiceSecuredLimits}]</dfn>
                [{/if}]
                [{if false == $blD3HeidelpayHasSameAdresses}]
                    <dfn class="alert alert-danger d3HeidelaySameAddressNotice">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_NOTSAMEADDRESS_NOTICE"}]</dfn>
                [{/if}]
            </dt>
            <dd class="payment-option [{if $oView->getCheckedPaymentId() == $paymentmethod->oxpayments__oxid->value}]activePayment[{/if}]">
                [{if $paymentmethod->getPrice()}]
                    [{assign var="oPaymentPrice" value=$paymentmethod->getPrice()}]
                    [{if $oViewConf->isFunctionalityEnabled('blShowVATForPayCharge')}]
                        ([{oxprice price=$oPaymentPrice->getNettoPrice() currency=$currency}]
                        [{if $oPaymentPrice->getVatValue() > 0}]
                            [{oxmultilang ident="PLUS_VAT"}] [{oxprice price=$oPaymentPrice->getVatValue() currency=$currency}]
                        [{/if}])
                    [{else}]
                        ([{oxprice price=$oPaymentPrice->getBruttoPrice() currency=$currency}])
                    [{/if}]
                [{/if}]
                [{if $blShowPaymentMethod}]
                    <div class="form-group oxDate">
                        <label class="col-xs-12 col-lg-3 req">
                            [{oxmultilang ident="BIRTHDATE"}]
                            [{if $oView->getPaymentError() == 1}]*[{/if}]
                        </label>
                        <div class="col-sm-3 col-lg-3">
                            <input class="oxDay form-control" name="d3birthdate[[{$sPaymentID}]][day]" type="text"
                                   maxlength="2" value="[{if $iBirthdayDay > 0}][{$iBirthdayDay}][{/if}]"
                                   placeholder="[{oxmultilang ident="DAY"}]" required="">
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <select class="oxMonth form-control" name="d3birthdate[[{$sPaymentID}]][month]"
                                    required="">
                                <option value="" label="-">-</option>
                                [{section name="month" start=1 loop=13}]
                                    <option value="[{$smarty.section.month.index}]"
                                            label="[{$smarty.section.month.index}]"
                                            [{if $iBirthdayMonth == $smarty.section.month.index}] selected="selected" [{/if}]>
                                        [{oxmultilang ident="MONTH_NAME_"|cat:$smarty.section.month.index}]
                                    </option>
                                [{/section}]
                            </select>
                        </div>
                        <div class="col-sm-3 col-lg-3">
                            <input class="oxYear form-control" name="d3birthdate[[{$sPaymentID}]][year]" type="text"
                                   maxlength="4" value="[{if $iBirthdayYear}][{$iBirthdayYear}][{/if}]"
                                   placeholder="[{oxmultilang ident="YEAR"}]" required="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-9 offset-lg-3">
                            <div class="alert alert-info">[{oxmultilang ident="COMPLETE_MARKED_FIELDS"}]</div>
                        </div>
                    </div>
                [{/if}]
                [{block name="checkout_payment_longdesc"}]
                    [{if $paymentmethod->oxpayments__oxlongdesc->value}]
                        <div class="row">
                            <div class="col-xs-12 col-lg-9 offset-lg-3">
                                <div class="alert alert-info desc">
                                    [{$paymentmethod->oxpayments__oxlongdesc->getRawValue()}]
                                </div>
                            </div>
                        </div>
                    [{/if}]
                [{/block}]
            </dd>
        </dl>
    </div>
[{/block}]
