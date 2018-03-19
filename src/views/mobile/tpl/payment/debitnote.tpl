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
    $('#sCountrySelected_[{$sPaymentID}]').on('change', function () {
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
    [{if get_class($oHeidelPayment) === "D3\Heidelpay\Models\Payment\Directdebit\Secured"}]
        [{assign var="iBirthdayMonth" value=0}]
        [{assign var="iBirthdayDay" value=0}]
        [{assign var="iBirthdayYear" value=0}]

        [{if $oxcmp_user->oxuser__oxbirthdate->value && $oxcmp_user->oxuser__oxbirthdate->value != "0000-00-00"}]
            [{assign var="iBirthdayMonth" value=$oxcmp_user->oxuser__oxbirthdate->value|regex_replace:"/^([0-9]{4})[-]/":""|regex_replace:'/[-]([0-9]{1,2})$/':""}]
            [{assign var="iBirthdayDay" value=$oxcmp_user->oxuser__oxbirthdate->value|regex_replace:"/^([0-9]{4})[-]([0-9]{1,2})[-]/":""}]
            [{assign var="iBirthdayYear" value=$oxcmp_user->oxuser__oxbirthdate->value|regex_replace:'/[-]([0-9]{1,2})[-]([0-9]{1,2})$/':""}]
        [{/if}]
    [{/if}]

    <div id="paymentOption_[{$sPaymentID}]" class="payment-option [{if $oView->getCheckedPaymentId() == $paymentmethod->oxpayments__oxid->value}]active-payment[{/if}]">
        <input id="payment_[{$sPaymentID}]" type="radio" name="paymentid" value="[{$sPaymentID}]" [{if $oView->getCheckedPaymentId() == $paymentmethod->oxpayments__oxid->value}]checked="checked"[{/if}] title="[{$paymentmethod->oxpayments__oxdesc->value}]" />
        <ul class="form">
            <li>
                [{include file="d3_heidelpay_views_tpl_payment_img.tpl" sImageUrl=$sFullImageUrl sBrandIdent=$sBrandIdentELV}]
            </li>
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

            [{if get_class($oHeidelPayment) === "D3\Heidelpay\Models\Payment\Directdebit\Secured"}]
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
            [{/if}]
            <li [{if $iPayError == -4}]class="invalid-field"[{/if}] id="sBIC_[{$sPaymentID}]">
                <label for="BIC_[{$sPaymentID}]">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_INPUT_BANK_BIC"}]</label>
                <input id="BIC_[{$sPaymentID}]" type="text" class="js-oxValidate js-oxValidate_notEmpty" size="20" maxlength="64" name="dynvalue[lsblz]" autocomplete="off" value="[{$dynvalue.lsblz}]" placeholder="[{oxmultilang ident="D3HEIDELPAY_PAYMENT_INPUT_BANK_BIC"}]" />
                <p class="validation-error">
                    <span class="js-oxError_notEmpty">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_PAGE_EXCEPTION_INPUT_NOTALLFIELDS"}]</span>
                </p>
            </li>
            <li [{if $iPayError == -5}]class="invalid-field"[{/if}]>
                <label for="sIBAN_[{$sPaymentID}]">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_INPUT_BANK_IBAN"}]</label>
                <input id="sIBAN_[{$sPaymentID}]" type="text" class="js-oxValidate js-oxValidate_notEmpty" size="20" maxlength="64" name="dynvalue[lsktonr]" autocomplete="off" value="[{$dynvalue.lsktonr}]" placeholder="[{oxmultilang ident="D3HEIDELPAY_PAYMENT_INPUT_BANK_IBAN"}]" />
                <p class="validation-error">
                    <span class="js-oxError_notEmpty">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_PAGE_EXCEPTION_INPUT_NOTALLFIELDS"}]</span>
                </p>
            </li>
            <li>
                <label for="sHOLDER_[{$sPaymentID}]">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_INPUT_BANK_ACCOUNTHOLDER"}]</label>
                <input id="sHOLDER_[{$sPaymentID}]" type="text" class="js-oxValidate js-oxValidate_notEmpty" size="20" maxlength="64" name="dynvalue[lsktoinhaber]" autocomplete="off" value="[{if $dynvalue.lsktoinhaber}][{$dynvalue.lsktoinhaber}][{else}][{$oxcmp_user->oxuser__oxfname->value}] [{$oxcmp_user->oxuser__oxlname->value}][{/if}]" placeholder="[{oxmultilang ident="D3HEIDELPAY_PAYMENT_INPUT_BANK_ACCOUNTHOLDER"}]" />
                <p class="validation-error">
                    <span class="js-oxError_notEmpty">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_PAGE_EXCEPTION_INPUT_NOTALLFIELDS"}]</span>
                </p>
            </li>
            <li>
                <div class="dropdown">
                    <input type="hidden" id="sCountrySelected_[{$sPaymentID}]" name="dynvalue[lsland]" value="[{$dynvalue.lsland}]" />
                    [{* only to track selection within DOM *}]
                    <div class="dropdown-toggle" data-toggle="dropdown" data-target="#">
                        <a id="dLabelCountrySelected" role="button" href="#">
                            <span id="creditCountrySelected">[{oxmultilang ident="D3PAYMENT_EXT_SELECTPLEASE"}]</span>
                            <i class="glyphicon-chevron-down"></i>
                        </a>
                    </div>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabelCountrySelected">
                        [{foreach from=$aBrands item='sBrandName' key='sBrandIdent'}]
                            <li class="dropdown-option">
                                <a tabindex="-1" data-selection-id="[{$sBrandIdent}]">[{$sBrandName}]</a>
                            </li>
                        [{/foreach}]
                    </ul>
                    [{if !empty($dynvalue.lsland)}]
                        [{oxscript add='$(\'#sCountrySelected_'|cat:$sPaymentID|cat:"').val('"|cat:$dynvalue.lsland|cat:"').trigger('change');"}]
                    [{/if}]
                </div>
            </li>

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

[{oxscript add='$(\'#paymentOption_'|cat:$sPaymentID|cat:"').find('.dropdown').oxDropDown();"}]
