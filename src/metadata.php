<?php

/**
 * Metadata version
 */

use D3\Heidelpay\Controllers\Admin\AdminList;
use D3\Heidelpay\Controllers\Admin\Base;
use D3\Heidelpay\Controllers\Admin\Settings;
use D3\Heidelpay\Modules\Application\Controller;
use D3\Heidelpay\Modules\Application\Model;
use D3\Heidelpay\Modules\Core;
use D3\Heidelpay\Setup\CleanupRoutine;
use D3\Heidelpay\Setup\InstallRoutine;
use D3\ModCfg\Application\Model\d3counter;
use D3\ModCfg\Application\Model\d3utils;
use D3\ModCfg\Application\Model\Install\d3install;
use OxidEsales\Eshop\Application\Controller as OxidController;
use OxidEsales\Eshop\Application\Model as OxidModel;
use OxidEsales\Eshop\Core as OxidCore;

$sMetadataVersion = '2.0';

$aModule = array(
    'id'             => 'd3heidelpay',
    'title'          => (class_exists('D3\ModCfg\Application\Model\d3utils') ? d3utils::getInstance()->getD3Logo() : 'D&sup3;') . ' Heidelpay',
    'description'    => array(
        'de' => 'heidelpay GmbH bietet als Zahlungsinstitut H&auml;ndlern ein Zahlungssystem f&uuml;r '
            . 'alle g&auml;ngigen Zahlungsverfahren f&uuml;r die Payment Abwicklung im Internet.',
        'en' => '',
    ),
    'thumbnail'      => 'picture.png',
    'version'        => '6.0.3.1',
    'author'         => 'D&sup3; Data Development, Inh. Thomas Dartsch',
    'email'          => 'support@shopmodule.com',
    'url'            => 'https://docs.oxidmodule.com/Heidelpay/',
    'events'         => array(
        'onActivate' => d3install::class . '::checkUpdateStart',
    ),
    'd3SetupClasses' => array(
        InstallRoutine::class,
        CleanupRoutine::class,
    ),
    'extend'         => array(
        d3counter::class                         => Core\Counter::class,
        OxidCore\Email::class                    => Core\Email::class,
        OxidCore\InputValidator::class           => Core\InputValidator::class,
        OxidController\OrderController::class    => Controller\OrderController::class,
        OxidController\PaymentController::class  => Controller\PaymentController::class,
        OxidController\ThankYouController::class => Controller\ThankYouController::class,
        OxidModel\Order::class                   => Model\Order::class,
        OxidModel\PaymentGateway::class          => Model\PaymentGateway::class,
        OxidModel\BasketItem::class              => Model\BasketItem::class,
    ),
    'controllers'    => array(
        'd3_heidelpay_controllers_admin_adminlist'          => AdminList::class,
        'd3_heidelpay_controllers_admin_base'               => Base::class,
        'd3_heidelpay_controllers_admin_settings'           => Settings::class,
        'd3_heidelpay_controllers_admin_support'            => D3\Heidelpay\Controllers\Admin\Support::class,
        'd3_heidelpay_controllers_admin_log'                => D3\Heidelpay\Controllers\Admin\Log::class,
        'd3_heidelpay_controllers_admin_loglist'            => D3\Heidelpay\Controllers\Admin\LogList::class,
        'd3_heidelpay_controllers_admin_transactionloglist' => D3\Heidelpay\Controllers\Admin\TransactionlogList::class,
        'd3_heidelpay_controllers_admin_order_heidelpay'    => D3\Heidelpay\Controllers\Admin\Order\Heidelpay::class
    ),
    'templates'      => array(
        #admin
        'd3_heidelpay_views_admin_tpl_settings.tpl'                      => 'd3/heidelpay/views/admin/tpl/settings.tpl',
        'd3_heidelpay_views_admin_tpl_order.tpl'                         => 'd3/heidelpay/views/admin/tpl/order.tpl',
        'd3_heidelpay_views_admin_tpl_transactionloglist.tpl'            => 'd3/heidelpay/views/admin/tpl/transactionloglist.tpl',
        // allgemeine Templates
        'd3_heidelpay_views_tpl_payment_img.tpl'                         => 'd3/heidelpay/views/tpl/payment_img.tpl',
        'd3_heidelpay_views_tpl_redirect_postformular.tpl'               => 'd3/heidelpay/views/tpl/redirect_postformular.tpl',
        'd3_heidelpay_views_tpl_email_html_prepayment_cust.tpl'          => 'd3/heidelpay/views/tpl/email/html/prepayment_cust.tpl',
        'd3_heidelpay_views_tpl_email_html_prepayment_cust_subj.tpl'     => 'd3/heidelpay/views/tpl/email/html/prepayment_cust_subj.tpl',
        'd3_heidelpay_views_tpl_email_html_prepayment_owner.tpl'         => 'd3/heidelpay/views/tpl/email/html/prepayment_owner.tpl',
        'd3_heidelpay_views_tpl_email_html_prepayment_owner_subj.tpl'    => 'd3/heidelpay/views/tpl/email/html/prepayment_owner_subj.tpl',
        'd3_heidelpay_views_tpl_email_plain_prepayment_cust.tpl'         => 'd3/heidelpay/views/tpl/email/plain/prepayment_cust.tpl',
        'd3_heidelpay_views_tpl_email_plain_prepayment_owner.tpl'        => 'd3/heidelpay/views/tpl/email/plain/prepayment_owner.tpl',
        ##azure-theme
        'd3_heidelpay_views_azure_tpl_cc_input.tpl'                      => 'd3/heidelpay/views/azure/tpl/cc_input.tpl',
        'd3_heidelpay_views_azure_tpl_order_3ds_iframe.tpl'              => 'd3/heidelpay/views/azure/tpl/order_3ds_iframe.tpl',
        'd3_heidelpay_views_azure_tpl_payment_cards.tpl'                 => 'd3/heidelpay/views/azure/tpl/payment/cards.tpl',
        'd3_heidelpay_views_azure_tpl_storeduid.tpl'                     => 'd3/heidelpay/views/azure/tpl/storeduid.tpl',
        'd3_heidelpay_views_azure_tpl_payment_debitnote.tpl'             => 'd3/heidelpay/views/azure/tpl/payment/debitnote.tpl',
        'd3_heidelpay_views_azure_tpl_payment_eps.tpl'                   => 'd3/heidelpay/views/azure/tpl/payment/eps.tpl',
        'd3_heidelpay_views_azure_tpl_payment_giropay.tpl'               => 'd3/heidelpay/views/azure/tpl/payment/giropay.tpl',
        'd3_heidelpay_views_azure_tpl_payment_ideal.tpl'                 => 'd3/heidelpay/views/azure/tpl/payment/ideal.tpl',
        'd3_heidelpay_views_azure_tpl_payment_sofort.tpl'                => 'd3/heidelpay/views/azure/tpl/payment/sofort.tpl',
        'd3_heidelpay_views_azure_tpl_payment_postfinance.tpl'           => 'd3/heidelpay/views/azure/tpl/payment/postfinance.tpl',
        'd3_heidelpay_views_azure_tpl_payment_paypal.tpl'                => 'd3/heidelpay/views/azure/tpl/payment/paypal.tpl',
        'd3_heidelpay_views_azure_tpl_payment_przelewy24.tpl'            => 'd3/heidelpay/views/azure/tpl/payment/przelewy24.tpl',
        'd3_heidelpay_views_azure_tpl_payment_masterpass.tpl'            => 'd3/heidelpay/views/azure/tpl/payment/masterpass.tpl',
        'd3_heidelpay_views_azure_tpl_payment_easycredit.tpl'            => 'd3/heidelpay/views/azure/tpl/payment/easycredit.tpl',
        'd3_heidelpay_views_azure_tpl_payment_btobbillpurchase.tpl'      => 'd3/heidelpay/views/azure/tpl/payment/btobbillpurchase.tpl',
        'd3_heidelpay_views_azure_tpl_order_iframe.tpl'                  => 'd3/heidelpay/views/azure/tpl/order_iframe.tpl',
        'd3_heidelpay_views_azure_tpl_payment_invoice.tpl'               => 'd3/heidelpay/views/azure/tpl/payment/invoice.tpl',
        'd3_heidelpay_views_azure_tpl_banktransferdata.tpl'              => 'd3/heidelpay/views/azure/tpl/banktransferdata.tpl',
        'd3_heidelpay_views_azure_tpl_shippingandpayment.tpl'            => 'd3/heidelpay/views/azure/tpl/shippingandpayment.tpl',
        'd3_heidelpay_views_azure_tpl_thankyou_easycreditcriterions.tpl' => 'd3/heidelpay/views/azure/tpl/thankyou/easycreditcriterions.tpl',
        'd3_heidelpay_views_azure_tpl_order_easycreditcriterions.tpl'    => 'd3/heidelpay/views/azure/tpl/order/easycreditcriterions.tpl',
        'd3_heidelpay_views_azure_tpl_messages.tpl'                      => 'd3/heidelpay/views/azure/tpl/messages.tpl',
        'd3_heidelpay_views_azure_tpl_forms_select.tpl'                  => 'd3/heidelpay/views/azure/tpl/forms/select.tpl',
        'd3_heidelpay_views_azure_tpl_forms_text.tpl'                    => 'd3/heidelpay/views/azure/tpl/forms/text.tpl',
        'd3_heidelpay_views_azure_tpl_forms_radio.tpl'                   => 'd3/heidelpay/views/azure/tpl/forms/radio.tpl',
        'd3_heidelpay_views_azure_tpl_forms_title.tpl'                   => 'd3/heidelpay/views/azure/tpl/forms/title.tpl',
        'd3_heidelpay_views_azure_tpl_forms_birthdate.tpl'               => 'd3/heidelpay/views/azure/tpl/forms/birthdate.tpl',
        ##flow-theme
        'd3_heidelpay_views_flow_tpl_payment_debitnote.tpl'              => 'd3/heidelpay/views/flow/tpl/payment/debitnote.tpl',
        'd3_heidelpay_views_flow_tpl_payment_cards.tpl'                  => 'd3/heidelpay/views/flow/tpl/payment/cards.tpl',
        'd3_heidelpay_views_flow_tpl_payment_masterpass.tpl'             => 'd3/heidelpay/views/flow/tpl/payment/masterpass.tpl',
        'd3_heidelpay_views_flow_tpl_payment_giropay.tpl'                => 'd3/heidelpay/views/flow/tpl/payment/giropay.tpl',
        'd3_heidelpay_views_flow_tpl_payment_ideal.tpl'                  => 'd3/heidelpay/views/flow/tpl/payment/ideal.tpl',
        'd3_heidelpay_views_flow_tpl_payment_paypal.tpl'                 => 'd3/heidelpay/views/flow/tpl/payment/paypal.tpl',
        'd3_heidelpay_views_flow_tpl_payment_przelewy24.tpl'             => 'd3/heidelpay/views/flow/tpl/payment/przelewy24.tpl',
        'd3_heidelpay_views_flow_tpl_payment_sofort.tpl'                 => 'd3/heidelpay/views/flow/tpl/payment/sofort.tpl',
        'd3_heidelpay_views_flow_tpl_payment_eps.tpl'                    => 'd3/heidelpay/views/flow/tpl/payment/eps.tpl',
        'd3_heidelpay_views_flow_tpl_payment_postfinance.tpl'            => 'd3/heidelpay/views/flow/tpl/payment/postfinance.tpl',
        'd3_heidelpay_views_flow_tpl_cc_input.tpl'                       => 'd3/heidelpay/views/flow/tpl/cc_input.tpl',
        'd3_heidelpay_views_flow_tpl_messages.tpl'                       => 'd3/heidelpay/views/flow/tpl/messages.tpl',
        'd3_heidelpay_views_flow_tpl_order_iframe.tpl'                   => 'd3/heidelpay/views/flow/tpl/order_iframe.tpl',
        'd3_heidelpay_views_flow_tpl_storeduid.tpl'                      => 'd3/heidelpay/views/flow/tpl/storeduid.tpl',
        'd3_heidelpay_views_flow_tpl_payment_invoice.tpl'                => 'd3/heidelpay/views/flow/tpl/payment/invoice.tpl',
        'd3_heidelpay_views_flow_tpl_payment_easycredit.tpl'             => 'd3/heidelpay/views/flow/tpl/payment/easycredit.tpl',
        'd3_heidelpay_views_flow_tpl_payment_btobbillpurchase.tpl'       => 'd3/heidelpay/views/flow/tpl/payment/btobbillpurchase.tpl',
        'd3_heidelpay_views_flow_tpl_banktransferdata.tpl'               => 'd3/heidelpay/views/flow/tpl/banktransferdata.tpl',
        'd3_heidelpay_views_flow_tpl_shippingandpayment.tpl'             => 'd3/heidelpay/views/flow/tpl/shippingandpayment.tpl',
        'd3_heidelpay_views_flow_tpl_thankyou_easycreditcriterions.tpl'  => 'd3/heidelpay/views/flow/tpl/thankyou/easycreditcriterions.tpl',
        'd3_heidelpay_views_flow_tpl_order_easycreditcriterions.tpl'     => 'd3/heidelpay/views/flow/tpl/order/easycreditcriterions.tpl',
        'd3_heidelpay_views_flow_tpl_forms_select.tpl'                   => 'd3/heidelpay/views/flow/tpl/forms/select.tpl',
        'd3_heidelpay_views_flow_tpl_forms_text.tpl'                     => 'd3/heidelpay/views/flow/tpl/forms/text.tpl',
        'd3_heidelpay_views_flow_tpl_forms_radio.tpl'                    => 'd3/heidelpay/views/flow/tpl/forms/radio.tpl',
        'd3_heidelpay_views_flow_tpl_forms_title.tpl'                    => 'd3/heidelpay/views/flow/tpl/forms/title.tpl',
        'd3_heidelpay_views_flow_tpl_forms_birthdate.tpl'                => 'd3/heidelpay/views/flow/tpl/forms/birthdate.tpl',
    ),
    'blocks'         => array(
        ##Admin
        array(
            'template' => 'headitem.tpl',
            'block'    => 'admin_headitem_inccss',
            'file'     => '/views/blocks/admin_headitem_inccss.tpl'
        ),

        #### azure
        array(
            'template' => 'page/checkout/payment.tpl',
            'block'    => 'change_payment',
            'file'     => '/views/blocks/change_payment.tpl'
        ),
        array(
            'template' => 'page/checkout/payment.tpl',
            'block'    => 'select_payment',
            'file'     => '/views/blocks/select_payment.tpl'
        ),

        array(
            'template' => 'layout/base.tpl',
            'block'    => 'base_style',
            'file'     => '/views/blocks/base_style.tpl'
        ),

        ##azure+flow
        array(
            'template' => 'email/html/order_cust.tpl',
            'block'    => 'email_html_order_cust_paymentinfo',
            'file'     => '/views/blocks/email_html_order_cust_paymentinfo.tpl'
        ),
        array(
            'template' => 'email/plain/order_cust.tpl',
            'block'    => 'email_plain_order_cust_paymentinfo',
            'file'     => '/views/blocks/email_plain_order_cust_paymentinfo.tpl'
        ),
        array(
            'template' => 'page/checkout/thankyou.tpl',
            'block'    => 'checkout_thankyou_info',
            'file'     => '/views/blocks/checkout_thankyou_info.tpl'
        ),
        array(
            'template' => 'page/checkout/payment.tpl',
            'block'    => 'checkout_payment_errors',
            'file'     => '/views/blocks/checkout_payment_errors.tpl'
        ),
        array(
            'template' => 'page/checkout/order.tpl',
            'block'    => 'shippingAndPayment',
            'file'     => '/views/blocks/shippingandpayment.tpl'
        ),
        array(
            'template' => 'page/checkout/inc/basketcontents.tpl',
            'block'    => 'checkout_basketcontents_grandtotal',
            'file'     => '/views/blocks/checkout_basketcontents_grandtotal.tpl'
        ),
    ),
);
