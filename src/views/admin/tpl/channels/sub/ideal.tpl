[{*
<div class="form-group">
    <label class="control-label col-md-3" for="d3HeidelpaysD3HpHFOrderPendingTime">
        [{oxmultilang ident="D3HEIDELPAY_sD3HpHFOrderPendingTime"}]
    </label>
    <div class="col-md-1">
        [{oxinputhelp ident="HELP_D3HEIDELPAY_sD3HpHFOrderPendingTime"}]
    </div>
    <div class="col-md-8">
        <label class="checkbox-inline">
            <input type="number"
                   id="d3HeidelpaysD3HpHFOrderPendingTime"
                   name="editval[sD3HpHFOrderPendingTime]"
                   value="[{$currentChannel->getsD3HpHFOrderPendingTime()}]" [{$readonly}]>
        </label>
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-3" for="d3HeidelpaysD3HpHFOrderLimit">
        [{oxmultilang ident="D3HEIDELPAY_sD3HpHFOrderLimit"}]
    </label>
    <div class="col-md-1">
        [{oxinputhelp ident="HELP_D3HEIDELPAY_sD3HpHFOrderLimit"}]
    </div>
    <div class="col-md-8">
        <label class="checkbox-inline">
            <input type="number"
                   id="d3HeidelpaysD3HpHFOrderLimit"
                   name="editval[sD3HpHFOrderLimit]"
                   value="[{$currentChannel->getsD3HpHFOrderLimit()}]" [{$readonly}]>
        </label>
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-3" for="d3HeidelpaysD3HpHFOrderCancelType">
        [{oxmultilang ident="D3HEIDELPAY_sD3HpHFOrderCancelType"}]
    </label>
    <div class="col-md-1">
        [{oxinputhelp ident="HELP_D3HEIDELPAY_sD3HpHFOrderCancelType"}]
    </div>
    <div class="col-md-8">
        [{assign var='actualSelection' value=$currentChannel->getsD3HpHFOrderCancelType()}]
        <select class="form-control"
                id="d3HeidelpaysD3HpHFOrderCancelType"
                name="editval[sD3HpHFOrderCancelType]"
                title="[{oxmultilang ident="D3HEIDELPAY_sD3HpHFOrderCancelType"}]"
        >
            <option value="PLEASE_CHOOSE"[{if $actualSelection === 'PLEASE_CHOOSE'}] selected[{/if}]>[{oxmultilang ident="D3HEIDELPAY_sD3HpHFOrderCancelType_PLEASE_CHOOSE"}]</option>
            <option value="CANCEL_ORDER"[{if $actualSelection === 'CANCEL_ORDER'}] selected[{/if}]>[{oxmultilang ident="D3HEIDELPAY_sD3HpHFOrderCancelType_CANCEL_ORDER"}]</option>
            <option value="DELETE_ORDER"[{if $actualSelection === 'DELETE_ORDER'}] selected[{/if}]>[{oxmultilang ident="D3HEIDELPAY_sD3HpHFOrderCancelType_DELETE_ORDER"}]</option>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-3" for="d3HeidelpayblD3HpHFSetZeroOrderNumber">
        [{oxmultilang ident="D3HEIDELPAY_blD3HpHFSetZeroOrderNumber"}]
    </label>
    <div class="col-md-1">
        [{oxinputhelp ident="HELP_D3HEIDELPAY_blD3HpHFSetZeroOrderNumber"}]
    </div>
    <div class="col-md-8">
        <label class="checkbox-inline">
            <input type="hidden" name="editval[blD3HpHFSetZeroOrderNumber]" value="0">
            <input type="checkbox"
                   id="d3HeidelpayblD3HpHFSetZeroOrderNumber"
                   name="editval[blD3HpHFSetZeroOrderNumber]"
                   value="1" [{$readonly}][{if $currentChannel->isblD3HpHFSetZeroOrderNumber()}] checked[{/if}]>
        </label>
    </div>
</div>
*}]
