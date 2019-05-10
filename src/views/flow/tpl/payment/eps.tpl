[{assign var="sImageUrl" value=$oViewConf->getModuleUrl('d3heidelpay','out/img/')}]
[{assign var="dynvalue" value=$oView->getDynValue()}]
[{assign var='oHeidelPaySettings' value=$oHeidelpayViewConfig->getSettings()}]
[{assign var='oHeidelPayment' value=$oHeidelPaySettings->getPayment($paymentmethod)}]
[{assign var="aBrands" value=$oHeidelpayViewConfig->getHeidelpayNgwBrands($paymentmethod, $oHeidelPayment, $oxcmp_user)}]
[{assign var="sBrandIdentEPS" value='EPS'}]
[{assign var="sFullImageUrl" value=$sImageUrl|cat:'logo_eps.jpg'}]

[{block name="heidelpay_eps"}]
    <div class="well well-sm">
        <dl>
            <dt>
                <input type="radio"
                     [{if $blD3HeidelpayAllowEPS}]
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
                [{if false == $blD3HeidelpayAllowEPS}]
                    <sup id="d3HeidelayPrzelewy24Notice"
                         class="alert alert-danger">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_IDEAL_NOTICE"}]</sup>
                [{/if}]
            </dt>
            <dd class="[{if $oView->getCheckedPaymentId() == $paymentmethod->oxpayments__oxid->value}]activePayment[{/if}]">
                <div class="form-group">
                    <label class="req control-label col-lg-3" for="d3heidelpay_eps_[{$paymentmethod->oxpayments__oxid->value}]">
                        [{oxmultilang ident="D3HEIDELPAY_PAYMENT_INPUT_BANK_ACCOUNTHOLDER"}]
                    </label>
                    <div class="col-lg-9">
                        <input type="text"
                               class="form-control js-oxValidate js-oxValidate_notEmpty"
                               size="20"
                               maxlength="64"
                               id="d3heidelpay_eps_[{$paymentmethod->oxpayments__oxid->value}]"
                               name="dynvalue[lsktoinhaber]"
                               title="[{oxmultilang ident="D3HEIDELPAY_PAYMENT_INPUT_BANK_ACCOUNTHOLDER"}]"
                               value="[{if $dynvalue.lsktoinhaber}][{$dynvalue.lsktoinhaber}][{else}][{$oxcmp_user->oxuser__oxfname->value}] [{$oxcmp_user->oxuser__oxlname->value}][{/if}]">
                    </div>
                </div>
                [{if $blD3HeidelpayAllowEPS}]
                    <div class="form-group">
                        <label class="req control-label col-lg-3"
                               for="payment_[{$sPaymentID}]_1">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_INPUT_BANK"}]</label>
                        <input type="hidden" name="dynvalue[lsland]" value="AT">
                        <div class="col-lg-9">
                            <select class="form-control" id="payment_[{$sPaymentID}]_1" name="dynvalue[lsbankname]">
                                <option value="">[{oxmultilang ident="D3PAYMENT_EXT_SELECTPLEASE"}]</option>
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
    </div>
[{/block}]
