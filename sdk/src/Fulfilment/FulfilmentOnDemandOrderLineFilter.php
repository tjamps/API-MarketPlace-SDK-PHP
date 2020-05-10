<?php
/* 
 * Created by Driss Kelmous
 * Date : 27/04/2017
 * Time : 15:46
 */
namespace Sdk\Fulfilment;

class FulfilmentOnDemandOrderLineFilter
{
    /**
     * @var string
     */
    private $_orderReference = null;
    
    /**
     * @var string
     */
    private $_productEan = null;
    
    /**
     * @var string
     */
    private $_warehouse = null;

    /*
     * FulfilmentOnDemandOrderLineRequest constructor
     * @param $orderReference, $productEan, $warehouse
     */
    public function __construct($orderReference,$productEan,$warehouse) 
    {
        $this->_orderReference = $orderReference;
        $this->_productEan = $productEan;
        $this->_warehouse = $warehouse;
    }
    
    /**
     * @return string
     */
    public function getOrderReference()
    {
        return $this->_orderReference;
    }

    /*
     * @param $orderReference
     */
    public function setOrderReference($orderReference)
    {
        $this->_orderReference = $orderReference;
    }
    
    /**
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

    /**
     * @var string
     */
     public function getWarehouse()
    {
        return $this->_warehouse;
    }

    /*
     * @param $warehouse
     */
    public function setWarehouse($warehouse)
    {
        $this->_warehouse = $warehouse;
    }
}
