<?php
/**
 * This Software is the property of Data Development and is protected
 * by copyright law - it is NOT Freeware.
 * Any unauthorized use of this software without a valid license
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 * http://www.shopmodule.com
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

namespace D3\Heidelpay\Modules\Core {

    use D3\ModCfg\Application\Model\d3counter;
    use OxidEsales\Eshop\Core as OxidCore;

    class Counter_parent extends d3counter
    {
    }

    class Email_parent extends OxidCore\Email
    {
    }

    class InputValidator_parent extends OxidCore\InputValidator
    {
    }
}

namespace D3\Heidelpay\Modules\Application\Controller {

    use OxidEsales\Eshop\Application\Controller as OxidController;

    class OrderController_parent extends OxidController\OrderController
    {
    }

    class PaymentController_parent extends OxidController\PaymentController
    {
    }

    class ThankYouController_parent extends OxidController\ThankYouController
    {
    }
}

namespace D3\Heidelpay\Modules\Application\Model {

    use OxidEsales\Eshop\Application\Model as OxidModel;

    class Order_parent extends OxidModel\Order
    {
    }

    class PaymentGateway_parent extends OxidModel\PaymentGateway
    {
    }

    class BasketItem_parent extends OxidModel\BasketItem
    {
    }
}
