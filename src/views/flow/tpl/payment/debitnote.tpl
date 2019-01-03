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
            var hideableLi = $('#sBIC_[{$sPaymentID}]').first();

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
                    [{include file="d3_heidelpay_views_tpl_payment_img.tpl" sImageUrl=$sFullImageUrl sBrandIdent=$sBrandIdentELV}]
                </label>
                [{if false == $blShowPaymentMethod}]
                    <sup class="alert alert-danger d3HeidelaySameAddressNotice">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_NOTSAMEADDRESS_NOTICE"}]</sup>
                [{/if}]
            </dt>
            <dd class="[{if $oView->getCheckedPaymentId() == $paymentmethod->oxpayments__oxid->value}]activePayment[{/if}]">
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
                [{if get_class($oHeidelPayment) === "D3\Heidelpay\Models\Payment\Directdebit\Secured"}]
                    <div class="form-group oxDate">
                        <label class="control-label col-xs-12 col-lg-3 req">
                            [{oxmultilang ident="BIRTHDATE"}]
                            [{if $oView->getPaymentError() == 1}]*[{/if}]
                        </label>
                        <div class="col-xs-3 col-lg-3">
                            <input class="oxDay form-control" name="d3birthdate[[{$sPaymentID}]][day]" type="text"
                                   maxlength="2" value="[{if $iBirthdayDay > 0}][{$iBirthdayDay}][{/if}]"
                                   placeholder="[{oxmultilang ident="DAY"}]" required="">
                        </div>
                        <div class="col-xs-6 col-lg-3">
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
                        <div class="col-xs-3 col-lg-3">
                            <input class="oxYear form-control" name="d3birthdate[[{$sPaymentID}]][year]" type="text"
                                   maxlength="4" value="[{if $iBirthdayYear}][{$iBirthdayYear}][{/if}]"
                                   placeholder="[{oxmultilang ident="YEAR"}]" required="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-lg-9 col-lg-offset-3">
                            <div class="alert alert-info">[{oxmultilang ident="COMPLETE_MARKED_FIELDS"}]</div>
                        </div>
                    </div>
                [{/if}]

                <div class="form-group">
                    <label class="req control-label col-lg-3"
                           for="sCountrySelected_[{$sPaymentID}]">[{oxmultilang ident="D3HEIDELPAY_CC_INPUT_COUNTRY"}]</label>
                    <div class="col-lg-9">
                        <select class="form-control" id="sCountrySelected_[{$sPaymentID}]" name="dynvalue[lsland]">
                            <option value="">[{oxmultilang ident="D3PAYMENT_EXT_SELECTPLEASE"}]</option>
                            [{foreach from=$aBrands item='sBrandName' key='sBrandIdent'}]
                                <option value="[{$sBrandIdent}]">[{$sBrandName}]</option>
                            [{/foreach}]
                        </select>
                        [{if !empty($dynvalue.lsland)}]
                            [{capture name="doNotShow"}]
                                <script type="text/javascript">
                                    [{capture name="javaScript"}]
                                    $('#sCountrySelected_[{$sPaymentID}]').val('[{$dynvalue.lsland}]').trigger('change');
                                    [{/capture}]
                                </script>
                            [{/capture}]
                            [{oxscript add=$smarty.capture.javaScript}]
                        [{/if}]
                    </div>
                </div>
                <div class="form-group" id="sBIC_[{$sPaymentID}]">
                    <label class="req control-label col-lg-3"
                           for="sCountrySelected_[{$sPaymentID}]lsblz">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_INPUT_BANK_BIC"}]</label>
                    <div class="col-lg-9">
                        <input id="sCountrySelected_[{$sPaymentID}]lsblz" type="text" class="form-control js-oxValidate"
                               size="20"
                               maxlength="64" name="dynvalue[lsblz]" autocomplete="off" value="[{$dynvalue.lsblz}]">
                    </div>
                </div>
                <div class="form-group">
                    <label class="req control-label col-lg-3"
                           for="sCountrySelected_[{$sPaymentID}]lsktonr">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_INPUT_BANK_IBAN"}]</label>
                    <div class="col-lg-9">
                        <input id="sCountrySelected_[{$sPaymentID}]lsktonr" type="text"
                               class="form-control js-oxValidate js-oxValidate_notEmpty" size="20" maxlength="64"
                               name="dynvalue[lsktonr]" autocomplete="off" value="[{$dynvalue.lsktonr}]"
                               required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label class="req control-label col-lg-3"
                           for="sCountrySelected_[{$sPaymentID}]lsktoinhaber">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_INPUT_BANK_ACCOUNTHOLDER"}]</label>
                    <div class="col-lg-9">
                        <input id="sCountrySelected_[{$sPaymentID}]lsktoinhaber" type="text"
                               class="form-control js-oxValidate js-oxValidate_notEmpty" size="20" maxlength="64"
                               name="dynvalue[lsktoinhaber]"
                               required="required"
                               value="[{if $dynvalue.lsktoinhaber}][{$dynvalue.lsktoinhaber}][{else}][{$oxcmp_user->oxuser__oxfname->value}] [{$oxcmp_user->oxuser__oxlname->value}][{/if}]">
                    </div>
                </div>
                <div class="clearfix"></div>

                [{block name="checkout_payment_longdesc"}]
                    [{if $paymentmethod->oxpayments__oxlongdesc->value}]
                        <div class="row">
                            <div class="col-xs-12 col-lg-9 col-lg-offset-3">
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
