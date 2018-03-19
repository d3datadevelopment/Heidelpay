
<div class="alert alert-danger">
    [{if $d3heidelpayErrorCodes.OXCODE}]
        [{assign var="langident" value=$d3heidelpayErrorCodes.OXCODE}]
        [{oxmultilang ident="d3heidelpay_$langident"}]
    [{else}]
        [{oxmultilang ident="D3PAYMENT_EXT_NOTEXT"}]
    [{/if}]
    <br>

    [{if $d3heidelpayErrorCodes.OXTYPE == "1"}]    [{* Fehlerkategorie: Eingabefehler *}]
        [{oxmultilang ident="D3PAYMENT_EXT_CHECK"}]
    [{elseif $d3heidelpayErrorCodes.OXTYPE == "2"}]    [{* Fehlerkategorie: Technischer Fehler *}]
        [{oxmultilang ident="D3PAYMENT_EXT_TRYLATER"}]
    [{elseif $d3heidelpayErrorCodes.OXTYPE == "3"}]    [{* Fehlerkategorie: Betrugsversuch? *}]
        [{oxmultilang ident="D3PAYMENT_EXT_CHANGEPAYMENT"}]
    [{/if}]
</div>
