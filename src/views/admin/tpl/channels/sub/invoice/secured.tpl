[{* see branch fea_konfigurationsumbau_Limits_refaktorisieren
<div class="form-group">
    <label class="control-label col-md-3" for="d3HeidelpayInvoiceSecuredLimitMinimum">
        [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_INVOICESECUREDLIMITMINIMUM"}]
    </label>
    <div class="col-md-1">
        [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_PARAM_INVOICESECUREDLIMITMINIMUM"}]
    </div>
    <div class="col-md-8">
        <label class="checkbox-inline">
            <input type="number"
                   id="d3HeidelpayInvoiceSecuredLimitMinimum"
                   name="editval[invoiceSecuredLimitMinimum]"
                   value="[{$currentChannel->getInvoiceSecuredLimitMinimum()}]" [{$readonly}]>
        </label>
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-3" for="d3HeidelpayInvoiceSecuredLimitMaximum">
        [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_INVOICESECUREDLIMITMAXIMUM"}]
    </label>
    <div class="col-md-1">
        [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_PARAM_INVOICESECUREDLIMITMAXIMUM"}]
    </div>
    <div class="col-md-8">
        <label class="checkbox-inline">
            <input type="number"
                   id="d3HeidelpayInvoiceSecuredLimitMaximum"
                   name="editval[invoiceSecuredLimitMaximum]"
                   value="[{$currentChannel->getInvoiceSecuredLimitMaximum()}]" [{$readonly}]>
        </label>
    </div>
</div>
*}]
