[{d3modcfgcheck modid="d3heidelpay"}][{/d3modcfgcheck}]

[{if $mod_d3heidelpay }]
    [{assign var="oPrePaymentData" value=$order->getHeidelpayBankTransferData()}]
    [{assign var="easyCreditInformations" value=$order->getHeidelpayEasyCreditInformations()}]

    [{if $oPrePaymentData}]
        <div>
            <p>
                [{if $oPrePaymentData->Type == "D3_Heidelpay_models_payment_billsafe"}]
                    [{$oPrePaymentData->Billsafe_Note}]
                    <br/>
                    <br/>
                    [{$oPrePaymentData->Billsafe_LegalNote}]
                    <br/>
                    <br/>
                    <a href="[{$oPrePaymentData->Billsafe_PdfUrl}]"
                       target="_blank">[{oxmultilang ident="D3HEIDELPAY_THANKYOU_PAYMENTFORMPDF"}]</a>
                    <br/>
                [{else}]
                    [{oxmultilang ident="D3HEIDELPAY_EMAIL_PREPAYMENT_INFOTEXT1"}]
                    <br/>
                    <span style="color: red;">[{oxmultilang ident="D3HEIDELPAY_EMAIL_PREPAYMENT_INFOTEXT2"}]</span>
                [{/if}]
            </p>
            <p>
                [{oxmultilang ident="D3HEIDELPAY_EMAIL_PREPAYMENT_ACCOUNTHOLDER"}] [{$oPrePaymentData->Holder}]<br/>
                [{if $oPrePaymentData->Type == "D3_Heidelpay_models_payment_billsafe"}]
                    [{oxmultilang ident="D3HEIDELPAY_EMAIL_PREPAYMENT_BANKNAME"}] [{$oPrePaymentData->Bankname}]
                    <br/>
                [{/if}]
                [{oxmultilang ident="D3HEIDELPAY_EMAIL_PREPAYMENT_IBAN"}] [{$oPrePaymentData->Iban}]<br/>
                [{oxmultilang ident="D3HEIDELPAY_EMAIL_PREPAYMENT_BIC"}] [{$oPrePaymentData->Bic}]<br/>
                [{oxmultilang ident="D3HEIDELPAY_EMAIL_PREPAYMENT_AMOUNT"}] [{$oPrePaymentData->Amount}] [{$oPrePaymentData->Currency}]
                <br/>
                [{oxmultilang ident="D3HEIDELPAY_EMAIL_PREPAYMENT_REASON"}] [{$oPrePaymentData->Reference}]
            </p>
        </div>
        <br>
        <br>
    [{/if}]

    [{if $easyCreditInformations}]
        <div>
            <p>
                [{oxmultilang ident="D3HEIDELPAY_ORDER_EASYCREDIT_ACCRUINGINTEREST"}] [{oxprice price=$easyCreditInformations.criterion_easycredit_accruinginterest currency=$currency}]
                <br/>
                [{oxmultilang ident="D3HEIDELPAY_ORDER_EASYCREDIT_TOTALAMOUNT"}] [{oxprice price=$easyCreditInformations.criterion_easycredit_totalamount currency=$currency}]
                <br/>
                <a href="[{$easyCreditInformations.criterion_easycredit_precontractinformationurl}]" target="easyCredit"
                >[{oxmultilang ident="D3HEIDELPAY_ORDER_EASYCREDIT_LINK"}]</a>
            </p>
        </div>
    [{/if}]
[{/if}]

[{$smarty.block.parent}]

