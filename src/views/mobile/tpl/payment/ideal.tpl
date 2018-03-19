[{assign var="sImageUrl" value=$oViewConf->getModuleUrl('d3heidelpay','out/img/')}]
[{assign var="dynvalue" value=$oView->getDynValue()}]
[{assign var='oHeidelPaySettings' value=$oHeidelpayViewConfig->getSettings()}]
[{assign var='oHeidelPayment' value=$oHeidelPaySettings->getPayment($paymentmethod)}]
[{assign var="aBrands" value=$oHeidelpayViewConfig->getHeidelpayNgwBrands($paymentmethod, $oHeidelPayment, $oxcmp_user)}]
[{assign var="sBrandIdentIdeal" value='iDeal'}]
[{assign var="sFullImageUrl" value=$sImageUrl|cat:'logo_ideal.jpg'}]

[{block name="heidelpay_ideal"}]
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
                [{include file="d3_heidelpay_views_tpl_payment_img.tpl" sImageUrl=$sFullImageUrl sBrandIdent=$sBrandIdentIdeal}]
            </li>
            [{if false == $blD3HeidelpayAllowIdeal}]
                <li>
                    <sup class="alert alert-danger">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_IDEAL_NOTICE"}]</sup>
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
            <li>
                <div class="dropdown">
                    <input type="hidden" name="dynvalue[lsbank]" value="[{$dynvalue.lsland}]" id="sIDealSelected__[{$sPaymentID}]">

                    <div class="dropdown-toggle" data-toggle="dropdown" data-target="#">
                        <a id="dLabelBankNameSelected" role="button" href="#">
                            <span id="bankNameSelected">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_INPUT_BANK"}]</span>
                            <i class="glyphicon-chevron-down"></i>
                        </a>
                    </div>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabelBankNameSelected">
                        [{foreach from=$aBrands item='sBrandName' key='sBrandIdent'}]
                            <li class="dropdown-option">
                                <a tabindex="-1" data-selection-id="[{$sBrandIdent}]">[{$sBrandName}]</a>
                            </li>
                        [{/foreach}]
                    </ul>
                    [{if !empty($dynvalue.lsbankname)}]
                    [{oxscript add='$(\'#sIDealSelected_'|cat:$sPaymentID|cat:"').val('"|cat:$dynvalue.lsbankname|cat:"');"}]
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
