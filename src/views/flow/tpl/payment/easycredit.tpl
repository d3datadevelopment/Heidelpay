[{assign var="sImageUrl" value=$oViewConf->getModuleUrl('d3heidelpay','out/img/')}]
[{assign var='oHeidelPaySettings' value=$oHeidelpayViewConfig->getSettings()}]
[{assign var='oHeidelPayment' value=$oHeidelPaySettings->getPayment($paymentmethod)}]
[{assign_adv var="returnParameter" value="array('configoptintext', 'accountbrand', 'transactionid', 'd3transactionlogid')"}]
[{assign var="responseParameter" value=$oHeidelpayViewConfig->getAction($oHeidelPayment, 'IN', $returnParameter)}]
[{assign var="sBrandIdent" value=$responseParameter.accountbrand}]
[{assign var="sFullImageUrl" value=$sImageUrl|cat:'logo_ratenkauf_ec.jpg'}]

[{block name="heidelpay_easycredit"}]
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
                <sup id="d3HeidelayEasycreditNotice"
                     class="alert alert-danger desc">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_EASYCREDIT_NOTICE"}]</sup>
            [{/if}]
            [{if false == $blD3HeidelpayHasSameAdresses}]
                <sup class="alert alert-danger d3HeidelaySameAddressNotice">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_NOTSAMEADDRESS_NOTICE"}]</sup>
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
            [{if $paymentmethod->oxpayments__oxlongdesc->value}]
                <div class="alert alert-info desc">
                    [{$paymentmethod->oxpayments__oxlongdesc->value}]
                </div>
            [{/if}]
        </dd>
    </dl>
[{/block}]
