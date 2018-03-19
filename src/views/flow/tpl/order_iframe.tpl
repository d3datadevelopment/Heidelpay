[{oxscript include=$oViewConf->getModuleUrl('d3heidelpay', 'out/src/js/jquery.simple.timer/jquery.simple.timer.js')}]

[{assign var="payment" value=$oView->getPayment()}]
[{assign var='oHeidelPaySettings' value=$oHeidelpayViewConfig->getSettings()}]
[{assign var='oHeidelPayment' value=$oHeidelPaySettings->getPayment($payment)}]
[{assign var="cardTypeTimeOut" value=$oHeidelpayViewConfig->getHeidelpayConfVar('cardtypetimeout')}]
[{if false == $cardTypeTimeOut}]
    [{assign var="cardTypeTimeOut" value="600"}]
[{/if}]

<form id="paymentFrameForm">
    <div class="d3timeOut">
        [{oxmultilang ident="D3HEIDELPAY_TIMEOUT_TIMER"}]
        <div class='timer' data-seconds-left="[{$cardTypeTimeOut}]"></div>
    </div>
    [{if $isThreeDSecure}]
        [{assign var='o3DSecure' value=$oHeidelpayViewConfig->get3dSecureResponse()}]
        [{assign var="iframeUrl" value=$o3DSecure->sRedirectURL}]
        [{foreach from=$o3DSecure->aRedirectRarams key='key' item='value'}]
            <input type="hidden" name="[{$key}]" value="[{$value}]">
        [{/foreach}]
    [{else}]
        [{assign var="iframeUrl" value=$oHeidelpayViewConfig->getHeidelpayNgwIFrameUrl($oHeidelPayment)}]
    [{/if}]

    [{*<input type="hidden" name="PROCESSING.RECOVERABLE" value="TRUE"/>*}]

    [{assign var="hppayerror" value=$oHeidelpayViewConfig->getNgwError($payment)}]
    [{if $hppayerror}]
        <div class="alert alert-danger">
            <div>[{oxmultilang ident="D3HEIDELPAY_CC_INPUT_ERROR"}]</div>
            <div>[{$hppayerror}]</div>
        </div>
    [{/if}]


    [{if $iframeUrl}]
        <iframe id="paymentFrameIframe" src="[{$iframeUrl}]" frameborder="0" scrolling="no">
            Your Browser doesn\'t support iFrames
        </iframe>
    [{/if}]

    [{if $payment->oxpayments__oxlongdesc->value}]
        <div class="alert alert-info">
            [{$payment->oxpayments__oxlongdesc->value}]
        </div>
    [{/if}]

    <div class="well well-sm">
        <a href="[{oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=order"}]"
           class="btn btn-default pull-left prevStep submitButton largeButton">[{oxmultilang ident="D3HEIDELPAY_ORDER_PAGE_BACKSTEPT"}]</a>
        [{if $iframeUrl}]
            <button type="submit"
                    name="userform"
                    class="btn btn-primary pull-right submitButton nextStep largeButton"
                    id="paymentNextStepBottom">[{oxmultilang ident="D3HEIDELPAY_ORDER_PAGE_NEXTSTEP"}] <i
                        class="fa fa-caret-right"></i></button>
            <div class="clearfix"></div>
        [{/if}]
    </div>
</form>
[{if $iframeUrl}]
    [{capture name="emptyCapture"}]
        <script type="text/javascript">
            [{capture name="d3JavaScript"}]
            var targetOrigin = getDomainFromUrl('[{$iframeUrl}]');

            // ### Sending postMessages ###
            var paymentFrameForm = document.getElementById('paymentFrameForm');
            var paymentFrameIframe = document.getElementById('paymentFrameIframe');

            // Add an event listener that will execute the sendMessage() function
            // when the send button is clicked.
            if (paymentFrameForm.addEventListener) { // W3C DOM
                paymentFrameForm.addEventListener('submit', sendMessage);
            } else if (paymentFrameForm.attachEvent) { // IE DOM
                paymentFrameForm.attachEvent('onsubmit', sendMessage);
            }
            // A function to handle sending messages.
            function sendMessage(e) {
                // Prevent any default browser behaviour.
                if (e.preventDefault) {
                    e.preventDefault();
                } else {
                    e.returnValue = false;
                }

                // save the form data in an object
                var data = {};
                for (var i = 0, len = paymentFrameForm.length; i < len; ++i) {
                    var input = paymentFrameForm[i];
                    if (input.name) {
                        data[input.name] = input.value;
                    }
                }
                [{if $isHeidelpayDebugMode}]
                console.log(targetOrigin);
                console.log(data);
                [{/if}]

                // Send a json message with the form data to the iFrame receiver window.
                paymentFrameIframe.contentWindow.postMessage(JSON.stringify(data), targetOrigin);
            }

            // ### Utils ###
            // extract protocol, domain and port from url
            function getDomainFromUrl(url) {
                var arr = url.split("/");
                return arr[0] + "//" + arr[2];
            }

            // Setup an event listener that calls receiveMessage() when the window
            // receives a new MessageEvent.
            if (window.addEventListener) {  // W3C DOM
                window.addEventListener('message', receiveMessage);
            } else if (window.attachEvent) { // IE DOM
                window.attachEvent('onmessage', receiveMessage);
            }
            // ### Receiving postMessages ###
            function receiveMessage(e) {
// Check to make sure that this message came from the correct domain.
                if (e.origin !== targetOrigin) {
                    return;
                }
                $('#d3HeidelpayWait').modal('hide');
                $('#paymentNextStepBottom').attr('disabled', false);
// Do something with the data
                [{if $isHeidelpayDebugMode}]
                console.log(e.data);
                [{/if}]
            }

            $('#paymentFrameForm').submit(function () {
                //$('#d3HeidelpayWait').dialog('open');
                $('#d3HeidelpayWait').modal({
                    keyboard: false,
                    backdrop: 'static'
                });
                $('#paymentNextStepBottom').attr('disabled', true);
            });

            $('.timer').startTimer({
                onComplete: function (element) {
                    element.addClass('isComplete');
                    $('#paymentFrameForm').find('input, button, textarea').attr('disabled', 'disabled');
                    $('#d3HeidelpayOutOfTime').modal({
                        keyboard: false,
                        backdrop: 'static'
                    });
                }
            });
            [{/capture}]
        </script>
    [{/capture}]
[{/if}]
[{oxscript add=$smarty.capture.d3JavaScript}]

<div id="d3HeidelpayWait" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"
     aria-labelledby="d3HeidelpayWaitTitle">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="alert alert-info">[{oxmultilang ident="D3HEIDELPAY_SENDING_FORMULAR"}]</div>
            </div>
        </div>
    </div>
</div>
<div id="d3HeidelpayOutOfTime" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    [{assign var='cardTypeTimeOut' value=$cardTypeTimeOut|date_format:"%M:%S"}]
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="alert alert-danger">[{oxmultilang ident="D3HEIDELPAY_OUTOFTIME_FORMULAR" args=$cardTypeTimeOut}]</div>
                <div class="well well-sm text-center">
                    <a href="[{oxgetseourl ident=$oViewConf->getOrderLink()}]"
                       class="btn btn-default prevStep submitButton largeButton">[{oxmultilang ident="D3HEIDELPAY_OUTOFTIME_LINK"}]</a>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>

