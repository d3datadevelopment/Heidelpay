[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign box="list"}]

<script type="text/javascript">
    <!--
    window.onload = function ()
    {
        top.reloadEditFrame();
        [{if $updatelist == 1}]
        top.oxid.admin.updateList('[{$oxid}]');
        [{/if}]
    }
    //-->
</script>
[{assign var="where" value=$oView->getListFilter()}]
<div id="liste">
    <form name="search" id="search" action="[{$oViewConf->getSelfLink()}]" method="post">
        [{include file="_formparams.tpl" cl=$oViewConf->getActiveClassname() lstrt=$lstrt actedit=$actedit oxid=$oxid fnc="" language=$actlang editlanguage=$actlang}]
        [{if $blShowLangSwitch}]
            <label>
                [{oxmultilang ident="D3_CFG_MOD_LIST_SETTLANG"}]
                <select name="changelang" class="editinput" onChange="top.oxid.admin.changeLanguage();">
                    [{foreach from=$languages item="lang"}]
                        <option value="[{$lang->id}]" [{if $lang->selected}]SELECTED[{/if}]>[{$lang->name}]</option>
                    [{/foreach}]
                </select>
            </label>
        [{/if}]
        <table width="100%" cellspacing="0" cellpadding="0" border="0">
            <colgroup>
                <col width="3%">
                <col width="3%">
                <col width="30%">
                <col width="30%">
                <col width="3%">
            </colgroup>
[{*            <tr class="listitem">
                <td class="listfilter first" valign="top" align="right" colspan="2">
                    <div class="r1">
                        <div class="b1">&nbsp;</div>
                    </div>
                </td>
                <td class="listfilter" valign="top" align="left">
                    <div class="r1">
                        <div class="b1">
                            <input class="listedit" type="text" size="25" maxlength="128"
                                   name="title"
                                   value=""
                            >
                        </div>
                    </div>
                </td>
                <td class="listfilter" valign="top" nowrap="">
                    <div class="r1">
                        <div class="b1">
                            <input class="listedit" type="text" size="25" maxlength="128"
                                   name="where[oxshortdesc]"
                                   value=""
                            >
                        </div>
                    </div>
                </td>
                <td class="listfilter" valign="top" nowrap="" colspan="2">
                    <div class="r1">
                        <div class="b1">
                            <div class="find">
                                <input class="listedit" type="submit" name="submitit" value="Suchen">
                            </div>
                            <input class="listedit" type="text" size="25" maxlength="128"
                                   name="where[oxarticles][oxshortdesc]"
                                   value=""
                            >
                        </div>
                    </div>
                </td>
            </tr>*}]
            <tr class="listitem">
                <td class="listheader first" width="30" height="15" align="center">
                    <a href="Javascript:top.oxid.admin.setSorting(document.search, '', 'isActive', '[{$nextSorting.isActive}]');document.search.submit();" class="listheader" title="[{oxmultilang ident="GENERAL_ACTIVE"}]">A</a>
                </td>
                <td class="listheader" width="30" height="15" align="center">
                    <a href="Javascript:top.oxid.admin.setSorting(document.search, '', 'isTestConfig', '[{$nextSorting.isTestConfig}]');document.search.submit();" class="listheader" title="[{oxmultilang ident="D3HEIDELPAY_CONFIG_ISTESTCONFIG"}]">T</a>
                </td>
                <td class="listheader">
                    <a href="Javascript:top.oxid.admin.setSorting(document.search, '', 'title', '[{$nextSorting.title}]');document.search.submit();" class="listheader">[{oxmultilang ident="GENERAL_TITLE"}]</a>
                </td>
                <td class="listheader" height="15">
                    <a href="Javascript:top.oxid.admin.setSorting(document.search, '', 'heidelPayment', '[{$nextSorting.heidelPayment}]');document.search.submit();" class="listheader">[{oxmultilang ident="D3DYN_HEIDELPAY_PAYTYPE"}]</a>
                </td>
                <td class="listheader" colspan="2" height="15">
                    <a href="Javascript:top.oxid.admin.setSorting(document.search, '', 'channel', '[{$nextSorting.channel}]');document.search.submit();" class="listheader">[{oxmultilang ident="D3HEIDELPAY_CONFIG_CHANNEL"}]</a>
                </td>
            </tr>

            [{assign var='listclass' value="listitem"}]
            [{foreach from=$channels item="channel" key="identifier" name="channelList"}]
                [{if $identifier == $oxid}]
                    [{assign var='listclass' value="listitem4"}]
                [{/if}]
                [{assign var='channelId' value=$channel->getId()}]
                [{assign var='heidelPayment' value=$channel->getPaymentType()}]
                <tr id="row.[{$smarty.foreach.channelList.iteration}]">
                    <td class="[{$listclass}] [{if $channel->isActive()}] active[{/if}]" valign="top" height="15" title="[{oxmultilang ident="GENERAL_ACTIVE"}]">
                        <div class="listitemfloating">&nbsp;</div>
                    </td>
                    <td class="[{$listclass}] [{if $channel->isTestConfig()}] active[{/if}]" valign="top" height="15" title="[{oxmultilang ident="D3HEIDELPAY_CONFIG_ISTESTCONFIG"}]">
                        <div class="listitemfloating">&nbsp;</div>
                    </td>
                    <td class="[{$listclass}]">
                        <div class="listitemfloating">
                            <a href="Javascript:top.oxid.admin.editThis('[{$channelId}]');"
                               class="[{$listclass}]"
                            >[{$channel->getTitle()}]</a></div>
                    </td>
                    <td class="[{$listclass}]" height="15">
                        <div class="listitemfloating">
                            <a href="Javascript:top.oxid.admin.editThis('[{$channelId}]');"
                               class="[{$listclass}]"
                            >
                                [{oxmultilang ident=$heidelPayment|strtolower}]
                            </a>
                        </div>
                    </td>
                    <td class="[{$listclass}]" height="15">
                        <div class="listitemfloating">
                            [{$channel->getChannel()}]
                        </div>
                    </td>
                    <td class="[{$listclass}]">
                        <a href="Javascript:top.oxid.admin.deleteThis('[{$channelId}]');"
                           class="delete"
                           id="del.[{$smarty.foreach.channelList.iteration}]"
                           title=""
                        ></a>
                    </td>
                </tr>
                [{assign var='listclass' value="listitem"}]
            [{/foreach}]

            [{include file="pagenavisnippet.tpl" colspan="6"}]
        </table>
    </form>
</div>

[{include file="pagetabsnippet.tpl"}]

[{capture name="emptyCapture"}]
    <script type="text/javascript">
        [{capture name="d3JavaScript"}]
        if (parent.parent) {
            parent.parent.sShopTitle = "";
            parent.parent.sMenuItem = "Heidelpay";
            parent.parent.sMenuSubItem = "Channels verwalten";
            parent.parent.sWorkArea = "[{$_act}]";
            parent.parent.setTitle();
        }
        [{/capture}]
    </script>
[{/capture}]
[{oxscript add=$smarty.capture.d3JavaScript}]

[{include file="bottomitem.tpl"}]
