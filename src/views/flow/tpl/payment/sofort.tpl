[{assign var="sImageUrl" value=$oViewConf->getModuleUrl('d3heidelpay','out/img/')}]
[{assign var='oHeidelPaySettings' value=$oHeidelpayViewConfig->getSettings()}]
[{assign var='oHeidelPayment' value=$oHeidelPaySettings->getPayment($paymentmethod)}]
[{assign var="aBrands" value=$oHeidelpayViewConfig->getHeidelpayNgwBrands($paymentmethod, $oHeidelPayment, $oxcmp_user)}]
[{assign var="sBrandIdent" value=$aBrands.SOFORT}]
[{assign var="sFullImageUrl" value=$sBrandIdent|lower|oxtruncate:6:''}]
[{assign var="sFullImageUrl" value=$sImageUrl|cat:'logo_'|cat:$sFullImageUrl|cat:'.png'}]

[{block name="heidelpay_sofortueberweisung"}]
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
                    [{include file="d3_heidelpay_views_tpl_payment_img.tpl" sImageUrl=$sFullImageUrl sBrandIdent=$sBrandIdent}]
                </label>
            </dt>
            <dd class="[{if $oView->getCheckedPaymentId() == $paymentmethod->oxpayments__oxid->value}]activePayment[{/if}]">
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
