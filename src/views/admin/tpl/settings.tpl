[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]
<style type="text/css">

    td.edittext.disabled { color : darkgrey; }

    td.edittext.disabled input { border : 1px solid lightgray; }

    td.edittext table.disabled,
    td.edittext legend.disabled { color : darkgrey; }

    table { background-color : white; }
    .groupExp dl dt{
        font-weight: normal;
        width: 35%;
        padding-left: 10px;
    }

    td.edittext fieldset,
    form fieldset {
        background: none;
        border: 1px solid #ccc;
        padding: 0 0 5px 5px;
        border-radius: 3px;
        margin-bottom: 2px;
    }
</style>

[{if $readonly}]
    [{assign var="readonly" value="readonly disabled"}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]

<!-- Errors and Messages -->
[{assign var='hasMultilangConfigButNoSetting' value=$oView->hasMultilangConfigButNoSetting()}]
[{if $hasMultilangConfigButNoSetting}]
    <fieldset>
        <div class="extension_error">
            [{oxmultilang ident="D3DYN_HEIDELPAY_HASMULTILANGCONFIGBUTNOSETTING"}]
            [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_HASMULTILANGCONFIGBUTNOSETTING"}]
        </div>
        <form action="[{$oViewConf->getSelfLink()}]" method="post" id="multipleLanguages">
            [{$oViewConf->getHiddenSid()}]
            <input type="hidden" name="oxid" value="[{$oxid}]">
            <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
            <input type="hidden" name="editlanguage" value="[{$editlanguage}]">
            <input type="hidden" name="fnc" value="">

            <table width="100%">
                <colgroup>
                    <col width="50%">
                    <col width="50%">
                </colgroup>
                <tr>
                    <td align="center">
                        <span class="d3modcfg_btn fixed icon status_info" style="float:right;max-width:none;">
                            <input type="submit" value="[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_ALLOWMULTIPLELANGUAGES_REACTIVATE"}]"
                                   onclick="document.getElementById('multipleLanguages').fnc.value='resetAllowMultipleLanguages'">
                            <span></span>
                        </span>
                    </td>
                    <td align="center">
                        <span class="d3modcfg_btn fixed icon status_info" style="max-width:none;">
                            <input type="submit" class="edittext" value="[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_REMOVEMULTIPLELANGUAGES"}]"
                                   onclick="document.getElementById('multipleLanguages').fnc.value='deleteMultiLangConfig'">
                            <span></span>
                        </span>
                    </td>
                </tr>
            </table>
        </form>
    </fieldset>
[{/if}]

[{if $oHeidelpayViewConfig->isModuleDemoVersion()}]
    [{assign var='sDisableTestModus' value='disabled'}]
    <div class="extension_warning">[{oxmultilang ident="D3_HEIDELPAY_IS_DEMO"}]</div>
[{/if}]
[{if $edit->getErrorMessage()}]
    <div class="extension_error">[{$edit->getErrorMessage()}]</div>
[{/if}]
[{if $oView->hasOnlyBasicFunctions()}]
    [{assign var="blBasicRestriction" value="disabled"}]
    <div class="extension_warning">[{oxmultilang ident="D3_HEIDELPAY_RESTRICTIONINFO"}]</div>
[{/if}]
[{if $blCurlMissing}]
    <span style="color: red; ">[{oxmultilang ident="D3DYN_HEIDELPAY_NOCURL"}]</span>
[{/if}]

<form name="transfer" id="transfer" action="[{$oViewConf->getSelfLink()}]" method="post">
    [{$oViewConf->getHiddenSid()}]
    <input type="hidden" name="oxid" value="[{$oxid}]">
    <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
    <input type="hidden" name="editlanguage" value="[{$editlanguage}]">
