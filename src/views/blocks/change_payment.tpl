[{if !$oHeidelpayViewConfig}]
    [{$smarty.block.parent}]
[{else}]
    [{d3modcfgcheck modid="d3heidelpay"}][{/d3modcfgcheck}]
    [{if $mod_d3heidelpay}]
        [{if $oView->d3CheckForMobileTheme() == false}]
        [{* START AZURE *}]
        [{$smarty.block.parent}]

            [{capture name="doNotUse"}]
                <script type="text/javascript">
                    [{capture name="d3JavaScriptForHeidelpay"}]
                    $('#payment').find('dl dd').not('.activePayment').find('input, select, textarea').attr('disabled', 'disabled');
                    $('#payment dl dt input[type=radio]').click(function(){
                        $('#payment').find('dd').find('input, select, textarea').attr('disabled', 'disabled');
                        $(this).parents('dl').find('input, select, textarea').removeAttr('disabled');
                    });
                    [{/capture}]
                </script>
            [{/capture}]

            [{oxscript add=$smarty.capture.d3JavaScriptForHeidelpay}]
        [{* END AZURE *}]
        [{else}]
        [{* START MOBILE *}]

            [{capture name="doNotUse"}]
                <script type="text/javascript">
                    [{capture name="d3JavaScriptForHeidelpay"}]
                    $('#payment').find('.payment-option .form').find('input, select, textarea').prop('disabled', true);
                    $('#payment').find('.payment-option.active-payment .form').find('input, select, textarea').prop('disabled', false);
                    $('#sPaymentSelected').on('change', function(){
                        $('#payment').find('.payment-option .form').find('input, select, textarea').prop('disabled', true);
                        $('#payment').find('.payment-option.active-payment .form').find('input, select, textarea').prop('disabled', false);
                    });

                    var heidelpayDisablePayment = [];
                    $('#sPaymentSelected').change(function() {
                        $('#paymentNextStepBottom').removeAttr('disabled');
                        if(-1 != heidelpayDisablePayment.indexOf($(this).val())) {
                            $('#paymentNextStepBottom').attr('disabled', true);
                        }
                    });
                    [{/capture}]
                </script>
            [{/capture}]

            [{oxscript add=$smarty.capture.d3JavaScriptForHeidelpay}]

            [{$smarty.block.parent}]
        [{* END MOBILE *}]
        [{/if}]
    [{/if}]
[{/if}]
