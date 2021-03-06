<?php
/**
 * Created by El Ibaoui Otmane (SQLI)
 * Date: 05/05/2017
 * Time: 16:08
 */

namespace Sdk\Fulfilment;

/**
 * Order Status Request
 */
class ExternalOrderLine
{
    /*
     * @var String
     */
    private $_productEan = null;   
    
    /*
     * @var String
     */
    private $_productReference = null;    

    /*
     * @var Int
     */
    private $_quantity = null;    

    /*
     * @var Long
     */
    private $_offerId = null;    

    /*
     * @var Byte
     */
    private $_productConditionId = null;    

    /*
     * @var Byte
     */
    private $_productState = null;    

    /*
     * @var String
     */
    private $_productId = null;    

    /*
     * @var String
     */
    private $_variantId = null;
    
    /*
     * @return string
     */
    public function getProductEan()
    {
        return $this->_productEan;
    }
    
    /*
     * @param $productEan
     */
    public function setProductEan($productEan)
    {
        $this->_productEan = $productEan;
    }
    
    /*
     * @return string
     */
    public function getProductReference()
    {
        return $this->_productReference;
    }
    
    /*
     * @param $productReference
     */
    public function setProductReference($productReference)
    {
        $this->_productReference = $productReference;
    }
    
    /*
     * @return Int
     */
    public function getQuantity()
    {
        return $this->_quantity;
    }
    
    /*
     * @param $quantity
     */
    public function setQuantity($quantity)
    {
        $this->_quantity = $quantity;
    }
    
    /*
     * @return Long
     */
    public function getOfferId()
    {
        return $this->_offerId;
    }
    
    /*
     * @param $offerId
     */
    public function setOfferId($offerId)
    {
        $this->_offerId = $offerId;
    }
    
    /*
     * @return Byte
     */
    public function getProductConditionId()
    {
        return $this->_productConditionId;
    }
    
    /*
     * @param $productConditionId
     */
    public function setProductConditionId($productConditionId)
    {
        $this->_productConditionId = $productConditionId;
    }
    
    /*
     * @return Byte
     */
    public function getProductState()
    {
        return $this->_productState;
    }
    
    /*
     * @param $productState
     */
    public function setProductState($productState)
    {
        $this->_productState = $productState;
    }
    
    /*
     * @return String
     */
    public function getProductId()
    {
        return $this->_productId;
    }
    
    /*
     * @param $productId
     */
    public function setProductId($productId)
    {
        $this->_productId = $productId;
    }
    
    /*
     * @return String
     */
    public function getVariantId()
    {
        return $this->_variantId;
    }
    
    /*
     * @param $variantId
     */
    public function setVariantId($variantId)
    {
        $this->_variantId = $variantId;
    }    
}
