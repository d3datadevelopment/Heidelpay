[{if $easyCreditInformations}]
    <tr>
        <th>[{oxmultilang ident="D3HEIDELPAY_ORDER_EASYCREDIT_ACCRUINGINTEREST"}]</th>
        <td>[{oxprice price=$easyCreditInformations.criterion_easycredit_accruinginterest currency=$currency}]</td>
    </tr>
    <tr>
        <th>[{oxmultilang ident="D3HEIDELPAY_ORDER_EASYCREDIT_TOTALAMOUNT"}]</th>
        <td>[{oxprice price=$easyCreditInformations.criterion_easycredit_totalamount currency=$currency}]</td>
    </tr>
[{/if}]
