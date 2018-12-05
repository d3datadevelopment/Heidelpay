[{assign var="sImageUrl" value=$oViewConf->getModuleUrl('d3heidelpay','out/img/')}]
[{assign var="dynvalue" value=$oView->getDynValue()}]
[{assign var='oHeidelPaySettings' value=$oHeidelpayViewConfig->getSettings()}]
[{assign var='oHeidelPayment' value=$oHeidelPaySettings->getPayment($paymentmethod)}]
[{assign var="aBrands" value=$oHeidelpayViewConfig->getHeidelpayNgwBrands($paymentmethod, $oHeidelPayment, $oxcmp_user)}]
[{assign var="sBrandIdentIdeal" value='iDeal'}]
[{assign var="sFullImageUrl" value=$sImageUrl|cat:'logo_ideal.jpg'}]

[{block name="heidelpay_ideal"}]
    <dl>
        <dt>
            <input type="radio"
                    [{if $blD3HeidelpayAllowIdeal}]
                        id="payment_[{$sPaymentID}]"
                        name="paymentid"
                        value="[{$sPaymentID}]"
                        [{if $oView->getCheckedPaymentId() == $paymentmethod->oxpayments__oxid->value}]checked[{/if}]
                    [{else}]
                        disabled
                    [{/if}]
            >
            <label for="payment_[{$sPaymentID}]"><b>[{$paymentmethod->oxpayments__oxdesc->value}]</b></label>
            [{include file="d3_heidelpay_views_tpl_payment_img.tpl" sImageUrl=$sFullImageUrl sBrandIdent=$sBrandIdentIdeal}]
            [{if false == $blD3HeidelpayAllowIdeal}]
                <sup id="d3HeidelayIDealNotice">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_IDEAL_NOTICE"}]</sup>
            [{/if}]
        </dt>
        <dd class="[{if $oView->getCheckedPaymentId() == $paymentmethod->oxpayments__oxid->value}]activePayment[{/if}]">
            [{if $blD3HeidelpayAllowIdeal}]
                <ul class="form">
                    <li>
                        <label for="payment_[{$sPaymentID}]_1">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_INPUT_BANK"}]</label>
                        <input type="hidden" name="dynvalue[lsland]" value="NL">
                        <select id="payment_[{$sPaymentID}]_1" name="dynvalue[lsbankname]">
                            <option value="">[{oxmultilang ident="D3PAYMENT_EXT_SELECTPLEASE"}]</option>
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

