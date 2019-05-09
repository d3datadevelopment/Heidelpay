[{assign var='parameterName' value=$d3hpPaymentFormular->parameter}]

[{if isset($d3hpPaymentFormular->value)}]
    [{assign var='d3hpPaymentFormularValue' value=$d3hpPaymentFormular->value}]
[{elseif NOT empty($d3hpPaymentFormular->valueFromUser)}]
    [{assign var='d3hpPaymentFormularValue' value=$oxcmp_user->getFieldData($d3hpPaymentFormular->valueFromUser)}]
[{/if}]

<li class="[{if $d3hpPaymentFormular->registrationType}][{$d3hpPaymentFormular->registrationType}][{/if}]">
    <input type="radio"
           [{if isset($d3HeidelpayB2BParameters.$parameterName) && $d3HeidelpayB2BParameters.$parameterName == $d3hpPaymentFormularValue}]checked[{/if}]
           id="d3HeidelpayBToBBillPurchase_[{$sPaymentID}]_[{$d3hpPaymentFormular->parameter}]_[{$d3hpPaymentFormular->name}]"
           name="d3heidelpay[[{$sPaymentID}]][[{$d3hpPaymentFormular->parameter}]]"
           value="[{if $d3hpPaymentFormularValue}][{$d3hpPaymentFormularValue}][{/if}]"
    [{foreach from=$d3hpPaymentFormular->attributes item="attributeValue" key="attributeName"}]
        [{$attributeName}]="[{$attributeValue}]"
    [{/foreach}]
    [{foreach from=$d3hpPaymentFormular->translationAttributes item="attributeValue" key="attributeName"}]
        [{$attributeName}]="[{oxmultilang ident=$attributeValue noerror=1}]"
    [{/foreach}]
    >
    <label for="d3HeidelpayBToBBillPurchase_[{$sPaymentID}]_[{$d3hpPaymentFormular->parameter}]_[{$d3hpPaymentFormular->name}]">
        <strong>[{oxmultilang ident=$d3hpPaymentFormular->name}]</strong>
    </label>
</li>
