<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 07/11/2016
 * Time: 17:46
 */

namespace Sdk\Offer;


class OfferBenchMark
{
    /**
     * @var float
     */
    private $_bestOfferPrice = 0.0;

    /**
     * @var string
     */
    private $_productCondition = null;

    /**
     * @var string
     */
    private $_productState = null;

    /**
     * @var float
     */
    private $_shippingCharges = 0.0;

    /**
     * @return float
     */
    public function getBestOfferPrice()
    {
        return $this->_bestOfferPrice;
    }

    /**
     * @param float $bestOfferPrice
     */
    public function setBestOfferPrice($bestOfferPrice)
    {
        $this->_bestOfferPrice = $bestOfferPrice;
    }

    /**
     * @return string
     */
    public function getProductCondition()
    {
        return $this->_productCondition;
    }

    /**
     * @param string $productCondition
     */
    public function setProductCondition($productCondition)
    {
        $this->_productCondition = $productCondition;
    }

    /**
     * @return string
     */
    public function getProductState()
    {
        return $this->_productState;
    }

    /**
     * @param string $productState
     */
    public function setProductState($productState)
    {
        $this->_productState = $productState;
    }

    /**
     * @return float
     */
    public function getShippingCharges()
    {
        return $this->_shippingCharges;
    }

    /**
     * @param float $shippingCharges
     */
    public function setShippingCharges($shippingCharges)
    {
        $this->_shippingCharges = $shippingCharges;
    }

}
