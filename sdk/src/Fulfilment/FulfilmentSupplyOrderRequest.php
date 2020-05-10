<?php
/*
 * Created by CDiscount
 * Date: 04/05/2017
 */

namespace Sdk\Fulfilment;

class FulfilmentSupplyOrderRequest
{
    
    /*
     * @var array
     */
    private $_productList = null;
    
    /*
     * FulfilmentSupplyOrderRequest constructor
     */
    public function __construct() 
    {
        $this->_productList = [];
    }
    
    /*
     * @return array
     */
    public function getProductList()
    {
        return $this->_productList;
    }

    /*
     * @param $productList \Sdk\Fulfilment\FulfilmentProductDescription
     */
    public function addProductList($productList)
    {
        $this->_productList[] = $productList;
    }
}
