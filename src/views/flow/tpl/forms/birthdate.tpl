[{assign var='parameterName' value=$d3hpPaymentFormular->parameter}]

[{if isset($d3HeidelpayB2BParameters.$parameterName)}]
    [{assign var='d3hpPaymentFormularValue' value=$d3HeidelpayB2BParameters.$parameterName}]
[{elseif isset($d3hpPaymentFormular->value)}]
    [{assign var='d3hpPaymentFormularValue' value=$d3hpPaymentFormular->value}]
[{elseif NOT empty($d3hpPaymentFormular->valueFromUser)}]
    [{assign var='d3hpPaymentFormularValue' value=$oxcmp_user->getFieldData($d3hpPaymentFormular->valueFromUser)}]
[{elseif NOT empty($d3hpPaymentFormular->standard)}]
    [{assign var='d3hpPaymentFormularValue' value=$d3hpPaymentFormular->standard}]
[{/if}]

[{capture name="birthdateFormAttributes"}]
    [{foreach from=$d3hpPaymentFormular->attributes item="attributeValue" key="attributeName"}]
        [{$attributeName}]="[{$attributeValue}]"
    [{/foreach}]
    [{foreach from=$d3hpPaymentFormular->translationAttributes item="attributeValue" key="attributeName"}]
        [{$attributeName}]="[{oxmultilang ident=$attributeValue noerror=1}]"
    [{/foreach}]
[{/capture}]

<div class="row oxDate form-group[{if $d3hpPaymentFormular->registrationType}] [{$d3hpPaymentFormular->registrationType}][{/if}]">
    <label class="control-label col-xs-12 col-lg-3 [{if in_array('required', $d3hpPaymentFormular->attributes)}] req[{/if}]">
        [{oxmultilang ident=$d3hpPaymentFormular->name}]
    </label>
    <div class="col-xs-3 col-lg-3">
        <input class="oxDay form-control" name="d3heidelpay[[{$sPaymentID}]][[{$d3hpPaymentFormular->parameter}]][day]"
            [{$smarty.capture.birthdateFormAttributes}]
           value="[{if $d3hpPaymentFormularValue.day}][{$d3hpPaymentFormularValue.day}][{/if}]"
           placeholder="[{oxmultilang ident="DAY"}]" type="text" maxlength="4" class="form-control" >
    </div>
    <div class="col-xs-6 col-lg-3">
        <select class="oxMonth form-control" name="d3heidelpay[[{$sPaymentID}]][[{$d3hpPaymentFormular->parameter}]][month]"
            [{$smarty.capture.birthdateFormAttributes}]
                >
            <option value="" label="-">-</option>
            [{section name="month" start=1 loop=13}]
            <option value="[{$smarty.section.month.index}]" label="[{$smarty.section.month.index}]"
                [{if $d3hpPaymentFormularValue.month == $smarty.section.month.index}] selected="selected" [{/if}]>
                [{oxmultilang ident="MONTH_NAME_"|cat:$smarty.section.month.index}]
            </option>
            [{/section}]
        </select>
    </div>
    <div class="col-xs-3 col-lg-3">
        <input class="oxYear form-control" name="d3heidelpay[[{$sPaymentID}]][[{$d3hpPaymentFormular->parameter}]][year]" type="text"
               value="[{if $d3hpPaymentFormularValue.year}][{$d3hpPaymentFormularValue.year}][{/if}]"
            [{$smarty.capture.birthdateFormAttributes}]
               maxlength="4" placeholder="[{oxmultilang ident="YEAR"}]">
    </div>
</div>
