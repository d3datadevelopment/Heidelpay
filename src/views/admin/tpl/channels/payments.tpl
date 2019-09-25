[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
      crossorigin="anonymous"
>

<!-- Optional theme -->
<link rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
      integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp"
      crossorigin="anonymous"
>

<style>

    .container{
        margin:0;
    }

    @media (min-width:1200px){
        .container{
            width:970px;
        }
    }
    .legende {
        line-height : 32px;
    }

    .legende .paytype{
        width:32px;
        height:32px;
        float:left;
        border:1px solid #ddd;
    }

    .legende .paytype.act{
        background:#dff0d8;
    }

    .legende .paytype.inact{
        background:#f2dede;
    }

    .legende .paytype.used{
        background:#eee;
    }

    .legende .paytypestatus{
        float:left;
        margin-left:5px;
        margin-right:30px;
        font-size:14px;
    }

    .table-condensed th.headcenter{
        text-align:center;
    }

    .table-condensed td.paymethode{
        font-size:14px;
        line-height:32px;
    }

    .paymethodeused{
        background:#eee;
    }

    .table-condensed label.checkbox-inline{
        vertical-align:top;
    }

</style>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

<div class="container">
    <div class="row">
        [{if $basicLicenceInformation}]
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-warning">
                        [{$basicLicenceInformation}]
                    </div>
                </div>
            </div>
        [{/if}]
        <div class="col-xs-12">
            <div class="legende">
                <div class="paytype act">&nbsp;</div>
                <div class="paytypestatus">Die Shop-Zahlungsart ist dieser Channel-Konfiguration zugeordnet.</div>
                <br>
                <div class="paytype inact">&nbsp;</div>
                <div class="paytypestatus">Die Shop-Zahlungsart hat keine Zuweisung und kann zugeordnet werden.</div>
                <br>
                <div class="paytype used">&nbsp;</div>
                <div class="paytypestatus">[{oxmultilang ident="D3HEIDELPAY_CONFIG_ALREADY_ASSIGNED_TO_OTHER_CONFIG"}]</div>
                <div style="clear:both;"></div>
                <br>
            </div>
        </div>
        <div class="col-xs-12">
            <form class="form-horizontal" action="[{$oViewConf->getSelfLink()}]" method="post">
                [{$oViewConf->getHiddenSid()}]
                <input type="hidden" name="oxid" value="[{$currentChannel->getId()}]">
                <input type="hidden" name="fnc" value="assignPayments">
                <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassname()}]">
                <table class="table table-condensed">
                    <tr>
                        <th>[{oxmultilang ident="D3HEIDELPAY_CONFIG_SHOPPAYMENT"}]</th>
                        <th>[{oxmultilang ident="D3HEIDELPAY_CONFIG_CHANNELCONFIGURATION"}]</th>
                        <th class="headcenter">[{oxmultilang ident="D3HEIDELPAY_CONFIG_ISASSIGNED"}]</th>
                    </tr>
                    [{foreach from=$orderedList item="orderedItemlist" key="category"}]
                        [{foreach from=$orderedItemlist item="orderedItem" key="configId"}]
                            <tr class="[{$cssContainer.$category.trClass}]">
                                <td class="paymethode">
                                    [{$orderedItem->oxidTitle}]
                                </td>
                                <td class="paymethode">
                                    [{$orderedItem->channelTitle}]
                                </td>
                                <td class="paymethode" style="text-align:center;">
                                    <label class="checkbox-inline">
                                        [{if $orderedItem->isDisabled}]
                                            <input type="checkbox"
                                                   style="margin-top:10px;"
                                                   disabled
                                                    [{if $orderedItem->isAssigned}] checked[{/if}]
                                            >
                                        [{else}]
                                            <input type="hidden"
                                                   name="editval[[{$orderedItem->oxidpaymentId}]]"
                                                   value="0">
                                            <input type="checkbox"
                                                   name="editval[[{$orderedItem->oxidpaymentId}]]"
                                                   value="1"
                                                   style="margin-top:10px;"
                                                    [{if $orderedItem->isAssigned}] checked[{/if}]
                                            >
                                        [{/if}]
                                    </label>
                                </td>
                            </tr>
                        [{/foreach}]
                    [{/foreach}]
                </table>
                <div class="form-group">
                    <div class="alert alert-info" style="padding:5px;text-align:right;width:100%;">
                        <button class="btn btn-primary" type="submit">
                            Zuordnung(en) speichern
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<form name="transfer" id="transfer" action="[{$oViewConf->getSelfLink()}]" method="post">
    [{$oViewConf->getHiddenSid()}]
    <input type="hidden" name="oxid" value="[{$oxid}]">
    <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassname()}]">
</form>

[{include file="bottomitem.tpl"}]
