[{assign var='parameterName' value=$d3hpPaymentFormular->parameter}]

[{if isset($d3hpPaymentFormular->value)}]
    [{assign var='d3hpPaymentFormularValue' value=$d3hpPaymentFormular->value}]
[{elseif NOT empty($d3hpPaymentFormular->valueFromUser)}]
    [{assign var='d3hpPaymentFormularValue' value=$oxcmp_user->getFieldData($d3hpPaymentFormular->valueFromUser)}]
[{/if}]
<div class="row form-group[{if $d3hpPaymentFormular->registrationType}] [{$d3hpPaymentFormular->registrationType}][{/if}]">
    <div class="radio col-lg-12 col-lg-offset-3[{if in_array('required', $d3hpPaymentFormular->attributes)}] req[{/if}]">
        <label class="radio-inline">
            <input type="radio"
                [{if isset($d3HeidelpayB2BParameters.$parameterName) && $d3HeidelpayB2BParameters.$parameterName == $d3hpPaymentFormularValue}]checked[{/if}]
                   name="d3heidelpay[[{$sPaymentID}]][[{$d3hpPaymentFormular->parameter}]]"
                   value="[{if $d3hpPaymentFormularValue}][{$d3hpPaymentFormularValue}][{/if}]"
            [{foreach from=$d3hpPaymentFormular->attributes item="attributeValue" key="attributeName"}]
                [{$attributeName}]="[{$attributeValue}]"
            [{/foreach}]
            [{foreach from=$d3hpPaymentFormular->translationAttributes item="attributeValue" key="attributeName"}]
                [{$attributeName}]="[{oxmultilang ident=$attributeValue noerror=1}]"
            [{/foreach}]
            >
            [{oxmultilang ident=$d3hpPaymentFormular->name}]
        </label>
    </div>
</div>
