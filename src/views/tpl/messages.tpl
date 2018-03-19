[{if $oView->d3CheckForMobileTheme() == false}]
    <div class="status error">
        <div>[{oxmultilang ident="D3PAYMENT_EXT_ERROR"}]</div>
        [{if $d3heidelpayErrorCodes.OXCODE}]
            [{assign var="langident" value=$d3heidelpayErrorCodes.OXCODE}]
            <h3 style="color:#AA0000;">[{oxmultilang ident="d3heidelpay_$langident"}]</h3>
        [{else}]
            <h3 style="color:#AA0000;">[{oxmultilang ident="D3PAYMENT_EXT_NOTEXT"}]</h3>
        [{/if}]

        [{if $d3heidelpayErrorCodes.OXTYPE == "1"}]    [{* Fehlerkategorie: Eingabefehler *}]
            <div>[{oxmultilang ident="D3PAYMENT_EXT_CHECK"}]</div>
        [{elseif $d3heidelpayErrorCodes.OXTYPE == "2"}]    [{* Fehlerkategorie: Technischer Fehler *}]
            <div>[{oxmultilang ident="D3PAYMENT_EXT_TRYLATER"}]</div>
        [{elseif $d3heidelpayErrorCodes.OXTYPE == "3"}]    [{* Fehlerkategorie: Betrugsversuch? *}]
            <div>[{oxmultilang ident="D3PAYMENT_EXT_CHANGEPAYMENT"}]</div>
        [{/if}]
    </div>
[{else}]
    <div class="payment-row">
        [{assign var="sPayErrorClass" value='alert alert-error'}]
        [{if $d3heidelpayErrorCodes.OXCODE}]
            [{assign var="langident" value=$d3heidelpayErrorCodes.OXCODE}]
            <div class="[{$sPayErrorClass}]">[{oxmultilang ident="d3heidelpay_$langident"}]</div>
        [{else}]
            <div class="[{$sPayErrorClass}]">[{oxmultilang ident="D3PAYMENT_EXT_NOTEXT"}]</div>
        [{/if}]

        [{if $d3heidelpayErrorCodes.OXTYPE == "1"}]    [{* Fehlerkategorie: Eingabefehler *}]
            <div class="[{$sPayErrorClass}]">[{oxmultilang ident="D3PAYMENT_EXT_CHECK"}]</div>
        [{elseif $d3heidelpayErrorCodes.OXTYPE == "2"}]    [{* Fehlerkategorie: Technischer Fehler *}]
            <div class="[{$sPayErrorClass}]">[{oxmultilang ident="D3PAYMENT_EXT_TRYLATER"}]</div>
        [{elseif $d3heidelpayErrorCodes.OXTYPE == "3"}]    [{* Fehlerkategorie: Betrugsversuch? *}]
            <div class="[{$sPayErrorClass}]">[{oxmultilang ident="D3PAYMENT_EXT_CHANGEPAYMENT"}]</div>
        [{/if}]
    </div>
[{/if}]
