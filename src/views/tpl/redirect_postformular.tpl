<!DOCTYPE HTML>
[{assign var="sLanguage" value=$oView->getActiveLangAbbr()}]
<html [{if $sLanguage}]lang="[{$sLanguage}]"[{/if}]>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=[{$oView->getCharSet()}]">
</head>
<body>
<form action="[{$sRedirectURL}]" method="post" name="frm">
    [{foreach from=$aRedirectParameter item="sParameterValue" key="sParameterName"}]
        <input type="hidden" name="[{$sParameterName}]" value="[{$sParameterValue|htmlentities}]">
    [{/foreach}]

    <noscript><input type="submit" value="[{oxmultilang ident="D3_Heidelpay_REDIRECT_NOSCRIPT"}]"/></noscript>
</form>
<script type="text/javascript">
    document.frm.submit();
</script>
</body>
