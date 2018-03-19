[{if $easyCreditInformations}]
    <div class="status corners error">
        <p>
            [{oxmultilang ident="D3HEIDELPAY_ORDER_EASYCREDIT_ACCRUINGINTEREST"}] [{oxprice price=$easyCreditInformations.criterion_easycredit_accruinginterest currency=$currency}]<br/>
            [{oxmultilang ident="D3HEIDELPAY_ORDER_EASYCREDIT_TOTALAMOUNT"}] [{oxprice price=$easyCreditInformations.criterion_easycredit_totalamount currency=$currency}]<br/>
            <a href="[{$easyCreditInformations.criterion_easycredit_precontractinformationurl}]" target="easyCredit"
               class="submitButton largeButton">[{oxmultilang ident="D3HEIDELPAY_ORDER_EASYCREDIT_LINK"}]</a>
        </p>
    </div>
[{/if}]
