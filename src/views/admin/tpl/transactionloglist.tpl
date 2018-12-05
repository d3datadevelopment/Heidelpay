[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign box="list"}]
[{assign var="where" value=$oView->getListFilter()}]
[{assign var="sorting" value=$oView->getListSorting()}]

[{oxscript include="js/libs/jquery.min.js"}]
[{oxscript include="js/libs/jquery-ui.min.js"}]

[{if $readonly}]
    [{assign var="readonly" value="readonly disabled"}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]

<script type="text/javascript">
    <!--
    window.onload = function () {
        top.reloadEditFrame();
        [{if $updatelist == 1}]
        top.oxid.admin.updateList('[{$oxid}]');
        [{/if}]
    };
    //-->
</script>

<div id="liste">
    <form name="search" id="search" action="[{$oViewConf->getSelfLink()}]" method="post">
        [{include file="_formparams.tpl" cl=$oViewConf->getActiveClassname() lstrt=$lstrt actedit=$actedit oxid=$oxid fnc="" language=$actlang editlanguage=$actlang}]

        [{block name="D3_Heidelpay_controllers_admin_transactionloglist_items"}]
            <table border="0" class="d3hptransactions box" id="d3hptransactions">

                <tr>
                    <th colspan="2">
                        [{if $sorting.d3transactionlog.d3lognr == "asc"}][{assign var='logSorting' value='desc'}][{/if}]
                        <a href="Javascript:top.oxid.admin.setSorting( document.search, 'd3transactionlog', 'd3lognr', '[{$logSorting|default:"asc"}]');document.search.submit();"
                           class="listheader">LogNr</a>
                    </th>
                    <th>
                        [{if $sorting.d3transactionlog.d3action == "asc"}][{assign var='actionSorting' value='desc'}][{/if}]
                        <a href="Javascript:top.oxid.admin.setSorting( document.search, 'd3transactionlog', 'd3action', '[{$actionSorting|default:"asc"}]');document.search.submit();"
                           class="listheader">Typ</a>
                    </th>
                    <th>
                        [{if $sorting.d3transactionlog.d3transactionstatus == "asc"}][{assign var='statusSorting' value='desc'}][{/if}]
                        <a href="Javascript:top.oxid.admin.setSorting( document.search, 'd3transactionlog', 'd3transactionstatus', '[{$statusSorting|default:"asc"}]');document.search.submit();"
                           class="listheader">Ergebnis</a>
                    </th>
                    <th>Bestellnr.</th>
                    <th>Zeitstempel</th>
                    <th>Credit/Debit</th>
                    <th>Meth.Typ</th>
                    <th>Txn-ID</th>
                    <th>Short ID</th>
                    <th>Session</th>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td>
                        <input type="hidden" id="d3action" name="where[d3transactionlog][d3action]"
                               value="[{$where.d3transactionlog.d3action}]">
                        <a href="#"
                           style="display: inline-block;[{if $where.d3transactionlog.d3action == 'response'}] background-color:lightblue; [{/if}]"
                           onclick="document.getElementById('d3action').value = '[{if $where.d3transactionlog.d3action != 'response'}]response[{/if}]'; document.search.submit(); return false;"
                           class="d3hpopen">
                            <i class="fa fa-sign-in d3fa-17x" aria-hidden="true"></i>
                        </a>&nbsp;
                        <a href="#"
                           style="display: inline-block;[{if $where.d3transactionlog.d3action == 'request'}] background-color:#ffE080; [{/if}]"
                           onclick="document.getElementById('d3action').value = '[{if $where.d3transactionlog.d3action != 'request'}]request[{/if}]'; document.search.submit(); return false;"
                           class="d3hpopen">
                            <i class="fa fa-sign-out d3fa-17x" aria-hidden="true"></i>
                        </a>
                    </td>
                    <td>
                        <input type="hidden" id="processing_result" name="where[d3transactiondata][processing_result]"
                               value="[{$where.d3transactiondata.processing_result}]">
                        <a href="#" style="display: inline-block;"
                           onclick="document.getElementById('processing_result').value = '[{if $where.d3transactiondata.processing_result != 'ACK'}]ACK[{/if}]'; document.search.submit(); return false;"
                           class="d3hpopen"><i class="fas d3fa-17x fa-check-circle d3fa-color-green"></i></a>
                        <a href="#" style="display: inline-block;"
                           onclick="document.getElementById('processing_result').value = '[{if $where.d3transactiondata.processing_result != 'NOK'}]NOK[{/if}]'; document.search.submit(); return false;"
                           class="d3hpopen"><i class=" fas d3fa-17x fa-times-circle d3fa-color-red"></i></a>
                    </td>
                    <td>
                        <input class="listedit"
                               type="text"
                               size="5"
                               maxlength="128"
                               name="where[oxorder][oxordernr]"
                               value="[{$where.oxorder.oxordernr}]">
                    </td>
                    <td>
                        <input class="listedit"
                               type="text"
                                [{*size="60"*}]
                               maxlength="128"
                               name="where[d3transactionlog][oxtimestamp]"
                               value="[{$where.d3transactionlog.oxtimestamp}]">
                    </td>
                    <td>
                        <input class="listedit"
                               type="text"
                               size="8"
                               maxlength="128"
                               name="where[d3transactiondata][amount]"
                               value="[{$where.d3transactiondata.amount}]">
                    </td>
                    <td>
                        <input class="listedit"
                               type="text"
                               size="5"
                               maxlength="128"
                               name="where[d3transactiondata][payment_code]"
                               value="[{$where.d3transactiondata.payment_code}]">
                    </td>
                    <td>
                        <input class="listedit"
                               type="text"
                               size="10"
                               maxlength="128"
                               name="where[d3transactiondata][transactionid]"
                               value="[{$where.d3transactiondata.transactionid}]">
                    </td>
                    <td>
                        <input class="listedit"
                               type="text"
                               size="10"
                               maxlength="128"
                               name="where[d3transactiondata][shortid]"
                               value="[{$where.d3transactiondata.shortid}]">
                    </td>
                    <td style="white-space:nowrap">
                        <input class="listedit"
                               type="text"
                               size="20"
                               maxlength="128"
                               name="where[d3transactionlog][oxsessid]"
                               value="[{$where.d3transactionlog.oxsessid}]">

                        <input type="submit" style="display:none;">

                        <a href="#" style="display: inline-block;"
                           onclick="document.search.submit(); return false;">
                            <i class="fa d3fa-17x fa-search" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
                [{foreach from=$transactions item='transaction' key='index' name='transactions'}]

                    [{assign var='transactionLogReader' value=$transaction->getTransactiondata()}]
                    [{assign var='sClassName' value=''}]
                    [{assign var='blTransactionSuccessfull' value=false}]
                    [{assign var='sAmount' value=$transactionLogReader->getAmount()}]
                    [{assign var="sPaymentType" value=$transactionLogReader->getPaymentcode()|substr:0:2}]
                    [{assign var="sPaymentMethod" value=$transactionLogReader->getPaymentcode()|substr:3}]
                    [{assign var='sUniqueId' value=$transactionLogReader->getUniqueid()}]

                    [{if $smarty.foreach.transactions.index is odd}]
                        [{assign var='sClassName' value='odd'}]
                    [{/if}]
                    [{if $transactionLogReader->getResult() == 'ACK'}]
                        [{assign var='blTransactionSuccessfull' value=true}]
                    [{/if}]
                    [{if !$blTransactionSuccessfull && $transaction->getAction() == 'response'}]
                        [{assign var='sAmount' value="<del>$sAmount</del>"}]
                    [{/if}]
                    [{if $sPaymentMethod == 'PA'}]
                        [{assign var='sAmount' value="($sAmount)"}]
                    [{/if}]
                    <tr class="[{$sClassName}]">
                        <td>
                            <a rel="d3[{$index}]"> [{$transaction->getFieldData('d3lognr')}] </a>
                        </td>
                        <td>
                            <a rel="d3[{$index}]" class="d3hpopen d3hpdisplay">
                                <i class="fa fa-plus-circle d3fa-17x d3fa-color-disabled"></i>
                            </a>
                        </td>
                        <td>
                            <a rel="d3[{$index}]" class="d3hpopen" title="[{$transaction->getAction()}]">
                                [{if $transaction->getAction() == 'response'}]
                                    <i class="fa d3fa-17x fa-sign-in" aria-hidden="true"></i>
                                [{else}]
                                    <i class="fa d3fa-17x fa-sign-out" aria-hidden="true"></i>
                                [{/if}]
                            </a>
                        </td>
                        <td>
                            [{if $transaction->getAction() == 'response'}]
                                <a rel="d3[{$index}]" class="d3hpopen" title="[{$transactionLogReader->getResult()}]">
                                    <i class="fa d3fa-17x [{if $blTransactionSuccessfull}] fa-check-circle d3fa-color-green[{else}] fa-times-circle d3fa-color-red[{/if}]"></i>
                                </a>
                            [{/if}]
                        </td>
                        <td>
                            <a rel="d3[{$index}]"
                               class="d3hpopen">[{$oView->getOrderNr($transaction)}]</a>
                        </td>
                        <td>
                            <a rel="d3[{$index}]"
                               class="d3hpopen">[{$transaction->getFieldData('oxtimestamp')}]</a>
                        </td>
                        <td>
                            <a rel="d3[{$index}]" class="d3hpopen">
                                [{$sAmount}] [{$transactionLogReader->getCurrency()}]
                            </a>
                        </td>
                        <td>
                            <a rel="d3[{$index}]" class="d3hpopen"
                               title="[{oxmultilang ident='D3_HEIDELPAY_PAYMENT_'|cat:$sPaymentType}].[{oxmultilang ident='D3_HEIDELPAY_METHOD_'|cat:$sPaymentMethod}]">
                                [{$sPaymentType}].[{$sPaymentMethod}]
                            </a>
                        </td>
                        <td>
                            <a rel="d3[{$index}]"
                               class="d3hpopen">[{$transactionLogReader->getTransactionid()}]</a>
                        </td>
                        <td>
                            <a rel="d3[{$index}]"
                               class="d3hpopen">[{$transactionLogReader->getShortid()}]</a>
                        </td>
                        <td>
                            <a rel="d3[{$index}]"
                               class="d3hpopen">[{$transaction->getSessionId()}]</a>
                        </td>
                    </tr>
                    <tr class="d3hphidden d3[{$index}]" data-visible="false">
                        <td colspan="11" class="[{$sClassName}]" style="text-align:left">
                            <div class="d3hpslider">
                                <h4>[{oxmultilang ident="D3_HEIDELPAY_CONTROLLERS_ADMIN_ORDER_HEIDELPAY_DETAILS"}]</h4>

                                [{assign var='transactionData' value=$transactionLogReader->getData()}]
                                <table class="d3transactionData box">
                                    [{foreach from=$transactionData item="transactionItem" key="transactionKey" name="transactionData"}]
                                        <tr[{if $smarty.foreach.transactionData.index is odd}] class="odd"[{/if}]>
                                            <td>[{$transactionKey}]</td>
                                            <td>[{$transactionItem|wordwrap:100:"\n":true}]</td>
                                        </tr>
                                    [{/foreach}]
                                </table>
                                <a rel="d3[{$index}]" class="d3modcfg_icon d3hpclose action_minus_inactive"
                                   title="[{oxmultilang ident="CATEGORY_UPDATE_CLOSE"}]"></a>
                            </div>
                        </td>
                    </tr>
                [{/foreach}]
                [{include file="pagenavisnippet.tpl" colspan="11"}]
            </table>
        [{capture name="doNotShow"}]
            <script type="text/javascript">
                [{capture name="javaScript"}]
                $(".d3hpopen").click(function () {
                    current = $(this);
                    className = current.attr("rel");
                    isVisible = $("." + className).attr("data-visible");

                    if ("false" === isVisible) {
                        $("#d3hptransactions")
                            .find(".d3hphidden." + className).show()
                            .find('.d3hpslider').animate({height: "toggle"}, "slow");
                        $("." + className).attr("data-visible", 'true');
                    } else {
                        element = $("#d3hptransactions")
                            .find(".d3hphidden." + className);

                        element.find('.d3hpslider').animate({height: "toggle"}, "slow", function () {
                            element.hide();
                        });
                        $("." + className).attr("data-visible", 'false');
                    }
                });

                $(".d3hphidden, .d3hpslider").hide();
                [{/capture}]
            </script>
        [{/capture}]
            [{oxscript add=$smarty.capture.javaScript}]
        [{/block}]
    </form>
</div>

[{include file="pagetabsnippet.tpl"}]
[{include file="d3_cfg_mod_inc.tpl" blHideLinkBar=true}]
