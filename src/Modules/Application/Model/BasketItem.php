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

namespace D3\Heidelpay\Modules\Application\Model;

use OxidEsales\Eshop\Application\Model\Article;

/**
 */
class BasketItem extends BasketItem_parent
{
    /**
     * Sets/Overrides the "_oArticle" variable
     *
     * @param Article $oArticle
     */
    public function d3SetArticle(Article $oArticle)
    {
        $this->_oArticle = $oArticle;
    }
}
