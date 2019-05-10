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

<li class="[{if $d3hpPaymentFormular->registrationType}][{$d3hpPaymentFormular->registrationType}][{/if}]">
    <label [{if in_array('required', $d3hpPaymentFormular->attributes)}]style="font-weight:700"[{/if}]
           for="d3heidelpay_azure_select_[{$sPaymentID}]_[{$d3hpPaymentFormular->parameter}]">
        [{oxmultilang ident=$d3hpPaymentFormular->name}]
    </label>
    <select class="js-oxValidate" data-fieldsize="normal" name="d3heidelpay[[{$sPaymentID}]][[{$d3hpPaymentFormular->parameter}]]"
            id="d3heidelpay_azure_select_[{$sPaymentID}]_[{$d3hpPaymentFormular->parameter}]"
        [{foreach from=$d3hpPaymentFormular->attributes item="attributeValue" key="attributeName"}]
            [{$attributeName}]="[{$attributeValue}]"
        [{/foreach}]
        [{foreach from=$d3hpPaymentFormular->translationAttributes item="attributeValue" key="attributeName"}]
            [{$attributeName}]="[{oxmultilang ident=$attributeValue noerror=1}]"
        [{/foreach}]
        class="form-control">
        [{if $d3hpPaymentFormular->standard}]
            <option value="[{$d3hpPaymentFormular->standard}]">
                [{oxmultilang ident="D3HEIDELPAY_PAYMENT_COMPANY_"|cat:$d3hpPaymentFormular->standard}]
            </option>
        [{/if}]
        [{foreach from=$d3hpPaymentFormular->values item="item" key="key"}]
            [{if $d3hpPaymentFormular->standard != $item}]
                <option value="[{$item}]"
                    [{if $d3hpPaymentFormularValue == $item}] selected="selected" [{/if}]
                >
                    [{oxmultilang ident="D3HEIDELPAY_PAYMENT_COMPANY_"|cat:$item}]
                </option>
            [{/if}]
        [{/foreach}]
    </select>
</li>