</form>
<table cellspacing="0" cellpadding="0" border="0" width="100%">
<tr>
<td width="2%"></td>
<!-- Anfang linke Seite -->
<td valign="top" class="edittext" align="left" width="48%">

    <form name="myedit" id="myedit" action="[{$oViewConf->getSelfLink()}]" method="post">
        [{$oViewConf->getHiddenSid()}]
        <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
        <input type="hidden" name="fnc" value="">
        <input type="hidden" name="oxid" value="[{$oxid}]">
        <input type="hidden" name="editval[d3_cfg_mod__oxid]" value="[{$oxid}]">
        <input type="hidden" name="editlanguage" value="[{$editlanguage}]">

        <table cellspacing="0" cellpadding="0" border="0" width="100%">
            <tr>
                <td class="edittext">
                    <b>[{oxmultilang ident="D3DYN_HEIDELPAY_ACTIVE"}]</b>
                </td>
                <td class="edittext">
                    [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_ACTIVE"}]
                    <input type="hidden" name="editval[d3_cfg_mod__oxactive]" value="0">
                    <input type="checkbox"
                           class="editinput"
                           name="editval[d3_cfg_mod__oxactive]"
                           value="1"
                           title="[{oxmultilang ident="D3DYN_HEIDELPAY_ACTIVE"}]"
                           [{if $edit->d3_cfg_mod__oxactive->value == 1}]checked[{/if}]>
                </td>
            </tr>
            <tr>
                <td class="edittext">
                    [{oxmultilang ident="D3DYN_HEIDELPAY_TESTMOD_ACTIVE"}]
                </td>
                <td class="edittext">
                    [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_TESTMOD_ACTIVE"}]
                    <input type="hidden" name="value[d3_cfg_mod__d3heidelpay_blTestmode]" value="0" [{$sDisableTestModus}]>
                    <input type="checkbox"
                           class="editinput"
                           name="value[d3_cfg_mod__d3heidelpay_blTestmode]"
                           value="1"
                           title="[{oxmultilang ident="D3DYN_HEIDELPAY_TESTMOD_ACTIVE"}]"
                           [{if $edit->getValue('d3heidelpay_blTestmode') == 1}]checked[{/if}] [{$sDisableTestModus}]>
                    <br><br>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <fieldset title="[{oxmultilang ident="D3DYN_HEIDELPAY_LOGIN_AND_CHANNEL_HEAD"}]">
                        <legend><b>[{oxmultilang ident="D3DYN_HEIDELPAY_LOGIN_AND_CHANNEL_HEAD"}]</b>[{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_LOGIN_AND_CHANNEL_HEAD"}]</legend>
                        <table cellspacing="5" cellpadding="0" border="0" width="100%">
                            <tr>
                                <td class="edittext">
                                    [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_SECURITYSENDER"}]
                                </td>
                                <td class="edittext">
                                    [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_PARAM_SECURITYSENDER"}]
                                    <input type="text"
                                           class="editinput"
                                           name="value[d3_cfg_mod__d3heidelpay_sSecuritySender]"
                                           id="d3_cfg_mod__d3heidelpay_sSecuritySender"
                                           value="[{$edit->getValue('d3heidelpay_sSecuritySender')}]"
                                           title="[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_SECURITYSENDER"}]"
                                           style="width:220px;">
                                </td>
                            </tr>
                            <tr>
                                <td class="edittext">
                                    [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_USERID"}]
                                </td>
                                <td class="edittext">
                                    [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_PARAM_USERID"}]
                                    <input type="text"
                                           class="editinput"
                                           name="value[d3_cfg_mod__d3heidelpay_sUserID]"
                                           id="d3_cfg_mod__d3heidelpay_sUserID"
                                           value="[{$edit->getValue('d3heidelpay_sUserID')}]"
                                           title="[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_USERID"}]"
                                           style="width:220px;">
                                </td>
                            </tr>
                            <tr>
                                <td class="edittext">
                                    [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_PASSWORD"}]
                                </td>
                                <td class="edittext">
                                    [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_PARAM_PASSWORD"}]
                                    <input type="text"
                                           class="editinput"
                                           name="value[d3_cfg_mod__d3heidelpay_sPassword]"
                                           id="d3_cfg_mod__d3heidelpay_sPassword"
                                           value="[{$edit->getValue('d3heidelpay_sPassword')}]"
                                           title="[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_PASSWORD"}]"
                                           style="width:220px;">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="groupExp">
                                        <div>
                                            <a href="#" onclick="_groupExp(this);return false;"
                                               class="rc"><b>[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_CHANNEL_HEADER"}]</b></a>
                                            <dl>
                                                <dd>
                                                <table cellspacing="2" cellpadding="0" border="0" width="100%">
                                                    <tr>
                                                        <td class="edittext">
                                                            [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_CHANNEL_STANDARD"}]
                                                        </td>
                                                        <td class="edittext">
                                                            [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_PARAM_CHANNEL_STANDARD"}]
                                                            <input type="text"
                                                                   class="editinput"
                                                                   name="value[d3_cfg_mod__d3heidelpay_sChannel]"
                                                                   id="d3_cfg_mod__d3heidelpay_sChannel"
                                                                   value="[{$edit->getValue('d3heidelpay_sChannel')}]"
                                                                   title="[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_CHANNEL_STANDARD"}]"
                                                                   style="width:220px;">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2"><hr></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="edittext">
                                                            [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_CHANNEL_SOFORT"}]
                                                        </td>
                                                        <td class="edittext">
                                                            [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_PARAM_CHANNEL_SOFORT"}]
                                                            <input type="text"
                                                                   class="editinput"
                                                                   style="width:220px;"
                                                                   name="value[d3_cfg_mod__d3heidelpay_sChannel__sofort]"
                                                                   title="[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_CHANNEL_SOFORT"}]"
                                                                   value="[{$edit->getValue('d3heidelpay_sChannel__sofort')}]">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="edittext [{$blBasicRestriction}]">
                                                            [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_CHANNEL_EPS"}]
                                                        </td>
                                                        <td class="edittext [{$blBasicRestriction}]">
                                                            [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_PARAM_CHANNEL_EPS"}]
                                                            <input type="text"
                                                                   class="editinput"
                                                                   style="width:220px;"
                                                                   name="value[d3_cfg_mod__d3heidelpay_sChannel__eps]"
                                                                   title="[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_CHANNEL_EPS"}]"
                                                                   value="[{$edit->getValue('d3heidelpay_sChannel__eps')}]" [{$blBasicRestriction}]>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="edittext [{$blBasicRestriction}]">
                                                            [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_CHANNEL_GIROPAY"}]
                                                        </td>
                                                        <td class="edittext [{$blBasicRestriction}]">
                                                            [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_PARAM_CHANNEL_GIROPAY"}]
                                                            <input type="text"
                                                                   class="editinput"
                                                                   style="width:220px;"
                                                                   name="value[d3_cfg_mod__d3heidelpay_sChannel__giro]"
                                                                   title="[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_CHANNEL_GIROPAY"}]"
                                                                   value="[{$edit->getValue('d3heidelpay_sChannel__giro')}]" [{$blBasicRestriction}]>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="edittext [{$blBasicRestriction}]">
                                                            [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_CHANNEL_IDEAL"}]
                                                        </td>
                                                        <td class="edittext [{$blBasicRestriction}]">
                                                            [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_PARAM_CHANNEL_IDEAL"}]
                                                            <input type="text"
                                                                   class="editinput"
                                                                   style="width:220px;"
                                                                   name="value[d3_cfg_mod__d3heidelpay_sChannel__ideal]"
                                                                   title="[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_CHANNEL_IDEAL"}]"
                                                                   value="[{$edit->getValue('d3heidelpay_sChannel__ideal')}]" [{$blBasicRestriction}]>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        [{*
                                                        <td class="edittext [{$blBasicRestriction}]">
                                                                [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_CHANNEL_POSTFINANCE"}]
                                                            </td>
                                                            <td class="edittext [{$blBasicRestriction}]">
                                                            [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_PARAM_CHANNEL_POSTFINANCE"}]
                                                                <input type="text"
                                                                       class="editinput"
                                                                       style="width:220px;"
                                                                       name="value[d3_cfg_mod__d3heidelpay_sChannel__postfinance]"
                                                                       value="[{$edit->getValue('d3heidelpay_sChannel__postfinance')}]" [{$blBasicRestriction}]>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                        *}]
                                                        <td class="edittext">
                                                            [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_CHANNEL_BILLSAFE"}]
                                                        </td>
                                                        <td class="edittext">
                                                            [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_PARAM_CHANNEL_BILLSAFE"}]
                                                            <input type="text"
                                                                   class="editinput"
                                                                   style="width:220px;"
                                                                   name="value[d3_cfg_mod__d3heidelpay_sChannel__billsafe]"
                                                                   title="[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_CHANNEL_BILLSAFE"}]"
                                                                   value="[{$edit->getValue('d3heidelpay_sChannel__billsafe')}]">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="edittext [{$blBasicRestriction}]">
                                                            [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_CHANNEL_ASSUREDINVOICE"}]
                                                        </td>
                                                        <td class="edittext [{$blBasicRestriction}]">
                                                            [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_PARAM_CHANNEL_ASSUREDINVOICE"}]
                                                            <input type="text"
                                                                   class="editinput"
                                                                   style="width:220px;"
                                                                   name="value[d3_cfg_mod__d3heidelpay_sChannel__assuredinv]"
                                                                   title="[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_CHANNEL_ASSUREDINVOICE"}]"
                                                                   value="[{$edit->getValue('d3heidelpay_sChannel__assuredinv')}]" [{$blBasicRestriction}]>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="edittext [{$blBasicRestriction}]">
                                                            [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_CHANNEL_ASSUREDDIRECTDEBIT"}]
                                                        </td>
                                                        <td class="edittext [{$blBasicRestriction}]">
                                                            [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_PARAM_CHANNEL_ASSUREDDIRECTDEBIT"}]
                                                            <input type="text"
                                                                   class="editinput"
                                                                   style="width:220px;"
                                                                   name="value[d3_cfg_mod__d3heidelpay_sChannel__assureddirectdebit]"
                                                                   title="[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_CHANNEL_ASSUREDDIRECTDEBIT"}]"
                                                                   value="[{$edit->getValue('d3heidelpay_sChannel__assureddirectdebit')}]" [{$blBasicRestriction}]>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="edittext [{$blBasicRestriction}]">
                                                            [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_CHANNEL_PRZELEWY24"}]
                                                        </td>
                                                        <td class="edittext [{$blBasicRestriction}]">
                                                            [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_PARAM_CHANNEL_PRZELEWY24"}]
                                                            <input type="text"
                                                                   class="editinput"
                                                                   style="width:220px;"
                                                                   name="value[d3_cfg_mod__d3heidelpay_sChannel__przelewy24]"
                                                                   title="[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_CHANNEL_PRZELEWY24"}]"
                                                                   value="[{$edit->getValue('d3heidelpay_sChannel__przelewy24')}]" [{$blBasicRestriction}]>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="edittext">
                                                            [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_CHANNEL_PAYPAL"}]
                                                        </td>
                                                        <td class="edittext">
                                                            [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_PARAM_CHANNEL_PAYPAL"}]
                                                            <input type="text"
                                                                   class="editinput"
                                                                   style="width:220px;"
                                                                   name="value[d3_cfg_mod__d3heidelpay_sChannel__paypal]"
                                                                   title="[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_CHANNEL_PAYPAL"}]"
                                                                   value="[{$edit->getValue('d3heidelpay_sChannel__paypal')}]">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="edittext [{$blBasicRestriction}]">
                                                            [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_CHANNEL_MASTERPASS"}]
                                                        </td>
                                                        <td class="edittext [{$blBasicRestriction}]">
                                                            [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_PARAM_CHANNEL_MASTERPASS"}]
                                                            <input type="text"
                                                                   class="editinput"
                                                                   style="width:220px;"
                                                                   name="value[d3_cfg_mod__d3heidelpay_sChannel__masterpass]"
                                                                   title="[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_CHANNEL_MASTERPASS"}]"
                                                                   value="[{$edit->getValue('d3heidelpay_sChannel__masterpass')}]" [{$blBasicRestriction}]>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="edittext [{$blBasicRestriction}]">
                                                            [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_CHANNEL_EASYCREDIT"}]
                                                        </td>
                                                        <td class="edittext [{$blBasicRestriction}]">
                                                            [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_PARAM_CHANNEL_EASYCREDIT"}]
                                                            <input type="text"
                                                                   class="editinput"
                                                                   style="width:220px;"
                                                                   name="value[d3_cfg_mod__d3heidelpay_sChannel__easycredit]"
                                                                   title="[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_CHANNEL_EASYCREDIT"}]"
                                                                   value="[{$edit->getValue('d3heidelpay_sChannel__easycredit')}]" [{$blBasicRestriction}]>
                                                        </td>
                                                    </tr>
                                                </table>
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                </td>
            </tr>
            <tr><td colspan="2"><br></td></tr>
            <tr>
                <td colspan="2">
                    <div class="groupExp">
                        <div>
                            <a href="#" onclick="_groupExp(this);return false;"
                               class="rc"><b>[{oxmultilang ident="D3DYN_HEIDELPAY_EXTENDED_SETTINGS"}]</b></a>
                            <dl>
                                <dd>
                                    <table cellspacing="5" cellpadding="0" border="0" width="100%">
                            <tr>
                                <td class="edittext">
                                    [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE"}]
                                </td>
                                <td class="edittext">
                                    [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE"}]
                                    <select class="edittext" name="value[d3_cfg_mod__d3heidelpay_sTransType]"
                                            title="[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE"}]">
                                        <option value="auth">[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE_DIRECT"}]</option>
                                        <option value="preauth"
                                                [{if ($edit->getValue("d3heidelpay_sTransType") == "preauth")}]selected[{/if}]>
                                            [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE_RESERVE"}]
                                        </option>
                                        <option value="auth_but_foreign_preauth"
                                                [{if ($edit->getValue("d3heidelpay_sTransType") == "auth_but_foreign_preauth")}]selected[{/if}]>
                                            [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE_FOREIGNRESERVE"}]
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="edittext">
                                    <label for="d3_cfg_mod__d3heidelpay_blCardsUseRG">
                                        [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_CARDS_USE_RG"}]
                                    </label>
                                </td>
                                <td class="edittext">
                                    [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_PARAM_CARDS_USE_RG"}]
                                    <input type="hidden" name="value[d3_cfg_mod__d3heidelpay_blCardsUseRG]" value="0">
                                    <input type="checkbox"
                                           class="editinput"
                                           id="d3_cfg_mod__d3heidelpay_blCardsUseRG"
                                           name="value[d3_cfg_mod__d3heidelpay_blCardsUseRG]"
                                           value="1"
                                           [{if $edit->getValue('d3heidelpay_blCardsUseRG') == 1}]checked[{/if}]>
                                </td>
                            </tr>
                            <tr>
                                <td class="edittext">
                                    [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE_DIRECTDEBIT"}]
                                </td>
                                <td class="edittext">
                                    [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE_DIRECTDEBIT"}]
                                    <select class="edittext" name="value[d3_cfg_mod__d3heidelpay_sDDTransType]"
                                            title="[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE"}]">
                                        <option value="auth">[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE_DIRECT"}]</option>
                                        <option value="preauth"
                                                [{if ($edit->getValue("d3heidelpay_sDDTransType") == "preauth")}]selected[{/if}]>
                                            [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE_RESERVE"}]
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="edittext">
                                    [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE_PAYPAL"}]
                                </td>
                                <td class="edittext">
                                    [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE_PAYPAL"}]
                                    <select class="edittext" name="value[d3_cfg_mod__d3heidelpay_sVATransType]"
                                            title="[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE_PAYPAL"}]">
                                        <option value="auth">[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE_DIRECT"}]</option>
                                        <option value="preauth"
                                                [{if ($edit->getValue("d3heidelpay_sVATransType") == "preauth")}]selected[{/if}]>
                                            [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE_RESERVE"}]
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="edittext [{$blBasicRestriction}]">
                                    [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE_MASTERPASS"}]
                                </td>
                                <td class="edittext [{$blBasicRestriction}]">
                                    [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE_MASTERPASS"}]
                                    <select class="edittext" name="value[d3_cfg_mod__d3heidelpay_sWTTransType]"
                                            title="[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE_MASTERPASS"}]" [{$blBasicRestriction}]>
                                        <option value="auth">[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE_DIRECT"}]</option>
                                        <option value="preauth"
                                                [{if ($edit->getValue("d3heidelpay_sWTTransType") == "preauth")}]selected[{/if}]>
                                            [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE_RESERVE"}]
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="edittext">
                                    [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_STOREDDATA"}]
                                </td>
                                <td class="edittext">
                                    [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_PARAM_STOREDDATA"}]
                                    <input type="hidden" name="value[d3_cfg_mod__d3heidelpay_blShowStoredHPData]" value="0">
                                    <input type="checkbox"
                                           class="editinput"
                                           name="value[d3_cfg_mod__d3heidelpay_blShowStoredHPData]"
                                           value="1"
                                           title="[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_STOREDDATA"}]"
                                           [{if ($edit->getValue('d3heidelpay_blShowStoredHPData'))}]checked[{/if}]>
                                </td>
                            </tr>
                            <tr>
                                <td class="edittext" colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="edittext">
                                    [{oxmultilang ident="D3DYN_HEIDELPAY_ORDER_EXECUTE_POST_FIELDS"}]
                                </td>
                                <td class="edittext" style="vertical-align: top;">
                                    [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_ORDER_EXECUTE_POST_FIELDS"}]
                                    <textarea rows="5" cols="40"
                                              name="value[d3_cfg_mod__d3heidelpay_orderExecutePostFields]"
                                              title="[{oxmultilang ident="D3DYN_HEIDELPAY_ORDER_EXECUTE_POST_FIELDS"}]">[{$edit->getValue('d3_cfg_mod__d3heidelpay_orderExecutePostFields')}]</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="edittext">
                                    [{oxmultilang ident="D3DYN_HEIDELPAY_ADDITIONAL_URL_PARAMETER"}]
                                </td>
                                <td class="edittext" style="vertical-align: top;">
                                    [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_ADDITIONAL_URL_PARAMETER"}]
                                    <textarea rows="5" cols="40"
                                              name="value[d3_cfg_mod__d3heidelpay_additionalUrlParameter]"
                                              title="[{oxmultilang ident="D3DYN_HEIDELPAY_ADDITIONAL_URL_PARAMETER"}]">[{$edit->getValue('d3_cfg_mod__d3heidelpay_additionalUrlParameter')}]</textarea>
                                </td>
                            </tr>
                                        <tr>
                                            <td class="edittext">
                                                [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_CURLTIMEOUT"}]
                                            </td>
                                            <td class="edittext">
                                                [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_PARAM_CURLTIMEOUTSEK"}]
                                                [{assign var="iCurlTimeOut" value=$edit->getValue('d3heidelpay_iCurlTimeOut')}]
                                                <input type="text"
                                                       class="editinput"
                                                       style="width:100px;"
                                                       name="value[d3_cfg_mod__d3heidelpay_iCurlTimeOut]"
                                                       title="[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_CURLTIMEOUT"}]"
                                                       value="[{$iCurlTimeOut|default:"50"}]"> [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_CURLTIMEOUTSEK"}]
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="edittext">
                                                [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_CSSPATH"}]
                                            </td>
                                            <td class="edittext">
                                                [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_PARAM_CSSPATH"}]

                                                [{assign var='cssClass' value='fa-times-circle fa-17x fa-d3color-red'}]
                                                [{if $oHeidelpayViewConfig->existIFrameCSSFile()}]
                                                    [{assign var='cssClass' value='fa-check-circle fa-17x fa-d3color-green'}]
                                                [{/if}]
                                                <label class="fa [{$cssClass}]"></label>
                                                <a class="editinput" href="[{$oHeidelpayViewConfig->getIFrameCSSFileURL()}]" target="d3heidelpaycssfile">[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_CSSPATH_LINK"}]</a>
                                            </td>
                                        </tr>
                        </table>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </td>
            </tr>
            <tr><td colspan="2"><br></td></tr>
            <tr>
                <td colspan="2">
                    <div class="groupExp">
                        <div>
                            <a href="#" onclick="_groupExp(this);return false;"
                               class="rc"><b>[{oxmultilang ident="D3DYN_HEIDELPAY_LOG_AND_SECURITY"}]</b></a>
                            <dl>
                                <dd>
                                    <table cellspacing="5" cellpadding="0" border="0" width="100%">
                                        <tr>
                                            <td class="edittext">
                                                [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_SHOWERRORTEXTS"}]
                                            </td>
                                            <td class="edittext">
                                                [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_PARAM_SHOWERRORTEXTS"}]
                                                <input type="hidden"
                                                       name="value[d3_cfg_mod__d3heidelpay_blServiceErrors]" value="0">
                                                <input type="checkbox"
                                                       class="editinput"
                                                       name="value[d3_cfg_mod__d3heidelpay_blServiceErrors]"
                                                       value="1"
                                                       title="[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_SHOWERRORTEXTS"}]"
                                                       [{if ($edit->getValue('d3heidelpay_blServiceErrors'))}]checked[{/if}]>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="edittext">
                                                [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_INTERNALLOG"}]
                                            </td>
                                            <td class="edittext">
                                                [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_PARAM_INTERNALLOG"}]
                                                <select name="loglevel" class="edittext"
                                                        title="[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_INTERNALLOG"}]">
                                                    <option value="userdefined">[{oxmultilang ident="D3_CFG_LOG_TYPE_USERDEFINED"}]</option>
                                                    <option value="error" [{if $oView->getLogStatus('error')}] selected[{/if}]>[{oxmultilang ident="D3_CFG_LOG_TYPE_ERROR"}]</option>
                                                    <option value="warning" [{if $oView->getLogStatus('warning')}] selected[{/if}]>[{oxmultilang ident="D3_CFG_LOG_TYPE_WARNING"}]</option>
                                                    <option value="notice" [{if $oView->getLogStatus('notice')}] selected[{/if}]>[{oxmultilang ident="D3_CFG_LOG_TYPE_NOTICE"}]</option>
                                                    <option value="info" [{if $oView->getLogStatus('info')}] selected[{/if}]>[{oxmultilang ident="D3_CFG_LOG_TYPE_INFO"}]</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="edittext">
                                                [{oxmultilang ident="D3HEIDELPAY_DIFFERENCE_IN_ORDER_ERRRORMAIL"}]
                                            </td>
                                            <td class="edittext">
                                                [{oxinputhelp ident="HELP_D3HEIDELPAY_DIFFERENCE_IN_ORDER_ERRRORMAIL"}]
                                                [{assign var='statusemail' value=$edit->getValue('d3heidelpay_oxtransstatuserrormail')}]
                                                [{if false == $statusemail}]
                                                    [{assign var='statusemail' value=$actshopobj->oxshops__oxowneremail->value}]
                                                [{/if}]
                                                <input type="text"
                                                       class="editinput"
                                                       style="width:220px;"
                                                       name="value[d3_cfg_mod__d3heidelpay_oxtransstatuserrormail]"
                                                       title="[{oxmultilang ident="D3HEIDELPAY_DIFFERENCE_IN_ORDER_ERRRORMAIL"}]"
                                                       value="[{$statusemail}]">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="edittext">
                                                [{oxmultilang ident="D3HEIDELPAY_DIFFERENCE_IN_ORDER_ERRRORSTATUS"}]
                                            </td>
                                            <td class="edittext">
                                                [{oxinputhelp ident="HELP_D3HEIDELPAY_DIFFERENCE_IN_ORDER_ERRRORSTATUS"}]
                                                [{assign var='transstatuserror' value=$edit->getValue('d3heidelpay_oxtransstatuserror')}]
                                                [{if false == $transstatuserror}]
                                                    [{assign var='transstatuserror' value='ERROR'}]
                                                [{/if}]
                                                <input type="text"
                                                       class="editinput"
                                                       style="width:220px;"
                                                       name="value[d3_cfg_mod__d3heidelpay_oxtransstatuserror]"
                                                       title="[{oxmultilang ident="D3HEIDELPAY_DIFFERENCE_IN_ORDER_ERRRORSTATUS"}]"
                                                       value="[{$transstatuserror}]">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="edittext">
                                                [{oxmultilang ident="D3HEIDELPAY_CARDTYPE_TIMEOUT"}]
                                            </td>
                                            <td class="edittext">
                                                [{oxinputhelp ident="HELP_D3HEIDELPAY_CARDTYPE_TIMEOUT"}]
                                                [{assign var='cardtypetimeout' value=$edit->getValue('d3heidelpay_cardtypetimeout')}]
                                                [{if false == $cardtypetimeout}]
                                                    [{assign var='cardtypetimeout' value='600'}]
                                                [{/if}]
                                                <input type="number"
                                                       class="editinput"
                                                       style="width:120px;"
                                                       name="value[d3_cfg_mod__d3heidelpay_cardtypetimeout]"
                                                       title="[{oxmultilang ident="D3HEIDELPAY_CARDTYPE_TIMEOUT"}]"
                                                       value="[{$cardtypetimeout}]">
                                                [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_CURLTIMEOUTSEK"}]
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="edittext">
                                                [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_ALLOWMULTIPLELANGUAGES"}]
                                            </td>
                                            <td class="edittext">
                                                [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_PARAM_ALLOWMULTIPLELANGUAGES"}]
                                                <input type="hidden"
                                                       name="config[bool][d3hp_allowMultipleLanguages]" value="0">
                                                <input type="checkbox"
                                                       class="editinput"
                                                       name="config[bool][d3hp_allowMultipleLanguages]"
                                                       value="1"
                                                       title="[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_ALLOWMULTIPLELANGUAGES"}]"
                                                       [{if ($oView->getShopConfigVar('d3hp_allowMultipleLanguages'))}]checked[{/if}]>
                                            </td>
                                        </tr>
                                    </table>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </td>
            </tr>
            <tr><td colspan="2"><br></td></tr>
            <tr>
                <td colspan="2">
                    <div class="groupExp">
                        <div>
                            <a href="#" onclick="_groupExp(this);return false;" class="rc"><b>[{oxmultilang ident="D3HEIDELPAY_SETTINGS_FOR_IDEAL_AND_P24_CRONJOB"}]</b></a>
                            <dl>
                                <dt>
                                    <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                        <tr>
                                            <td class="edittext">
                                                [{oxmultilang ident="D3HEIDELPAY_sD3HpHFOrderPendingTime"}]
                                            </td>
                                            <td class="edittext">
                                                [{oxinputhelp ident="HELP_D3HEIDELPAY_sD3HpHFOrderPendingTime"}]
                                                <input size="5" name="value[d3_cfg_mod__sD3HpHFOrderPendingTime]"
                                                       value="[{$edit->getValue('d3_cfg_mod__sD3HpHFOrderPendingTime')}]"
                                                       title="[{oxmultilang ident="D3HEIDELPAY_sD3HpHFOrderPendingTime"}]"
                                                       type="text">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="edittext">
                                                [{oxmultilang ident="D3HEIDELPAY_sD3HpHFOrderLimit"}]
                                            </td>
                                            <td class="edittext">
                                                [{oxinputhelp ident="HELP_D3HEIDELPAY_sD3HpHFOrderLimit"}]
                                                <input size="5" name="value[d3_cfg_mod__sD3HpHFOrderLimit]"
                                                       value="[{$edit->getValue('d3_cfg_mod__sD3HpHFOrderLimit')}]"
                                                       title="[{oxmultilang ident="D3HEIDELPAY_sD3HpHFOrderLimit"}]"
                                                       type="text">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="edittext">
                                                [{oxmultilang ident="D3HEIDELPAY_sD3HpHFOrderCancelType"}]
                                            </td>
                                            <td class="edittext">
                                                [{oxinputhelp ident="HELP_D3HEIDELPAY_sD3HpHFOrderCancelType"}]
                                                [{assign var='currentCancelType' value=$edit->getValue('d3_cfg_mod__sD3HpHFOrderCancelType')}]
                                                <select name="value[d3_cfg_mod__sD3HpHFOrderCancelType]" title="[{oxmultilang ident="D3HEIDELPAY_sD3HpHFOrderCancelType"}]">
                                                    <option value="PLEASE_CHOOSE"[{if $currentCancelType == ''}] selected[{/if}]>[{oxmultilang ident="D3HEIDELPAY_sD3HpHFOrderCancelType_PLEASE_CHOOSE"}]</option>
                                                    <option value="CANCEL_ORDER"[{if $currentCancelType === 'CANCEL_ORDER'}] selected[{/if}]>[{oxmultilang ident="D3HEIDELPAY_sD3HpHFOrderCancelType_CANCEL_ORDER"}]</option>
                                                    <option value="DELETE_ORDER"[{if $currentCancelType === 'DELETE_ORDER'}] selected[{/if}]>[{oxmultilang ident="D3HEIDELPAY_sD3HpHFOrderCancelType_DELETE_ORDER"}]</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="edittext">
                                                [{oxmultilang ident="D3HEIDELPAY_blD3HpHFSetZeroOrderNumber"}]
                                            </td>
                                            <td class="edittext">
                                                [{oxinputhelp ident="HELP_D3HEIDELPAY_blD3HpHFSetZeroOrderNumber"}]
                                                <input name="value[d3_cfg_mod__blD3HpHFSetZeroOrderNumber]" value="0" type="hidden">
                                                <input name="value[d3_cfg_mod__blD3HpHFSetZeroOrderNumber]" value="1" type="checkbox"[{if $edit->getValue('d3_cfg_mod__blD3HpHFSetZeroOrderNumber')}] checked[{/if}] title="[{oxmultilang ident="D3HEIDELPAY_blD3HpHFSetZeroOrderNumber"}]">

                                            </td>
                                        </tr>
                                    </table>
                                </dt>
                            </dl>
                        </div>
                    </div>
                </td>
            </tr>
            <tr><td colspan="2"><br></td></tr>
            <tr>
                <td colspan="2" style="white-space:normal">
                    <div class="groupExp">
                        <div>
                            <a href="#" onclick="_groupExp(this);return false;" class="rc"><b>[{oxmultilang ident="D3DYN_HEIDELPAY_TESTVALUES_HEAD"}]</b> </a>[{oxinputhelp ident="D3DYN_HEIDELPAY_TESTVALUES"}]
                            <dl>
                                <dt>
                                    <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                        <tr>
                                            <td class="edittext">
                                                [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_TESTSERVERTYPE"}]
                                            </td>
                                            <td class="edittext">
                                                <select name="value[d3_cfg_mod__d3heidelpay_sTestServerTyp]" class="editinput" title="[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_TESTSERVERTYPE"}]">
                                                    <option [{if $edit->getValue('d3heidelpay_sTestServerTyp') == "CONNECTOR_TEST"}]selected[{/if}]>CONNECTOR_TEST</option>
                                                    <option [{if $edit->getValue('d3heidelpay_sTestServerTyp') == "INTEGRATOR_TEST"}]selected[{/if}]>INTEGRATOR_TEST</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="edittext">
                                                [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_TESTMOD_ERRORCODE"}]
                                            </td>
                                            <td class="edittext">
                                                <input type="text"
                                                       class="editinput"
                                                       style="width:100px;"
                                                       name="value[d3_cfg_mod__d3heidelpay_sTestErrorCode]"
                                                       title="[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_TESTMOD_ERRORCODE"}]"
                                                       value="[{$edit->getValue('d3heidelpay_sTestErrorCode')}]">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="edittext">
                                                [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_TESTMOD_RETURNCODE"}]
                                            </td>
                                            <td class="edittext">
                                                <input type="text"
                                                       class="editinput"
                                                       style="width:100px;"
                                                       name="value[d3_cfg_mod__d3heidelpay_sTestReturnCode]"
                                                       title="[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_TESTMOD_RETURNCODE"}]"
                                                       value="[{$edit->getValue('d3heidelpay_sTestReturnCode')}]">
                                            </td>
                                        </tr>
                                    </table>
                                </dt>
                            </dl>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="edittext"></td>
                <td class="edittext">
                    <br>
                    <input type="submit"
                           class="edittext"
                           name="save"
                           value="[{oxmultilang ident="GENERAL_SAVE"}]"
                           onClick="document.myedit.fnc.value='save'" [{$readonly}]>
                </td>
            </tr>
        </table>
    </form>
</td>

<td width="2%">&nbsp;</td>
<!-- Anfang rechte Seite -->
<td valign="top" class="edittext" width="48%">
    <fieldset title="[{oxmultilang ident="D3DYN_HEIDELPAY_ACTIVEPAYMENTS"}]">
        <legend>[{oxmultilang ident="D3DYN_HEIDELPAY_ACTIVEPAYMENTS"}]</legend>

        <div>[{oxmultilang ident="D3DYN_HEIDELPAY_CURRENTPAYMENTS"}]</div>

        [{foreach from=$aAssignedOxpayments item='oPayment' key='sPaymentId' name="existpaylist"}]
            <form name="existpaylist[{$smarty.foreach.existpaylist.iteration}]"
              id="paylist[{$smarty.foreach.existpaylist.iteration}]"
              action="[{$oViewConf->getSelfLink()}]"
              method="post">
                <table cellspacing="5" cellpadding="0" border="0" width="100%">
                    <tr>
                        <td class="edittext">
                            [{$oViewConf->getHiddenSid()}]
                            <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
                            <input type="hidden" name="fnc" value="save">
                            <input type="hidden" name="oxid" value="[{$oxid}]">
                            <input type="hidden" name="editval[d3_cfg_mod__oxid]" value="[{$oxid}]">

                            [{$oPayment->oxpayments__oxdesc->value}]
                        </td>
                        <td class="edittext" align="right">
                            [{oxmultilang ident="D3DYN_HEIDELPAY_PAYTYPE"}]&nbsp;

                            <select class="edittext"
                                    name="changepayment[[{$oPayment->getId()}]]"
                                    title="[{oxmultilang ident="D3DYN_HEIDELPAY_PAYTYPE"}]"
                                    onChange="document.existpaylist[{$smarty.foreach.existpaylist.iteration}].submit();">
                                <option value="">--</option>
                                [{foreach from=$aHeidelpayPaymentList item="oHeidelPayment"}]
                                    <option value="[{$oHeidelPayment}]"
                                        [{if $oHeidelPayment == $oPayment->sHeidelPaymentClass}]selected[{/if}]>
                                        [{oxmultilang ident=$oHeidelPayment|strtolower}]
                                    </option>
                                [{/foreach}]
                            </select>
                        </td>
                    </tr>
                </table>
            </form>
        [{foreachelse}]
            <table cellspacing="5" cellpadding="0" border="0" width="100%">
                <tr>
                    <td class="edittext">
                        <div style="color:red; font-weight: bold;">[{oxmultilang ident="D3DYN_HEIDELPAY_NOACTIVEPAYMENTS"}]</div>
                    </td>
                </tr>
            </table>
        [{/foreach}]
    </fieldset>
    <br>
    <fieldset title="[{oxmultilang ident="D3DYN_HEIDELPAY_NOCURRENTPAYMENT"}]">
        <legend>[{oxmultilang ident="D3DYN_HEIDELPAY_NOCURRENTPAYMENT"}]</legend>

        [{foreach from=$aFreeOxpayments item='oPayment' key='sPaymentId' name="paylist"}]
            <form name="paylist[{$smarty.foreach.paylist.iteration}]"
                  id="paylist[{$smarty.foreach.paylist.iteration}]"
                  action="[{$oViewConf->getSelfLink()}]"
                  method="post">
                <table cellspacing="5" cellpadding="0" border="0" width="100%">
                    <tr>
                        <td class="edittext">
                            [{$oViewConf->getHiddenSid()}]
                            <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
                            <input type="hidden" name="fnc" value="save">
                            <input type="hidden" name="oxid" value="[{$oxid}]">
                            <input type="hidden" name="editval[d3_cfg_mod__oxid]" value="[{$oxid}]">

                            <input type="hidden" name="oxpaymentid" value="[{$oPayment->oxpayments__oxid->value}]">
                            [{$oPayment->oxpayments__oxdesc->value}]
                        </td>
                        <td class="edittext" align="right" nowrap>
                        [{oxmultilang ident="D3DYN_HEIDELPAY_PAYTYPE"}]&nbsp;
                            <select class="edittext"
                                    name="changepayment[[{$oPayment->getId()}]]"
                                    title="[{oxmultilang ident="D3DYN_HEIDELPAY_PAYTYPE"}]"
                                    onChange="document.paylist[{$smarty.foreach.paylist.iteration}].submit();">
                                <option value="">--</option>
                                [{foreach from=$aHeidelpayPaymentList item="oHeidelPayment"}]
                                    <option value="[{$oHeidelPayment}]">[{oxmultilang ident=$oHeidelPayment|strtolower}]</option>
                                [{/foreach}]
                            </select>
                        </td>
                    </tr>
                 </table>
            </form>
        [{/foreach}]
    </fieldset>
</td>
</tr>
</table>

[{if $blRefreshList}]
    [{oxscript add="top.oxid.admin.updateList();"}]
[{/if}]

[{oxscript add='function _groupExp(el) {
    var _cur = el.parentNode;
    if (_cur.className == "exp") {
        _cur.className = "";
    } else {
        _cur.className = "exp";
    }
}'}]

[{include file="d3_cfg_mod_inc.tpl"}]
[{* NOTE: open div for oxids closing div ^^ *}]
<div>
    [{include file="bottomitem.tpl"}]



