<?php
/*
 * Created by CDiscount
 * Date: 04/05/2017
 */

namespace Sdk\Fulfilment;

class FulfilmentOnDemandSupplyOrderRequest
{
    /*
     * @var array
     */
    private $_orderLineList = null;
    
    /*
     * FulfilmentOnDemandSupplyOrderRequest constructor
     */
    public function __construct() 
    {
        $this->_orderLineList = [];
    }
    
    /*
     * @return array
     */
    public function getOrderLineList()
    {
        return $this->_orderLineList;
    }

    /*
     * @param $orderLineList \Sdk\Fulfilment\FulfilmentOrdereLineRequest 
     */
    public function addOrderLineList($orderLineList)
    {
        $this->_orderLineList[] = $orderLineList;
    }
}
