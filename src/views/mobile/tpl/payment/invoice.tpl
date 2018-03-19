[{assign var='oHeidelPaySettings' value=$oHeidelpayViewConfig->getSettings()}]
[{assign var='oHeidelPayment' value=$oHeidelPaySettings->getPayment($paymentmethod)}]
[{assign var='blShowPaymentMethod' value=true}]
[{if get_class($oHeidelPayment) === "D3\Heidelpay\Models\Payment\Invoice\Secured"}]
    [{assign var='blShowPaymentMethod' value=$blD3HeidelpayHasSameAdresses}]
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
    <div id="paymentOption_[{$sPaymentID}]"
         class="payment-option [{if $oView->getCheckedPaymentId() == $paymentmethod->oxpayments__oxid->value}]active-payment[{/if}]">
        <input id="payment_[{$sPaymentID}]" type="radio" name="paymentid" value="[{$sPaymentID}]"
               [{if $oView->getCheckedPaymentId() == $paymentmethod->oxpayments__oxid->value}]checked="checked"[{/if}] />
        <ul class="form">
            [{if $paymentmethod->getPrice()}]
                <li>
                    <div class="payment-charge">
                        [{if $oxcmp_basket->getPayCostNet()}]
                            ([{$paymentmethod->getFNettoPrice()}] [{$currency->sign}] [{oxmultilang ident="PLUS_VAT"}] [{$paymentmethod->getFPriceVat()}] )
                        [{else}]
                            ([{$paymentmethod->getFBruttoPrice()}] [{$currency->sign}])
                        [{/if}]
                    </div>
                </li>
            [{/if}]
            [{if false == $blShowPaymentMethod}]
                <li>
                    <sup class="alert alert-danger">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_NOTSAMEADDRESS_NOTICE"}]</sup>
                </li>

                [{capture name="doNotUse"}]
                    <script type="text/javascript">
                        [{capture name="nextStepButton"}]
                        [{if $oView->getCheckedPaymentId() == $paymentmethod->oxpayments__oxid->value}]
                            $('#paymentNextStepBottom').attr('disabled', true);
                        [{/if}]
                        heidelpayDisablePayment.push("[{$sPaymentID}]");
                        [{/capture}]
                    </script>
                [{/capture}]
                [{oxscript add=$smarty.capture.nextStepButton}]
            [{/if}]
            [{oxscript include="js/libs/modernizr.custom.min.js" priority=10}]
            [{oxscript include="js/widgets/oxdatepicker.js" priority=10}]

            [{capture name="doNotShow"}]
            <script type="text/javascript">
                [{capture name="javaScript"}]
                $('#datePicker_[{$sPaymentID}]').oxDatePicker({
                    sDayId: 'day_[{$sPaymentID}]',
                    sMonthId: 'month_[{$sPaymentID}]',
                    sYearId: 'year_[{$sPaymentID}]',
                    sMonthsId: 'months_[{$sPaymentID}]',
                    sModernFieldId: 'modernDate_[{$sPaymentID}]'
                });
                [{/capture}]
            </script>
            [{/capture}]
            [{oxscript add=$smarty.capture.javaScript}]
            <li class="oxDate">
                <label>[{oxmultilang ident="BIRTHDATE"}][{if $oView->getPaymentError() == 1}] *[{/if}]</label>
                <div id="datePicker_[{$sPaymentID}]">
                    <ul class="nav nav-pills nav-justified datepicker-container">
                        <li id="day_[{$sPaymentID}]">
                            <button class="btn" type="button">+</button>
                            <input data-fieldsize="xsmall" id="oxDay_[{$sPaymentID}]" maxlength="2" name="d3birthdate[[{$sPaymentID}]][day]" placeholder="[{oxmultilang ident="DAY"}]" type="number" value="[{if $iBirthdayDay > 0 }][{$iBirthdayDay }][{/if}]"  class="js-oxValidate js-oxValidate_notEmpty"/>
                            <button class="btn" type="button">-</button>
                        </li>
                        <li id="month_[{$sPaymentID}]">
                            <button class="btn" type="button">+</button>
                            <input data-fieldsize="xsmall" id="oxMonth_[{$sPaymentID}]" maxlength="2" name="d3birthdate[[{$sPaymentID}]][month]" placeholder="[{oxmultilang ident="MONTH"}]" type="number" value="[{if $iBirthdayMonth > 0 }][{$iBirthdayMonth }][{/if}]"  class="js-oxValidate js-oxValidate_notEmpty"/>
                            <button class="btn" type="button">-</button>
                        </li>
                        <li id="year_[{$sPaymentID}]">
                            <button class="btn" type="button">+</button>
                            <input data-fieldsize="small" id="oxYear_[{$sPaymentID}]" maxlength="4"  name="d3birthdate[[{$sPaymentID}]][year]" placeholder="[{oxmultilang ident="YEAR"}]" type="number" value="[{if $iBirthdayYear }][{$iBirthdayYear }][{/if}]"  class="js-oxValidate js-oxValidate_notEmpty"/>
                            <button class="btn" type="button">-</button>
                        </li>
                        <li class="months">
                            <select id="months_[{$sPaymentID}]">
                                [{section name="month" start=1 loop=13 }]
                                    <option value="[{$smarty.section.month.index}]" [{if $iBirthdayMonth == $smarty.section.month.index}] selected="selected" [{/if}]>[{oxmultilang ident="MONTH_NAME_"|cat:$smarty.section.month.index}]</option>
                                [{/section}]
                            </select>
                        </li>
                    </ul>
                </div>
                <input id="modernDate_[{$sPaymentID}]" type="date" value="[{if $iBirthdayDay > 0 }][{$iBirthdayYear }]-[{if $iBirthdayMonth < 10 }]0[{/if}][{$iBirthdayMonth }]-[{$iBirthdayDay }][{/if}]"/>
            </li>

            <li class="alert alert-block">[{oxmultilang ident="COMPLETE_MARKED_FIELDS"}]</li>
            [{block name="checkout_payment_longdesc"}]
                [{if $paymentmethod->oxpayments__oxlongdesc->value}]
                    <li>
                        <div class="payment-desc">
                            [{$paymentmethod->oxpayments__oxlongdesc->getRawValue()}]
                        </div>
                    </li>
                [{/if}]
            [{/block}]
        </ul>
    </div>
[{/block}]
