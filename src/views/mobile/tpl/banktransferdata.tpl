<div class="alert alert-error">
    <p>
        [{if $oPrePaymentData->Type == "D3_Heidelpay_models_payment_billsafe"}]
            [{$oPrePaymentData->Billsafe_Note}]
            <br/>
            <br/>
            [{$oPrePaymentData->Billsafe_LegalNote}]
            <br/>
            <br/>
            <a class="btn"
               href="[{$oPrePaymentData->Billsafe_PdfUrl}]"
               target="_blank">[{oxmultilang ident="D3HEIDELPAY_THANKYOU_PAYMENTFORMPDF"}]</a>
            <br/>
            <br/>
        [{else}]
            [{oxmultilang ident="D3HEIDELPAY_THANKYOU_PREPAYMENT_INFOTEXT1"}]
            <br/>
            <span>[{oxmultilang ident="D3HEIDELPAY_THANKYOU_PREPAYMENT_INFOTEXT2"}]</span>
        [{/if}]
    </p>

    <p>
        [{oxmultilang ident="D3HEIDELPAY_THANKYOU_PREPAYMENT_ACCOUNTHOLDER"}] [{$oPrePaymentData->Holder}]<br/>
        [{if $oPrePaymentData->Type == "D3_Heidelpay_models_payment_billsafe"}] [{* Bereich BillSAFE*}]
            [{oxmultilang ident="D3HEIDELPAY_THANKYOU_PREPAYMENT_BANKNAME"}] [{$oPrePaymentData->Bankname}]
            <br/>
        [{/if}]
        [{oxmultilang ident="D3HEIDELPAY_THANKYOU_PREPAYMENT_IBAN"}] [{$oPrePaymentData->Iban}]<br/>
        [{oxmultilang ident="D3HEIDELPAY_THANKYOU_PREPAYMENT_BIC"}] [{$oPrePaymentData->Bic}]<br/>
        [{oxmultilang ident="D3HEIDELPAY_THANKYOU_PREPAYMENT_AMOUNT"}] [{$oPrePaymentData->Amount}] [{$oPrePaymentData->Currency}]
        <br/>
        [{oxmultilang ident="D3HEIDELPAY_THANKYOU_PREPAYMENT_REASON"}] [{$oPrePaymentData->Reference}]
    </p>
</div>
