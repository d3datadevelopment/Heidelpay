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

    [{if $iframeUrl}]
        <iframe id="paymentFrameIframe" src="[{$iframeUrl}]" frameborder="0" scrolling="no">
            Your Browser doesn\'t support iFrames
        </iframe>
    [{/if}]

    [{if $payment->oxpayments__oxlongdesc->value}]
        <div class="desc">
            [{$payment->oxpayments__oxlongdesc->value}]
        </div>
    [{/if}]

    <div class="lineBox clear">
        <a href="[{oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=order"}]"
           class="submitButton largeButton">[{oxmultilang ident="D3HEIDELPAY_ORDER_PAGE_BACKSTEPT"}]</a>
        [{if $iframeUrl}]
            <button type="submit"
                    name="userform"
                    class="submitButton nextStep largeButton"
                    id="paymentNextStepBottom">[{oxmultilang ident="D3HEIDELPAY_ORDER_PAGE_NEXTSTEP"}]</button>
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
                $('#d3HeidelpayWait').dialog('close');
                $('#paymentNextStepBottom').attr('disabled', false);
// Do something with the data
                [{if $isHeidelpayDebugMode}]
                console.log(e.data);
                [{/if}]
            }

            $('#d3HeidelpayWait').dialog({
                autoOpen: false,
                modal: true,
                width: 540,
                height: 'auto',
                zIndex: 10000,
                position: 'center',
                draggable: false,
                closeOnEscape: true,
                resizable: false,
                show: 'drop',
                hide: 'drop',
                open: function () {
                    $('div.ui-dialog-titlebar').remove();
                }
            });

            $('#d3HeidelpayOutOfTime').dialog({
                autoOpen: false,
                modal: true,
                width: 540,
                height: 'auto',
                zIndex: 10000,
                position: 'center',
                draggable: false,
                closeOnEscape: true,
                resizable: false,
                show: 'drop',
                hide: 'drop',
                open: function () {
                    $('div.ui-dialog-titlebar').remove();
                }
            });

            $('#paymentFrameForm').submit(function () {
                $('#d3HeidelpayWait').dialog('open');
                $('#paymentNextStepBottom').attr('disabled', true);
            });

            $('.timer').startTimer({
                onComplete: function (element) {
                    element.addClass('isComplete');
                    $('#paymentFrameForm').find('input, button, textarea').attr('disabled', 'disabled');
                    $('#d3HeidelpayOutOfTime').dialog('open');
                }
            });
            [{/capture}]
        </script>
    [{/capture}]
[{/if}]
[{oxscript add=$smarty.capture.d3JavaScript}]


<div id="d3HeidelpayWait" class="popupBox corners FXgradGreyLight glowShadow">
    <table class="d3HeidelpayInfoTable" cellpadding="0" cellspacing="0">
        <tr>
            <td class="d3HeidelpayInfoCell">[{oxmultilang ident="D3HEIDELPAY_SENDING_FORMULAR"}]</td>
        </tr>
    </table>
</div>
<div id="d3HeidelpayOutOfTime" class="popupBox corners FXgradGreyLight glowShadow">
    [{assign var='cardTypeTimeOut' value=$cardTypeTimeOut|date_format:"%M:%S"}]
    <table class="d3HeidelpayInfoTable" cellpadding="0" cellspacing="0">
        <tr>
            <td class="d3HeidelpayInfoCell">[{oxmultilang ident="D3HEIDELPAY_OUTOFTIME_FORMULAR" args=$cardTypeTimeOut}]</td>
        </tr>
        <tr>
            <td class="d3HeidelpayInfoCell">
                <a href="[{oxgetseourl ident=$oViewConf->getOrderLink()}]"
                   class="submitButton largeButton">[{oxmultilang ident="D3HEIDELPAY_OUTOFTIME_LINK"}]</a>
            </td>
        </tr>
    </table>
</div>

