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
            <label for="payment_[{$sPaymentID}]">
                <b>[{$paymentmethod->oxpayments__oxdesc->value}]</b>
                [{include file="d3_heidelpay_views_tpl_payment_img.tpl" sImageUrl=$sImageUrl|cat:'logo_postfinance.png' sBrandIdent=$sBrandIdent}]
            </label>
            [{if false == $blD3HeidelpayAllowPostFinance}]
                <sup id="d3HeidelayPostfinanceNotice">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_POSTFINANCE_NOTICE"}]</sup>
            [{/if}]
        </dt>
        <dd class="[{if $oView->getCheckedPaymentId() == $paymentmethod->oxpayments__oxid->value}]activePayment[{/if}]">
            [{if $blD3HeidelpayAllowPostFinance}]
                <div class="form-group">
                    <label class="control-label col-sm-4"
                           for="payment_[{$sPaymentID}]_1">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_POSTFINANCE_PAYMENTS"}]</label>
                    <div class="col-sm-4">
                        <select class="form-control" id="payment_[{$sPaymentID}]_1" name="dynvalue[lsbankname]">
                            [{foreach from=$aBrands item='sBrandName' key='sBrandIdent'}]
                                <option value="[{$sBrandIdent}]"
                                        [{if ($dynvalue.lsbankname == $sBrandIdent)}]selected[{/if}]>[{$sBrandName}]</option>
                            [{/foreach}]
                        </select>
                    </div>
                </div>
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
[{/block}]
