<?php
/*
 * Created by CDiscount
 * Date: 04/05/2017
 */
 
namespace Sdk\Fulfilment;

class ProductActivationData
{
    /*
     * @var string
     */
    private $_productEAN = null;   
    
    /*
     * @var string
     */
    private $_sellerProductReference = null;
    
    /*
     * @var enum
     */
    private $_action = null;

    /*
     * @var int
     */
    private $_length = null;

    /*
     * @var int
     */
    private $_width = null;

    /*
     * @var int
     */
    private $_height = null;

    /*
     * @var int
     */
    private $_weight = null;
    
    /*
     * @return string
     */
    public function getProductEAN()
    {
        return $this->_productEAN;
    }

    /*
     * @param $productEAN
     */
    public function setProductEAN($productEAN)
    {
        $this->_productEAN=$productEAN;
    }
    
    /*
     * @return string
     */
    public function getSellerProductReference()
    {
        return $this->_sellerProductReference;
    }

    /*
     * @param $sellerProductReference
     */
    public function setSellerProductReference($sellerProductReference)
    {
        $this->_sellerProductReference=$sellerProductReference;
    }
    
    /*
     * @return enum
     */
    public function getAction()
    {
        return $this->_action;
    }

    /*
     * @param $action
     */
    public function setAction($action)
    {
        $this->_action=$action;
    }
    
    public function getLength()
    {
        return $this->_length;
    }

    /*
     * @param $length
     */
    public function setLength($length)
    {
        $this->_length=$length;
    }
    
     /*
     * @return int
     */
    public function getWidth()
    {
        return $this->_width;
    }

    /*
     * @param $width
     */
    public function setWidth($width)
    {
        $this->_width=$width;
    }
    
     /*
     * @return int
     */
    public function getHeight()
    {
        return $this->_height;
    }

    /*
     * @param $height
     */
    public function setHeight($height)
    {
        $this->_height = $height;
    }
    
     /*
     * @return int
     */
    public function getWeight()
    {
        return $this->_weight;
    }

    /*
     * @param $weight
     */
    public function setWeight($weight)
    {
        $this->_weight = $weight;
    }      
}
