[{assign var='oHeidelPaySettings' value=$oHeidelpayViewConfig->getSettings()}]
[{assign var='oHeidelPayment' value=$oHeidelPaySettings->getPayment($paymentmethod)}]
[{assign var="aBrands" value=$oHeidelpayViewConfig->getHeidelpayNgwBrands($paymentmethod, $oHeidelPayment, $oxcmp_user)}]
[{assign var="sImageUrl" value=$oViewConf->getModuleUrl('d3heidelpay','out/img/')}]

[{block name="heidelpay_cards"}]
    <div class="well well-sm">
        <dl>
            <dt>
                <input id="payment_[{$sPaymentID}]"
                       type="radio"
                       name="paymentid"
                       value="[{$sPaymentID}]"
                       [{if $oView->getCheckedPaymentId() == $paymentmethod->oxpayments__oxid->value}]checked[{/if}]>
                <label for="payment_[{$sPaymentID}]">
                    <b>[{$paymentmethod->oxpayments__oxdesc->value}]</b>
                    [{foreach from=$aBrands item='sBrandName' key='sBrandIdent'}]
                        [{assign var='sBrandIdent' value=$sBrandIdent|lower}]
                        [{assign var="sFullImageUrl" value=$sImageUrl|cat:'logo_'|cat:$sBrandIdent|cat:'.jpg'}]
                        [{include file="d3_heidelpay_views_tpl_payment_img.tpl" sImageUrl=$sFullImageUrl sBrandIdent=$sBrandIdent}]
                    [{/foreach}]
                </label>
            </dt>

            <dd class="payment-option [{if $oView->getCheckedPaymentId() == $paymentmethod->oxpayments__oxid->value}]activePayment[{/if}]">
                [{assign var="oPaymentPrice" value=$paymentmethod->getPrice()}]
                [{if $oPaymentPrice->getPrice()}]
                    [{if $oViewConf->isFunctionalityEnabled('blShowVATForPayCharge')}]
                        ([{oxprice price=$oPaymentPrice->getNettoPrice() currency=$currency}]
                        [{if $oPaymentPrice->getVatValue() > 0}]
                            [{oxmultilang ident="PLUS_VAT"}] [{oxprice price=$oPaymentPrice->getVatValue() currency=$currency}]
                        [{/if}])
                    [{else}]
                        ([{oxprice price=$oPaymentPrice->getBruttoPrice() currency=$currency}])
                    [{/if}]
                [{/if}]
                <div class="row">
                    <div class="col-xs-12 col-lg-9 offset-lg-3">
                        <div class="alert alert-danger">[{oxmultilang ident="D3PAYMENT_EXT_AFTERSTEP4_INFO_STEP4"}]</div>
                    </div>
                </div>

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
