[{assign var="sImageUrl" value=$oViewConf->getModuleUrl('d3heidelpay','out/img/')}]
[{assign var='oHeidelPaySettings' value=$oHeidelpayViewConfig->getSettings()}]
[{assign var='oHeidelPayment' value=$oHeidelPaySettings->getPayment($paymentmethod)}]
[{assign var="aBrands" value=$oHeidelpayViewConfig->getHeidelpayNgwBrands($paymentmethod, $oHeidelPayment, $oxcmp_user)}]

[{block name="heidelpay_postfinance"}]
    <dl>
        <dt>
            <input type="radio"
                    [{if $blD3HeidelpayAllowPostFinance}]
                        id="payment_[{$sPaymentID}]"
                        name="paymentid"
                        value="[{$sPaymentID}]"
                        [{if $oView->getCheckedPaymentId() == $paymentmethod->oxpayments__oxid->value}]checked[{/if}]
                    [{else}]
                        disabled
                    [{/if}]
            >
            <label for="payment_[{$sPaymentID}]"><b>[{$paymentmethod->oxpayments__oxdesc->value}]</b></label>
            [{include file="d3_heidelpay_views_tpl_payment_img.tpl" sImageUrl=$sImageUrl|cat:'logo_postfinance.png' sBrandIdent=$sBrandIdent}]
            [{if false == $blD3HeidelpayAllowPostFinance}]
                <sup id="d3HeidelayPostfinanceNotice">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_POSTFINANCE_NOTICE"}]</sup>
            [{/if}]
        </dt>
        <dd class="[{if $oView->getCheckedPaymentId() == $paymentmethod->oxpayments__oxid->value}]activePayment[{/if}]">
            [{if $blD3HeidelpayAllowPostFinance}]
                <ul class="form">
                    <li>
                        <label for="payment_[{$sPaymentID}]_1">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_POSTFINANCE_PAYMENTS"}]</label>
                        <select id="payment_[{$sPaymentID}]_1" name="dynvalue[lsbankname]">
                            [{foreach from=$aBrands item='sBrandName' key='sBrandIdent'}]
                                <option value="[{$sBrandIdent}]"
                                        [{if ($dynvalue.lsbankname == $sBrandIdent)}]selected[{/if}]>[{$sBrandName}]</option>
                            [{/foreach}]
                        </select>
                    </li>
                </ul>
            [{/if}]
            [{if $paymentmethod->oxpayments__oxlongdesc->value}]
                <div class="desc">
                    [{$paymentmethod->oxpayments__oxlongdesc->value}]
                </div>
            [{/if}]
        </dd>
    </dl>
[{/block}]
