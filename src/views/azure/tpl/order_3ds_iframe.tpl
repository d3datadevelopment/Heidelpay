<html>
<head>
    <title>[{oxmultilang ident="D3HEIDELPAY_ORDER_3DS_IFRAME_APRP"}]</title>
    <style type="text/css">
        <!--
        html, body{
            font-family:Tahoma, Arial, sans-serif;
            font-size:11px;
            color:#000000;
            background-color:#ffffff;
        }

        -->
    </style>
</head>
<body onLoad="OnLoadEvent();">
[{assign var='o3DSecure' value=$oHeidelpayViewConfig->get3dSecureResponse()}]
<form name="event" id="event" action="[{$o3DSecure->sRedirectURL}]" method="post">
    [{foreach from=$o3DSecure->aRedirectRarams key='key' item='value'}]
        <input type="hidden" name="[{$key}]" value="[{$value}]">
    [{/foreach}]
    <noscript>
        <p>

            [{oxmultilang ident="D3HEIDELPAY_ORDER_3DS_IFRAME_NOJS"}]<br>
            [{oxmultilang ident="D3HEIDELPAY_ORDER_3DS_IFRAME_TEXTDE"}]
            <br>
            <br>
            [{oxmultilang ident="D3HEIDELPAY_ORDER_3DS_IFRAME_TEXTEN"}]
        </p>
    </noscript>
</form>

<script type="text/javascript">
    <!--
    function OnLoadEvent() {
        document.forms.event.submit(
        );
    }

    //-->
</script>
</body>
</html>
