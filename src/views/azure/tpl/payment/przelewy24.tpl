[{assign var="sImageUrl" value=$oViewConf->getModuleUrl('d3heidelpay','out/img/')}]
[{assign var="sBrandIdent" value='PRZELEWY24'|lower}]
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
            <label for="payment_[{$sPaymentID}]"><b>[{$paymentmethod->oxpayments__oxdesc->value}]</b></label>
            [{include file="d3_heidelpay_views_tpl_payment_img.tpl" sImageUrl=$sFullImageUrl sBrandIdent=$sBrandIdent}]
            [{if false == $blD3HeidelpayAllowPrzelewy24}]
                <sup id="d3HeidelayPrzelewy24Notice">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_PRZELEWY24_NOTICE"}]</sup>
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
