<?php
/* 
 * Created by Driss Kelmous
 * Date : 27/04/2017
 * Time : 15:46
 */
namespace Sdk\Fulfilment;

class FulfilmentOrderLine
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
    private $_productName = null;

    /**
     * @var string
     */
    private $_sellerProductReference = null;

    /**
     * @var string
     */
    private $_orderDate = null;

    /**
     * @var int
     */
    private $_quantity = null;

    /**
     * @var string
     */
    private $_latestWarehouseDeliveryDate = null;

    /**
     * @var string
     */
    private $_expectedCustomerDeliveryMin = null;

    /**
     * @var string
     */
    private $_expectedCustomerDeliveryMax = null;

    /**
     * @var string
     */
    private $_warehouse = null;

    /*
     * FulfilmentOrderLine constructor
     * @param 
     */
    public function __construct() 
    {
    }
    
    /**
     * @return string
     */
    public function getOrderReference()
    {
        return $this->_orderReference;
    }
    
    /**
     * @return string
     */
    public function getProductEan()
    {
        return $this->_productEan;
    }

    /**
     * @var string
     */
     public function getProductName()
    {
        return $this->_productName;
    }

    /**
     * @var string
     */
     public function getSellerProductReference()
    {
        return $this->_sellerProductReference;
    }

    /**
     * @var string
     */
     public function getOrderDate()
    {
        return $this->
        _orderDate;
    }

    /**
     * @var int
     */
     public function getQuantity()
    {
        return $this->_quantity;
    }

    /**
     * @var string
     */
     public function getLatestWarehouseDeliveryDate()
    {
        return $this->_latestWarehouseDeliveryDate;
    }

    /**
     * @var string
     */
     public function getExpectedCustomerDeliveryMin()
    {
        return $this->_expectedCustomerDeliveryMin;
    }

    /**
     * @var string
     */
     public function getExpectedCustomerDeliveryMax()
    {
        return $this->_expectedCustomerDeliveryMax;
    }

    /**
     * @var string
     */
     public function getWarehouse()
     {
        return $this->_warehouse;
     }

     /**
     * @var string
     */
     public function setWarehouse($warehouse)
     {
        $this->_warehouse = $warehouse;
     }

     /**
     * @var string
     */
     public function setExpectedCustomerDeliveryMin($expectedCustomerDeliveryMin)
     {
        $this->_expectedCustomerDeliveryMin = $expectedCustomerDeliveryMin;
     }

     /**
     * @var string
     */
     public function setExpectedCustomerDeliveryMax($expectedCustomerDeliveryMax)
     {
        $this->_expectedCustomerDeliveryMax = $expectedCustomerDeliveryMax;
     }

     /**
     * @var string
     */
     public function setLatestWarehouseDeliveryDate($latestWarehouseDeliveryDate)
     {
        $this->_latestWarehouseDeliveryDate = $latestWarehouseDeliveryDate;
     }

     /**
     * @var string
     */
     public function setProductName($productName)
     {
        $this->_productName = $productName;
     }

     /**
     * @var string
     */
     public function setSellerProductReference($sellerProductReference)
     {
        $this->_sellerProductReference = $sellerProductReference;
     }

     /**
     * @var string
     */
     public function setOrderDate($orderDate)
     {
        $this->_orderDate = $orderDate;
     }

     /**
     * @var string
     */
     public function setProductEan($productEan)
     {
        $this->_productEan = $productEan;
     }

     /**
     * @var string
     */
     public function setOrderReference($orderReference)
     {
        $this->_orderReference = $orderReference;
     }

     /**
     * @var string
     */
     public function setQuantity($quantity)
     {
        $this->_quantity = $quantity;
     }    
}
