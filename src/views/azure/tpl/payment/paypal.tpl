[{assign var="sImageUrl" value=$oViewConf->getModuleUrl('d3heidelpay','out/img/')}]
[{assign var='oHeidelPaySettings' value=$oHeidelpayViewConfig->getSettings()}]
[{assign var='oHeidelPayment' value=$oHeidelPaySettings->getPayment($paymentmethod)}]
[{assign var="aBrands" value=$oHeidelpayViewConfig->getHeidelpayNgwBrands($paymentmethod, $oHeidelPayment, $oxcmp_user)}]
[{assign var="sBrandIdent" value=$aBrands.PAYPAL|lower}]
[{assign var="sFullImageUrl" value=$sImageUrl|cat:'logo_'|cat:$sBrandIdent|cat:'.png'}]

[{block name="heidelpay_paypal"}]
    <dl>
        <dt>
            <input type="radio"
                    [{if $blD3HeidelpayHasSameAdresses}]
                        id="payment_[{$sPaymentID}]"
                        name="paymentid"
                        value="[{$sPaymentID}]"
                        [{if $oView->getCheckedPaymentId() == $paymentmethod->oxpayments__oxid->value}]checked[{/if}]
                    [{else}]
                        disabled
                    [{/if}]
            >
            <label for="payment_[{$sPaymentID}]"><b>[{$paymentmethod->oxpayments__oxdesc->value}]</b></label>
            [{include file="d3_heidelpay_views_tpl_payment_img.tpl" sImageUrl=$sFullImageUrl sBrandIdent=$sBrandIdent}]
            [{if false == $blD3HeidelpayHasSameAdresses}]
                <sup class="d3HeidelaySameAddressNotice">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_NOTSAMEADDRESS_NOTICE"}]</sup>
            [{/if}]
        </dt>
        <dd class="[{if $oView->getCheckedPaymentId() == $paymentmethod->oxpayments__oxid->value}]activePayment[{/if}]">
            [{if $paymentmethod->oxpayments__oxlongdesc->value}]
                <div class="desc">
                    [{$paymentmethod->oxpayments__oxlongdesc->value}]
                </div>
            [{/if}]
        </dd>
    </dl>
[{/block}]
