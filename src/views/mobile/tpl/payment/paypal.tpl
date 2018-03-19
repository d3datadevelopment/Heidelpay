[{assign var="sImageUrl" value=$oViewConf->getModuleUrl('d3heidelpay','out/img/')}]
[{assign var='oHeidelPaySettings' value=$oHeidelpayViewConfig->getSettings()}]
[{assign var='oHeidelPayment' value=$oHeidelPaySettings->getPayment($paymentmethod)}]
[{assign var="aBrands" value=$oHeidelpayViewConfig->getHeidelpayNgwBrands($paymentmethod, $oHeidelPayment, $oxcmp_user)}]
[{assign var="sBrandIdent" value=$aBrands.PAYPAL}]
[{assign var="sFullImageUrl" value=$sImageUrl|cat:'logo_'|cat:$sBrandIdent|lower|cat:'.png'}]

[{block name="heidelpay_paypal"}]
    <div id="paymentOption_[{$sPaymentID}]" class="payment-option [{if $oView->getCheckedPaymentId() == $paymentmethod->oxpayments__oxid->value}]active-payment[{/if}]">
        <input id="payment_[{$sPaymentID}]" type="radio" name="paymentid" value="[{$sPaymentID}]" [{if $oView->getCheckedPaymentId() == $paymentmethod->oxpayments__oxid->value}]checked="checked"[{/if}] title="[{$paymentmethod->oxpayments__oxdesc->value}]" />
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
            <li>
                [{include file="d3_heidelpay_views_tpl_payment_img.tpl" sImageUrl=$sFullImageUrl sBrandIdent=$sBrandIdent}]
            </li>
            [{if false == $blD3HeidelpayHasSameAdresses}]
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
