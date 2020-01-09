[{assign var="sImageUrl" value=$oViewConf->getModuleUrl('d3heidelpay','out/img/')}]
[{assign var="dynvalue" value=$oView->getDynValue()}]
[{assign var='oHeidelPaySettings' value=$oHeidelpayViewConfig->getSettings()}]
[{assign var='oHeidelPayment' value=$oHeidelPaySettings->getPayment($paymentmethod)}]
[{assign var="aBrands" value=$oHeidelpayViewConfig->getHeidelpayNgwBrands($paymentmethod, $oHeidelPayment, $oxcmp_user)}]
[{assign var="sBrandIdentIdeal" value='iDeal'}]
[{assign var="sFullImageUrl" value=$sImageUrl|cat:'logo_ideal.jpg'}]

[{block name="heidelpay_ideal"}]
    <div class="well well-sm">
        <dl>
            <dt>
                <input type="radio"
                        [{if $blD3HeidelpayAllowIdeal}]
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
                    [{include file="d3_heidelpay_views_tpl_payment_img.tpl" sImageUrl=$sFullImageUrl sBrandIdent=$sBrandIdentIdeal}]
                </label>
                [{if false == $blD3HeidelpayAllowIdeal}]
                    <dfn id="d3HeidelayPrzelewy24Notice"
                         class="alert alert-danger">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_IDEAL_NOTICE"}]</dfn>
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
                [{if $blD3HeidelpayAllowIdeal}]
                    [{if is_array($aBrands) && 1 < count($aBrands)}]
                    <div class="form-group">
                        <label class="req col-lg-3"
                               for="payment_[{$sPaymentID}]_1">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_INPUT_BANK"}]</label>
                        <input type="hidden" name="dynvalue[lsland]" value="NL">
                        <div class="col-lg-9">
                            <select class="form-control js-oxValidate js-oxValidate_notEmpty"
                                    id="payment_[{$sPaymentID}]_1"
                                    name="dynvalue[lsbankname]">
                                <option>[{oxmultilang ident="D3PAYMENT_EXT_SELECTPLEASE"}]</option>
                                [{foreach from=$aBrands item='sBrandName' key='sBrandIdent'}]
                                    <option value="[{$sBrandIdent}]"
                                            [{if ($dynvalue.lsbankname == $sBrandIdent)}]selected[{/if}]>[{$sBrandName}]</option>
                                [{/foreach}]
                            </select>
                        </div>
                    </div>
                    [{elseif is_array($aBrands)}]
                        [{assign var='current' value=$aBrands|@current}]
                        <input type="hidden" name="dynvalue[lsbankname]" value="[{$current}]"/>
                    [{else}]
                        <input type="hidden" name="dynvalue[lsbankname]" value="IDEAL_BRAND"/>
                    [{/if}]
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

