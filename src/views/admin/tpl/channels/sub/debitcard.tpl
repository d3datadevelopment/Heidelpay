[{*
<div class="form-group">
    <label class="control-label col-md-3" for="d3HeidelpayTransactionType">
        [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE"}]
    </label>
    <div class="col-md-1">
        [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE"}]
    </div>
    <div class="col-md-8">
        [{assign var='actualSelection' value=$currentChannel->getTransactionType()}]
        <select class="form-control"
                id="d3HeidelpayTransactionType"
                name="editval[transactionType]"
                title="[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE"}]"
        >
            <option value="auth"[{if $actualSelection === 'auth'}] selected[{/if}]>[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE_DIRECT"}]</option>
            <option value="preauth"[{if $actualSelection === 'preauth'}] selected[{/if}]>[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE_RESERVE"}]</option>
            <option value="auth_but_foreign_preauth"[{if $actualSelection === 'auth_but_foreign_preauth'}] selected[{/if}]>[{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE_FOREIGNRESERVE"}]</option>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-3" for="d3HeidelpayisUsingRegistration">
        [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_STOREDDATA"}]
    </label>
    <div class="col-md-1">
        [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_PARAM_STOREDDATA"}]
    </div>
    <div class="col-md-8">
        <label class="checkbox-inline">
            <input type="hidden" name="editval[isUsingRegistration]" value="0">
            <input type="checkbox"
                   id="d3HeidelpayisUsingRegistration"
                   name="editval[isUsingRegistration]"
                   value="1" [{$readonly}][{if $currentChannel->isUsingRegistration()}] checked[{/if}]>
        </label>
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-3" for="d3HeidelpayisUsingStoredCardData">
        [{oxmultilang ident="D3DYN_HEIDELPAY_PARAM_STOREDDATA"}]
    </label>
    <div class="col-md-1">
        [{oxinputhelp ident="HELP_D3DYN_HEIDELPAY_PARAM_STOREDDATA"}]
    </div>
    <div class="col-md-8">
        <label class="checkbox-inline">
            <input type="hidden" name="editval[isUsingStoredCardData]" value="0">
            <input type="checkbox"
                   id="d3HeidelpayisUsingStoredCardData"
                   name="editval[isUsingStoredCardData]"
                   value="1" [{$readonly}][{if $currentChannel->isUsingStoredCardData()}] checked[{/if}]>
        </label>
    </div>
</div>

*}]
