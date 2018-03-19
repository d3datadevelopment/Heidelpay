[{assign var="sImageUrl" value=$oViewConf->getModuleUrl('d3heidelpay','out/img/')}]
[{assign var="sBrandIdent" value='przelewy24'}]
[{assign var="sFullImageUrl" value=$sImageUrl|cat:'logo_'|cat:$sBrandIdent|cat:'.png'}]

[{block name="heidelpay_przelewy"}]
    <dl>
        <dt>
            <input type="radio"
                    [{if $blD3HeidelpayAllowPrzelewy24}]
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
                [{include file="d3_heidelpay_views_tpl_payment_img.tpl" sImageUrl=$sFullImageUrl sBrandIdent=$sBrandIdent}]
            </label>
            [{if false == $blD3HeidelpayAllowPrzelewy24}]
                <sup class="alert alert-danger">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_PRZELEWY24_NOTICE"}]</sup>
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
            [{if $paymentmethod->oxpayments__oxlongdesc->value}]
                <div class="alert alert-info desc">
                    [{$paymentmethod->oxpayments__oxlongdesc->value}]
                </div>
            [{/if}]
        </dd>
    </dl>
[{/block}]
