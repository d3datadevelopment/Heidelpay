[{assign var="sImageUrl" value=$oViewConf->getModuleUrl('d3heidelpay','out/img/')}]
[{assign var='oHeidelPaySettings' value=$oHeidelpayViewConfig->getSettings()}]
[{assign var='oHeidelPayment' value=$oHeidelPaySettings->getPayment($paymentmethod)}]
[{assign_adv var="returnParameter" value="array('configoptintext', 'accountbrand', 'transactionid', 'd3transactionlogid')"}]
[{assign var="responseParameter" value=$oHeidelpayViewConfig->getAction($oHeidelPayment, 'IN', $returnParameter)}]
[{assign var="sBrandIdent" value=$responseParameter.accountbrand}]
[{assign var="sFullImageUrl" value=$sImageUrl|cat:'logo_ratenkauf_ec.jpg'}]

[{block name="heidelpay_easycredit"}]
    <div class="well well-sm">
        <dl>
            <dt>
                <input type="radio"
                        [{if $blD3HeidelpayHasSameAdresses && $blD3HeidelpayAllowEasyCredit}]
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
                [{if false == $blD3HeidelpayAllowEasyCredit}]
                    <dfn id="d3HeidelayEasycreditNotice"
                         class="alert alert-danger desc">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_EASYCREDIT_NOTICE" args=$iD3HeidelpayEasycreditLimits}]</dfn>
                [{/if}]
                [{if false == $blD3HeidelpayHasSameAdresses}]
                    <dfn class="alert alert-danger d3HeidelaySameAddressNotice">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_NOTSAMEADDRESS_NOTICE"}]</dfn>
                [{/if}]
            </dt>
            <dd class="payment-option [{if $oView->getCheckedPaymentId() == $paymentmethod->oxpayments__oxid->value}]activePayment[{/if}]">
                [{assign var="oPaymentPrice" value=$paymentmethod->getPrice()}]
                [{if $oPaymentPrice->getPrice()}]
                    [{if $oViewConf->isFunctionalityEnabled('blShowVATForPayCharge')}]
                        ([{oxprice price=$oPaymentPrice->getNettoPrice() currency=$currency}]
                        [{if $oPaymentPrice->getVatValue() > 0}]
                            [{oxmultilang ident="PLUS_VAT"}] [{oxprice price=$oPaymentPrice->getVatValue() currency=$currency}]
                        [{/if}])
                    [{else}]
                        ([{oxprice price=$oPaymentPrice->getBruttoPrice() currency=$currency}])
                    [{/if}]
                [{/if}]
                [{if $blD3HeidelpayAllowEasyCredit && $blD3HeidelpayHasSameAdresses}]
                    <div class="row">
                        <div class="col-xs-12 col-lg-9 offset-lg-3">
                            [{if $blD3HeidelpayEasycreditNotChecked}]
                                <div class="alert alert-danger desc">
                                    [{oxmultilang ident="D3HEIDELPAY_PAYMENT_EASYCREDIT_CHECKBOX_NOT_CHECKED"}]
                                </div>
                            [{/if}]
                            <div class="alert alert-info desc">
                                <input type="hidden" name="d3heidelpayEasycreditTransactionLogid[[{$sPaymentID}]]"
                                       value="0"/>
                                <label>
                                    <input type="checkbox" name="d3heidelpayEasycreditTransactionLogid[[{$sPaymentID}]]"
                                           value="[{$responseParameter.d3transactionlogid}]"/>
                                    [{$responseParameter.configoptintext}]
                                </label>
                            </div>
                        </div>
                    </div>
                [{/if}]

                [{block name="checkout_payment_longdesc"}]
                    [{if $paymentmethod->oxpayments__oxlongdesc->value}]
                        <div class="row">
                            <div class="col-xs-12 col-lg-9 offset-lg-3">
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
