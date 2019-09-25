[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]

[{if $readonly}]
    [{assign var="readonly" value="readonly disabled"}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]

<form name="transfer" id="transfer" action="[{$oViewConf->getSelfLink()}]" method="post">
    [{$oViewConf->getHiddenSid()}]
    <input type="hidden" name="cur" value="[{$oCurr->id}]">
    <input type="hidden" name="oxid" value="[{$oxid}]">
    <input type="hidden" name="cl" value="[{$oView->getClassName()}]">
</form>

[{if $oView->isModuleDemoVersion()}]
    <div class="extension_warning">[{oxmultilang ident="D3_HEIDELPAY_IS_DEMO"}]</div>
[{/if}]

<table cellspacing="0" cellpadding="0" border="0" width="100%">
    <tr>
        <td valign="top" class="edittext" width="100%">
            [{block name="admin_order_heidelpay_form"}]
                <label>
                    Heidelpay Konfiguration zuordnen
                    <select name="" id="">
                        <option value="">keine Konfiguration</option>
                        <option value="">Kreditkarte</option>
                        <option value="">Debitkarte</option>
                        <option value="">Lastschrift (Bankeinzug)</option>
                        <option value="">Lastschrift mit Zahlungssicherung</option>
                        <option value="">autom. Vorkasse</option>
                        <option value="">PostFinance</option>
                        <option value="">Sofort</option>
                        <option value="">iDeal</option>
                        <option value="">Giropay</option>
                        <option value="">EPS</option>
                        <option value="">Rechnungskauf mit Zahlungssicherung</option>
                        <option value="">Rechnungskauf ohne Zahlungssicherung</option>
                        <option value="">PayPal</option>
                        <option value="">Przelewy24</option>
                        <option value="">MasterPass</option>
                    </select>
                </label>
            [{/block}]
        </td>
    </tr>
    <tr>
        <td class="edittext">
            <input type="submit" class="edittext" name="save" value="Speichern" onclick="document.myedit.fnc.value='save'">
        </td>
    </tr>
</table>


[{capture name="doNotShow"}]
    <script type="text/javascript">
        [{capture name="javaScript"}]

        [{/capture}]
    </script>
[{/capture}]
[{oxscript add=$smarty.capture.javaScript}]

[{include file="bottomnaviitem.tpl"}]

[{include file="d3_cfg_mod_inc.tpl"}]
