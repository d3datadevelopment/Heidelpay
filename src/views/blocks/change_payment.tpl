[{if !$oHeidelpayViewConfig}]
    [{$smarty.block.parent}]
[{else}]
    [{d3modcfgcheck modid="d3heidelpay"}][{/d3modcfgcheck}]
    [{if $mod_d3heidelpay}]
        [{$smarty.block.parent}]

        [{capture name="doNotUse"}]
            <script type="text/javascript">
                [{capture name="d3JavaScriptForHeidelpay"}]
                $('#payment').find('dl dd').not('.activePayment').find('input, select, textarea').attr('disabled', 'disabled');
                $('#payment dl dt input[type=radio]').click(function () {
                    $('#payment').find('dd').find('input, select, textarea').attr('disabled', 'disabled');
                    $(this).parents('dl').find('input, select, textarea').removeAttr('disabled');
                });
                [{/capture}]
            </script>
        [{/capture}]

        [{oxscript add=$smarty.capture.d3JavaScriptForHeidelpay}]
    [{/if}]
[{/if}]
