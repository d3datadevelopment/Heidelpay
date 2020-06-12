[{assign var='oHeidelPaySettings' value=$oHeidelpayViewConfig->getSettings()}]
[{assign var='oHeidelPayment' value=$oHeidelPaySettings->getPayment($paymentmethod)}]

[{if empty($d3hpPaymentFormulars.$sPaymentID)}]
    [{assign var='blD3HeidelpayAllowBtoBBillPurchase' value=false}]
[{/if}]

[{block name="heidelpay_btobbillpurchase"}]
    <div class="well well-sm">
        <dl>
            <dt>
                <input type="radio"
                    [{if $blD3HeidelpayAllowBtoBBillPurchase}]
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
                [{if false == $blD3HeidelpayAllowBtoBBillPurchase}]
                    <sup class="d3HeidelayBToBBillpurchaseNotice alert alert-danger desc">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_BTOBBILLPURCHASESECURED_NOTICE" args=$iD3HeidelpayBtoBBillPurchaseLimits}]</sup>
                [{/if}]
                [{if false == $blD3HeidelpayHasSameAdresses}]
                    <sup class="alert alert-danger d3HeidelaySameAddressNotice">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_NOTSAMEADDRESS_NOTICE"}]</sup>
                [{/if}]
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
                [{if $blD3HeidelpayAllowBtoBBillPurchase}]
                    [{foreach from=$d3hpPaymentFormulars.$sPaymentID item="d3hpPaymentFormular" key="d3hpPaymentID"}]
                        [{include file="d3_heidelpay_views_flow_tpl_forms_`$d3hpPaymentFormular->type`.tpl" d3hpPaymentFormular=$d3hpPaymentFormular d3HeidelpayB2BParameters=$d3HeidelpayParameters.$sPaymentID}]
                    [{/foreach}]

                    <div class="row">
                        <div class="col-xs-12 col-lg-9 col-lg-offset-3">
                            <div class="alert alert-info">[{oxmultilang ident="COMPLETE_MARKED_FIELDS"}]</div>
                        </div>
                    </div>

                    [{capture name="doNotShow"}]
                    <script type="text/javascript">
                        [{capture name="javaScript"}]
                        function toggleD3HpB2Bpurchase() {
                            var currentClass = $("input.d3heidelpayB2BPurchase:checked").val();
                            $('.registered, .not_registered').hide();
                            $('.'+currentClass).show();
                        }

                        toggleD3HpB2Bpurchase();
                        $('.d3heidelpayB2BPurchase').click(function(){
                            toggleD3HpB2Bpurchase();
                        });
                        [{/capture}]
                    </script>
                    [{/capture}]
                    [{oxscript add=$smarty.capture.javaScript}]
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
