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
