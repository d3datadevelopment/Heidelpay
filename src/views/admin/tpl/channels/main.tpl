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

[{*
[{oxscript include="js/libs/jquery.min.js"}]
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"
></script>
*}]

<style>

    .container {
        margin : 0;
    }

    @media (min-width : 1200px) {
        .container {
            width : 970px;
        }
    }

    .form-group label.control-label {
        text-align    : left;
        margin-bottom : 5px;
    }

    .form-group label.control-label span.d3helppanel {
        float : right;
    }

    @media (max-width : 991px) {
        .form-group label.control-label span.d3helppanel {
            padding-left : 10px;
        }
    }

    .form-group input.form-control {
        font-size    : 14px;
        padding-left : 15px;
    }

    .form-group input.form-control.d3number {
        width   : 80px;
        display : inline-block;
    }

    .form-group label.checkbox-inline {
        vertical-align : top;
    }

</style>

<div class="container">
    [{if $basicLicenceInformation}]
        <div class="row">
            <div class="col-xs-12">
                <div class="alert alert-warning">
                    [{$basicLicenceInformation}]
                </div>
            </div>
        </div>
    [{/if}]
    <div class="row">
        <div class="col-xs-12">
            <form class="form-horizontal" action="[{$oViewConf->getSelfLink()}]" method="post">
                [{$oViewConf->getHiddenSid()}]
                <input type="hidden" name="oxid" value="[{$currentChannel->getId()}]">
                <input type="hidden" name="editval[oxid]" value="[{$currentChannel->getId()}]">
                <input type="hidden" name="fnc" value="saveCurrentConfig">
                <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassname()}]">
                <div class="form-group">
                    <label class="control-label col-md-3" for="d3HeidelpayActive">
                        [{oxmultilang ident="GENERAL_ACTIVE"}]
                    </label>
                    <div class="col-md-1">
                        [{oxinputhelp ident="HELP_GENERAL_ACTIVE"}]
                    </div>
                    <div class="col-md-8">
                        <label class="checkbox-inline">
                            <input type="hidden" name="editval[isActive]" value="0">
                            <input type="checkbox" id="d3HeidelpayActive" name="editval[isActive]" value="1" [{$readonly}][{if $currentChannel->isActive()}] checked[{/if}]>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3" for="d3HeidelpayTestConfig">
                        [{oxmultilang ident="D3HEIDELPAY_CONFIG_ISTESTCONFIG"}]
                    </label>
                    <div class="col-md-1">
                        [{oxinputhelp ident="HELP_D3HEIDELPAY_CONFIG_ISTESTCONFIG"}]
                    </div>
                    <div class="col-md-8">
                        <label class="checkbox-inline">
                            <input type="hidden" name="editval[isTestConfig]" value="0">
                            <input type="checkbox" id="d3HeidelpayTestConfig" name="editval[isTestConfig]" value="1" [{$readonly}][{if $currentChannel->isTestConfig()}] checked[{/if}]>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3" for="d3HeidelpayTitle">
                        [{oxmultilang ident="GENERAL_TITLE"}]
                    </label>
                    <div class="col-md-1">
                        [{oxinputhelp ident="HELP_D3HEIDELPAY_CONFIG_TITLE"}]
                    </div>
                    <div class="col-md-8">
                        <input class="form-control"
                               id="d3HeidelpayTitle"
                               required
                               type="text"
                               maxlength="255"
                               name="editval[title]"
                               value="[{$currentChannel->getTitle()}]" [{$readonly}]>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3" for="d3HeidelpayPaymentType">
                        [{oxmultilang ident="D3DYN_HEIDELPAY_PAYTYPE"}]
                    </label>
                    <div class="col-md-1">
                        [{oxinputhelp ident="HELP_D3HEIDELPAY_CONFIG_PAYMENTTYPE"}]
                    </div>
                    <div class="col-md-8">
                        <select class="form-control"
                                id="d3HeidelpayPaymentType"
                                name="editval[paymentType]"
                                title="[{oxmultilang ident="D3DYN_HEIDELPAY_PAYTYPE"}]"
                        >
                            [{foreach from=$paymentTypeList item="heidelPayment"}]
                                <option value="[{$heidelPayment}]"[{if $currentChannel->getPaymentType() == $heidelPayment}] selected[{/if}]>
                                    [{oxmultilang ident=$heidelPayment|strtolower}]
                                </option>
                            [{/foreach}]
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3" for="d3HeidelpayChannel">
                        [{oxmultilang ident="D3HEIDELPAY_CONFIG_CHANNEL"}]
                    </label>
                    <div class="col-md-1">
                        [{oxinputhelp ident="HELP_D3HEIDELPAY_CONFIG_CHANNEL"}]
                    </div>
                    <div class="col-md-8">
                        <input class="form-control"
                               id="d3HeidelpayChannel"
                               required
                               type="text"
                               maxlength="64"
                               name="editval[channel]"
                               value="[{$currentChannel->getChannel()}]" [{$readonly}]>
                    </div>
                </div>

                [{include file=$subTemplateName}]
                <div class="form-group">
                    <div class="alert alert-info" style="padding:5px;text-align:right;">
                        <button class="btn btn-primary" type="submit">
                            [{oxmultilang ident="GENERAL_SAVE"}]
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

[{strip}]
        <a class="firstitem"
           id="btn.new"
           href="#"
           onClick="top.oxid.admin.editThis( -1 );return false"
           target="edit"
        >[{oxmultilang ident="D3HEIDELPAY_NEW_CONFIG_CHANNEL"}]</a>
[{/strip}]

[{include file="bottomnaviitem.tpl"}]
[{include file="bottomitem.tpl"}]
