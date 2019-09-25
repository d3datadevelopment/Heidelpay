[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]

[{if $readonly}]
    [{assign var="readonly" value="readonly disabled"}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]

[{assign var="oCurr" value=$edit->getOrderCurrency()}]
[{assign var="banktransferData" value=$edit->getHeidelpayBankTransferData()}]

<form name="transfer" id="transfer" action="[{$oViewConf->getSelfLink()}]" method="post">
    [{$oViewConf->getHiddenSid()}]
    <input type="hidden" name="cur" value="[{$oCurr->id}]">
    <input type="hidden" name="oxid" value="[{$oxid}]">
    <input type="hidden" name="cl" value="[{$oView->getClassName()}]">
</form>

[{if $oHeidelpayViewConfig->isModuleDemoVersion()}]
    <div class="extension_warning">[{oxmultilang ident="D3_HEIDELPAY_IS_DEMO"}]</div>
[{/if}]
[{if $heidelpayTransactionMessage}]
    <div class="extension_error"> [{$heidelpayTransactionMessage}]</div>
[{/if}]

<table cellspacing="0" cellpadding="0" border="0" width="100%">
    [{if $banktransferData}]
        <tr>
            <td valign="top" class="edittext" width="100%">
                <table border="0" width="100%" border="0" class="listTable box">
                    <tr>
                        <th colspan="2">
                            <h2>[{oxmultilang ident="D3_HEIDELPAY_CONTROLLERS_ADMIN_ORDER_HEIDELPAY_BANKTRANSFERDATA"}]</h2>
                        </th>
                    </tr>
                    <tr>
                        <td class="listitem">[{oxmultilang ident="D3_HEIDELPAY_CONTROLLERS_ADMIN_ORDER_HEIDELPAY_HOLDER"}]</td>
                        <td class="listitem">[{$banktransferData->Holder}]</td>
                    </tr>
                    <tr>
                        <td class="listitem">[{oxmultilang ident="D3_HEIDELPAY_CONTROLLERS_ADMIN_ORDER_HEIDELPAY_IBAN"}]</td>
                        <td class="listitem">[{$banktransferData->Iban}]</td>
                    </tr>
                    <tr>
                        <td class="listitem">[{oxmultilang ident="D3_HEIDELPAY_CONTROLLERS_ADMIN_ORDER_HEIDELPAY_BIC"}]</td>
                        <td class="listitem">[{$banktransferData->Bic}]</td>
                    </tr>
                    <tr>
                        <td class="listitem">[{oxmultilang ident="D3_HEIDELPAY_CONTROLLERS_ADMIN_ORDER_HEIDELPAY_AMOUNT"}]</td>
                        <td class="listitem">[{$banktransferData->Amount}] [{$banktransferData->Currency}]</td>
                    </tr>
                    <tr>
                        <td class="listitem">[{oxmultilang ident="D3_HEIDELPAY_CONTROLLERS_ADMIN_ORDER_HEIDELPAY_REASON"}]</td>
                        <td class="listitem">[{$banktransferData->Reference}]</td>
                    </tr>
                    <tr>
                        <td class="listitem">[{oxmultilang ident="D3_HEIDELPAY_CONTROLLERS_ADMIN_ORDER_HEIDELPAY_UNIQUEID"}]</td>
                        <td class="listitem">[{$banktransferData->UniqueID}]</td>
                    </tr>
                    <tr>
                        <td class="listitem">[{oxmultilang ident="D3_HEIDELPAY_CONTROLLERS_ADMIN_ORDER_HEIDELPAY_TRANSACTIONID"}]</td>
                        <td class="listitem">[{$banktransferData->TransactionID}]</td>
                    </tr>
                </table>
            </td>
        </tr>
    [{/if}]
    <tr>
        <td valign="top" class="edittext" width="100%">
            [{block name="admin_order_heidelpay_form"}]

                [{* showing all transactions for this order  *}]
                [{assign var='transactions' value=$oView->getTransactions()}]
                [{assign var='transactions' value=$transactions->reverse()}]

                [{if !empty($transactions)}]
                    <table border="0" class="d3hptransactions box" id="d3hptransactions">
                        <tr>
                            <th colspan="3">Ergebnis</th>
                            <th>Datum</th>
                            <th>Credit/Debit</th>
                            <th>Methode</th>
                            <th>Zahlungstyp</th>
                            <th>Txn-ID</th>
                            <th>Unique ID</th>
                            <th>Short ID</th>
                        </tr>
                        [{foreach from=$transactions item='transaction' key='index' name='transactions'}]

                            [{assign var='transactionLogReader' value=$transaction->getTransactiondata()}]
                            [{assign var='sClassName' value='class="listitem"'}]
                            [{assign var='blTransactionSuccessfull' value=false}]
                            [{assign var='sAmount' value=$transactionLogReader->getAmount()}]
                            [{assign var="sPaymentType" value=$transactionLogReader->getPaymentcode()|substr:0:2}]
                            [{assign var="sPaymentMethod" value=$transactionLogReader->getPaymentcode()|substr:3}]
                            [{assign var='sUniqueId' value=$transactionLogReader->getUniqueid()}]
                            [{assign var='criterionTags' value=$transactionLogReader->getCriterionTags()}]
                            [{if false == empty($sUniqueId)}]
                                [{if $smarty.foreach.transactions.index is odd}]
                                    [{assign var='sClassName' value='class="listitem2"'}]
                                [{/if}]
                                [{if $transactionLogReader->getResult() == 'ACK'}]
                                    [{assign var='blTransactionSuccessfull' value=true}]
                                [{/if}]

                                [{if !$blTransactionSuccessfull}]
                                    [{assign var='sAmount' value="<del>$sAmount</del>"}]
                                [{/if}]

                                [{if $sPaymentMethod == 'PA'}]
                                    [{assign var='sAmount' value="($sAmount)"}]
                                [{/if}]
                                <tr>
                                    <td [{$sClassName}]>
                                        <a rel="d3[{$index}]"
                                           class="d3hpopen d3hpdisplay"><i class="fas fa-plus-circle d3fa-17x d3fa-color-disabled"></i></a>
                                    </td>
                                    <td [{$sClassName}]>
                                        <a rel="d3[{$index}]" class="d3hpopen "
                                           title="[{$transactionLogReader->getResult()}]">
                                            <i class="fas d3fa-17x [{if $blTransactionSuccessfull}] fa-check-circle d3fa-color-green[{else}] fa-times-circle d3fa-color-red[{/if}]"></i>
                                        </a>
                                    </td>
                                    <td [{$sClassName}]>
                                        <a rel="d3[{$index}]" class="d3hpopen">[{$transactionLogReader->getReason()}]</a>
                                    </td>
                                    <td [{$sClassName}]>
                                        <a rel="d3[{$index}]"
                                           class="d3hpopen">[{$transactionLogReader->getTimestamp()}]</a>
                                    </td>
                                    <td [{$sClassName}]>
                                        <a rel="d3[{$index}]" class="d3hpopen">
                                            [{$sAmount}] [{$transactionLogReader->getCurrency()}]
                                        </a>
                                    </td>
                                    <td [{$sClassName}]>
                                        <a rel="d3[{$index}]" class="d3hpopen">
                                            [{oxmultilang ident='D3_HEIDELPAY_METHOD_'|cat:$sPaymentMethod}]
                                            ([{$sPaymentMethod}])
                                        </a>
                                    </td>
                                    <td [{$sClassName}]>
                                        <a rel="d3[{$index}]" class="d3hpopen">
                                            [{oxmultilang ident='D3_HEIDELPAY_PAYMENT_'|cat:$sPaymentType}]
                                            ([{$sPaymentType}])
                                        </a>
                                    </td>
                                    <td [{$sClassName}]>
                                        <a rel="d3[{$index}]"
                                           class="d3hpopen">[{$transactionLogReader->getTransactionid()}]</a>
                                    </td>
                                    <td [{$sClassName}]>
                                        <a rel="d3[{$index}]"
                                           class="d3hpopen">[{$sUniqueId}]</a>
                                    </td>
                                    <td [{$sClassName}]>
                                        <a rel="d3[{$index}]" class="d3hpopen">[{$transactionLogReader->getShortid()}]</a>
                                    </td>
                                </tr>
                                [{if $criterionTags->count() > 0}]
                                    <tr class="d3hphidden d3[{$index}]" data-visible="false">
                                        <td colspan="10" [{$sClassName}] style="text-align:left;">
                                            <div class="d3hpslider">
                                                <h4>[{oxmultilang ident="D3_HEIDELPAY_CONTROLLERS_ADMIN_ORDER_HEIDELPAY_CRITERIONTAGS"}]</h4>
                                                <div style="overflow:auto;height: 140px;width: 960px;">
                                                    <table width="100%">
                                                        [{foreach from=$criterionTags item="criterionValue" key="criterionName" name="criterionTags"}]
                                                            [{assign var='criterionClassname' value="listitem"}]

                                                            [{if $smarty.foreach.criterionTags.iteration is even by 2}]
                                                                [{assign var='criterionClassname' value="listitem2"}]
                                                            [{/if}]
                                                            <tr >
                                                                <td class="[{$criterionClassname}]" style="text-align:left;">[{oxmultilang ident=$criterionName noerror=true}]:</td>
                                                                <td class="[{$criterionClassname}]" style="text-align:left;">
                                                                    <div style="width: 666px;overflow-y: hidden;">[{$criterionValue}]</div>
                                                                </td>
                                                            </tr>
                                                        [{/foreach}]
                                                    </table>
                                                    <br>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                [{/if}]
                                <tr class="d3hphidden d3[{$index}]" data-visible="false">
                                    <td colspan="9" [{$sClassName}]>
                                        <div class="d3hpslider">
                                            <form action="[{$oViewConf->getSelfLink()}]" method="post">
                                                <div>
                                                    [{$oViewConf->getHiddenSid()}]
                                                    <input type="hidden" name="cur" value="[{$oCurr->id}]">
                                                    <input type="hidden" name="cl" value="[{$oView->getClassName()}]">
                                                    <input type="hidden" name="fnc" value="runPaymentAction">
                                                    <input type="hidden" name="oxid" value="[{$oxid}]">
                                                    <input type="hidden" name="editval[oxorder__oxid]" value="[{$oxid}]">
                                                    <input type="hidden" name="d3TransactionId" value="[{$index}]">
                                                    <input type="hidden"
                                                           name="d3TransactionUniqueId"
                                                           value="[{$sUniqueId}]">
                                                    <input type="hidden"
                                                           id="paymentActiond3[{$index}]"
                                                           name="paymentAction"
                                                           value="">

                                                </div>
                                                <ul class="hpactions">
                                                    [{foreach from=$oView->getActions($transactionLogReader) item='button'}]
                                                        <li>
                                                            <button name="[{$button.name}]" value="[{$button.value}]"
                                                                    [{if $button.disabled || $transactionLogReader->getResult() != 'ACK'}]disabled="disabled"[{/if}]
                                                                    rel="d3[{$index}]"
                                                                    class="d3hptransaction">[{$button.title}]</button>
                                                        </li>
                                                    [{/foreach}]
                                                </ul>
                                                <div class="hpfieldset" id="fieldsetd3[{$index}]">
                                                    <label class="d3hplabel">
                                                        Betrag
                                                        <input type="text"
                                                               name="data[betrag]"
                                                               value="[{$transactionLogReader->getAmount()}]">
                                                        &nbsp;[{$edit->oxorder__oxcurrency->value}]
                                                    </label>
                                                    <label class="d3modcfg_btn icon">
                                                        <input type="submit"
                                                               id="submitd3[{$index}]"
                                                               value="[{oxmultilang ident="D3_HEIDELPAY_CONTROLLERS_ADMIN_ORDER_HEIDELPAY_SUBMIT"}]">
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                    <td [{$sClassName}] valign="top">
                                        <a rel="d3[{$index}]" class="d3modcfg_icon d3hpclose action_minus_inactive"
                                           title="[{oxmultilang ident="CATEGORY_UPDATE_CLOSE"}]"></a>
                                    </td>
                                </tr>
                            [{/if}]
                        [{/foreach}]
                    </table>
                    [{if $oView->isBasicLicence()}]
                        <div class="extension_warning">[{oxmultilang ident="D3_HEIDELPAY_RESTRICTIONINFO_ORDER"}]</div>
                    [{/if}]

                [{else}]
                    [{oxmultilang ident="D3_HEIDELPAY_CONTROLLERS_ADMIN_ORDER_HEIDELPAY_IS_NOT_HEIDELPAY"}]
                [{/if}]
            [{/block}]
        </td>
    </tr>
