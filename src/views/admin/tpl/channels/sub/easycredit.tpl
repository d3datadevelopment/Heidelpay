[{* see branch fea_konfigurationsumbau_Limits_refaktorisieren
<div class="form-group">
    <label class="control-label col-md-3" for="d3HeidelpayEasyCreditLimitMinimum">
        [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_EASYCREDITLIMITMINIMUM"}]
    </label>
    <div class="col-md-1">
        [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_PARAM_EASYCREDITLIMITMINIMUM"}]
    </div>
    <div class="col-md-8">
        <label class="checkbox-inline">
            <input type="number"
                   id="d3HeidelpayEasyCreditLimitMinimum"
                   name="editval[easyCreditLimitMinimum]"
                   value="[{$currentChannel->getEasyCreditLimitMinimum()}]" [{$readonly}]>
        </label>
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-3" for="d3HeidelpayEasyCreditLimitMaximum">
        [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_EASYCREDITLIMITMAXIMUM"}]
    </label>
    <div class="col-md-1">
        [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_PARAM_EASYCREDITLIMITMAXIMUM"}]
    </div>
    <div class="col-md-8">
        <label class="checkbox-inline">
            <input type="number"
                   id="d3HeidelpayEasyCreditLimitMaximum"
                   name="editval[easyCreditLimitMaximum]"
                   value="[{$currentChannel->getEasyCreditLimitMaximum()}]" [{$readonly}]>
        </label>
    </div>
</div>
*}]
