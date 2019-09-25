[{assign var='oHeidelPaySettings' value=$oHeidelpayViewConfig->getSettings()}]
[{assign var='oHeidelPayment' value=$oHeidelPaySettings->getPayment($paymentmethod)}]

[{if empty($d3hpPaymentFormulars.$sPaymentID)}]
    [{assign var='blD3HeidelpayAllowBtoBBillPurchase' value=false}]
[{/if}]

[{block name="heidelpay_btobbillpurchase"}]
    <dl>
        <dt>
            <input type="radio"
                    [{if $blD3HeidelpayAllowBtoBBillPurchase && $blD3HeidelpayHasSameAdresses}]
                        id="payment_[{$sPaymentID}]"
                        name="paymentid" value="[{$sPaymentID}]"
                        [{if $oView->getCheckedPaymentId() == $paymentmethod->oxpayments__oxid->value}]checked[{/if}]
                    [{else}]
                        disabled
                    [{/if}]
            >
            <label for="payment_[{$sPaymentID}]"><b>[{$paymentmethod->oxpayments__oxdesc->value}]</b></label>
            [{if false == $blD3HeidelpayAllowBtoBBillPurchase}]
                <sup id="d3HeidelayBToBBillpurchaseNotice" class="alert alert-danger desc">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_BTOBBILLPURCHASESECURED_NOTICE" args=$iD3HeidelpayBtoBBillPurchaseLimits}]</sup>
            [{/if}]
            [{if false == $blD3HeidelpayHasSameAdresses}]
                <sup class="alert alert-danger d3HeidelaySameAddressNotice">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_NOTSAMEADDRESS_NOTICE"}]</sup>
            [{/if}]
        </dt>
        <dd class="[{if $oView->getCheckedPaymentId() == $paymentmethod->oxpayments__oxid->value}]activePayment[{/if}]">
            [{if $blD3HeidelpayAllowBtoBBillPurchase}]
                <ul class="form">
                    [{foreach from=$d3hpPaymentFormulars.$sPaymentID item="d3hpPaymentFormular" key="d3hpPaymentID"}]
                        [{include file="d3_heidelpay_views_azure_tpl_forms_`$d3hpPaymentFormular->type`.tpl" d3hpPaymentFormular=$d3hpPaymentFormular d3HeidelpayB2BParameters=$d3HeidelpayParameters.$sPaymentID}]
                    [{/foreach}]
                </ul>

                    <div class="d3HeidelayBToBBillpurchaseNotice">[{oxmultilang ident="COMPLETE_MARKED_FIELDS"}]</div>

                    [{capture name="doNotShow"}]
                    <script type="text/javascript">
                        [{capture name="javaScript"}]
                        function toggleD3HpB2Bpurchase() {
                            var currentClass = $("input.d3heidelpayB2BPurchase:checked").val();
                            $('.registered, .not_registered').hide().find('select, input').attr('disabled', "disabled");
                            $('.'+currentClass).show().find('select, input').removeAttr('disabled');
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
                    <div class="desc">
                        [{$paymentmethod->oxpayments__oxlongdesc->value}]
                    </div>
                [{/if}]
            [{/block}]
        </dd>
    </dl>
[{/block}]
