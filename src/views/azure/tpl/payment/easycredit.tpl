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
            <label for="payment_[{$sPaymentID}]"><b>[{$paymentmethod->oxpayments__oxdesc->value}]</b></label>
            [{include file="d3_heidelpay_views_tpl_payment_img.tpl" sImageUrl=$sFullImageUrl sBrandIdent=$sBrandIdent}]
            [{if false == $blD3HeidelpayAllowEasyCredit}]
                <sup id="d3HeidelayEasycreditNotice"
                     class="alert alert-danger desc">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_EASYCREDIT_NOTICE" args=$iD3HeidelpayEasycreditLimits}]</sup>
            [{/if}]
            [{if false == $blD3HeidelpayHasSameAdresses}]
                <sup class="d3HeidelaySameAddressNotice">[{oxmultilang ident="D3HEIDELPAY_PAYMENT_NOTSAMEADDRESS_NOTICE"}]</sup>
            [{/if}]
        </dt>
        <dd class="[{if $oView->getCheckedPaymentId() == $paymentmethod->oxpayments__oxid->value}]activePayment[{/if}]">
            [{if $blD3HeidelpayAllowEasyCredit && $blD3HeidelpayHasSameAdresses}]
                [{if $blD3HeidelpayEasycreditNotChecked}]
                    <div class="d3HeidelaySameAddressNotice desc">
                        [{oxmultilang ident="D3HEIDELPAY_PAYMENT_EASYCREDIT_CHECKBOX_NOT_CHECKED"}]
                    </div>
                [{/if}]
                <div class="desc">
                    <input type="hidden" name="d3heidelpayEasycreditTransactionLogid[[{$sPaymentID}]]" value="0"/>
                    <label>
                        <input type="checkbox" name="d3heidelpayEasycreditTransactionLogid[[{$sPaymentID}]]"
                               value="[{$responseParameter.d3transactionlogid}]"/>
                        [{$responseParameter.configoptintext}]
                    </label>
                </div>
            [{/if}]
            [{if $paymentmethod->oxpayments__oxlongdesc->value}]
                <div class="desc">
                    [{$paymentmethod->oxpayments__oxlongdesc->value}]
                </div>
            [{/if}]
        </dd>
    </dl>
[{/block}]