</table>


[{capture name="doNotShow"}]
    <script type="text/javascript">
        [{capture name="javaScript"}]
        jQuery(".d3hpopen").click(function () {
            current = jQuery(this);
            className = current.attr("rel");
            isVisible = jQuery("." + className).attr("data-visible");

            if ("false" === isVisible) {
                jQuery("#d3hptransactions")
                    .find(".d3hphidden." + className).show()
                    .find('.d3hpslider').animate({height: "toggle"}, "slow");
                jQuery("." + className).attr("data-visible", 'true');
            } else {
                element = jQuery("#d3hptransactions")
                    .find(".d3hphidden." + className);

                element.find('.d3hpslider').animate({height: "toggle"}, "slow", function () {
                    element.hide();
                });
                jQuery("." + className).attr("data-visible", 'false');
            }
        });
        jQuery(".d3hphidden, .d3hpslider").hide();
        var originalValue = "";
        jQuery("button.d3hptransaction").click(function () {
            var hiddenId = "#paymentAction" + jQuery(this).attr("rel");
            var submitId = "#submit" + jQuery(this).attr("rel");
            var fieldsetId = "#fieldset" + jQuery(this).attr("rel");
            jQuery(hiddenId).attr("name", jQuery(this).attr("name"));
            jQuery(hiddenId).attr("value", jQuery(this).attr("value"));

            if (originalValue == "") {
                originalValue = jQuery(submitId).attr("value");
            }

            jQuery(submitId).attr("value", jQuery(this).text() + " " + originalValue);
            jQuery(fieldsetId).show();
            return false;
        });

        [{/capture}]
    </script>
[{/capture}]
[{oxscript add=$smarty.capture.javaScript}]

[{include file="bottomnaviitem.tpl"}]

[{include file="d3_cfg_mod_inc.tpl"}]
