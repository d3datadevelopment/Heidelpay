[{assign var="sImageUrl" value=$oViewConf->getModuleUrl('d3heidelpay','out/img/')}]
[{assign var='oHeidelPaySettings' value=$oHeidelpayViewConfig->getSettings()}]
[{assign var='oHeidelPayment' value=$oHeidelPaySettings->getPayment($paymentmethod)}]
[{assign_adv var="returnParameter" value="array('configoptintext', 'accountbrand', 'transactionid', 'd3transactionlogid')"}]
[{assign var="responseParameter" value=$oHeidelpayViewConfig->getAction($oHeidelPayment, 'IN', $returnParameter)}]
[{assign var="sBrandIdent" value=$responseParameter.accountbrand}]
[{assign var="sFullImageUrl" value=$sImageUrl|cat:'logo_ratenkauf_ec.jpg'}]

[{block name="heidelpay_easycredit"}]
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
            [{if false == $blD3HeidelpayHasSameAdresses || false == $blD3HeidelpayAllowEasyCredit}]
                [{if false == $blD3HeidelpayAllowEasyCredit}]
                    [{assign_adv var="d3EasycreditLimits" value='array("'|cat:$oHeidelPayment->getMinimumLimit()|cat:'", "'|cat:$oHeidelPayment->getMaximumLimit()|cat:'")'}]
                    <sup id="d3HeidelayEasycreditNotice"
                     class="alert alert-danger desc">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_EASYCREDIT_NOTICE" args=$d3EasycreditLimits}]</sup>
                [{/if}]
                [{if false == $blD3HeidelpayHasSameAdresses}]
                    <sup class="alert alert-danger d3HeidelaySameAddressNotice">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_NOTSAMEADDRESS_NOTICE"}]</sup>
                [{/if}]
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
            [{if $blD3HeidelpayHasSameAdresses && $blD3HeidelpayAllowEasyCredit}]
                <li>
                    [{if $blD3HeidelpayEasycreditNotChecked}]
                        <div class="alert alert-danger desc">
                            [{oxmultilang ident="D3HEIDELPAY_PAYMENT_EASYCREDIT_CHECKBOX_NOT_CHECKED"}]
                        </div>
                    [{/if}]
                    <div class="alert alert-info desc">
                        <input type="hidden" name="d3heidelpayEasycreditTransactionLogid[[{$sPaymentID}]]" value="0"/>
                        <input type="checkbox" name="d3heidelpayEasycreditTransactionLogid[[{$sPaymentID}]]"
                               value="[{$responseParameter.d3transactionlogid}]"/>
                        [{$responseParameter.configoptintext}]
                    </div>
                </li>
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
