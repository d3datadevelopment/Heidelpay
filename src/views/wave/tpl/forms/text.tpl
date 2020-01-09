[{assign var='parameterName' value=$d3hpPaymentFormular->parameter}]

[{if isset($d3HeidelpayB2BParameters.$parameterName)}]
    [{assign var='d3hpPaymentFormularValue' value=$d3HeidelpayB2BParameters.$parameterName}]
[{elseif isset($d3hpPaymentFormular->d3hpPaymentFormularValue)}]
    [{assign var='d3hpPaymentFormularValue' value=$d3hpPaymentFormular->d3hpPaymentFormularValue}]
[{elseif isset($d3hpPaymentFormular->d3hpPaymentFormularValueTranslation)}]
    [{assign var='d3hpPaymentFormularValue' value=$d3hpPaymentFormular->d3hpPaymentFormularValueTranslation|oxmultilangassign}]
[{elseif NOT empty($d3hpPaymentFormular->valueFromUser)}]
    [{assign var='d3hpPaymentFormularValue' value=$oxcmp_user->getFieldData($d3hpPaymentFormular->valueFromUser)}]
[{elseif NOT empty($d3hpPaymentFormular->valuesFromUser)}]
    [{foreach from=$d3hpPaymentFormular->valuesFromUser item="valueFromUser" name="d3hpPaymentFormular"}]
        [{if $smarty.foreach.d3hpPaymentFormular.iteration > 1}]
            [{assign var='d3hpPaymentFormularValue' value=$d3hpPaymentFormularValue|cat:' '}]
        [{/if}]
        [{assign var='d3hpPaymentFormularValue' value=$d3hpPaymentFormularValue|cat:$oxcmp_user->getFieldData($valueFromUser)}]
    [{/foreach}]
[{/if}]

<div class="row form-group [{if $d3hpPaymentFormular->registrationType}][{$d3hpPaymentFormular->registrationType}][{/if}]">
    <label class="control-label col-lg-3[{if in_array('required', $d3hpPaymentFormular->attributes)}] req[{/if}]"
           for="d3HeidelpayBToBBillPurchase_[{$sPaymentID}]_[{$d3hpPaymentFormular->parameter}]">
        [{oxmultilang ident=$d3hpPaymentFormular->name}]
    </label>
    <div class="col-lg-9">
        <input class="form-control" type="text"
               id="d3HeidelpayBToBBillPurchase_[{$sPaymentID}]_[{$d3hpPaymentFormular->parameter}]"
               name="d3heidelpay[[{$sPaymentID}]][[{$d3hpPaymentFormular->parameter}]]"
               value="[{if $d3hpPaymentFormularValue}][{$d3hpPaymentFormularValue}][{/if}]"
        [{foreach from=$d3hpPaymentFormular->attributes item="attributeValue" key="attributeName"}]
            [{$attributeName}]="[{$attributeValue}]"
        [{/foreach}]
        [{foreach from=$d3hpPaymentFormular->translationAttributes item="attributeValue" key="attributeName"}]
            [{$attributeName}]="[{oxmultilang ident=$attributeValue noerror=1}]"
        [{/foreach}]
        >
    </div>
</div>
