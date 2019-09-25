[{*
<div class="form-group">
    <label class="control-label col-md-3" for="d3HeidelpaysWTTransType">
        [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE_MASTERPASS"}]
    </label>
    <div class="col-md-1">
        [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE_MASTERPASS"}]
    </div>
    <div class="col-md-8">
        [{assign var='actualSelection' value=$currentChannel->getSWTTransType()}]
        <select class="form-control"
                id="d3HeidelpaysWTTransType"
                name="editval[sWTTransType]"
                title="[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE_MASTERPASS"}]"
        >
            <option value="auth"[{if $actualSelection === 'auth'}] selected[{/if}]>[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE_DIRECT"}]</option>
            <option value="preauth"[{if $actualSelection === 'preauth'}] selected[{/if}]>[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE_RESERVE"}]</option>
        </select>
    </div>
</div>
*}]
