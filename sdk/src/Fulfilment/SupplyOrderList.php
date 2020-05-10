<?php

/**
 * Created by Zakaria Boukhris
 */

namespace Sdk\Fulfilment;

class SupplyOrderList
{
    /*
     * @var array
     */
    private $_supplyOrderList = [];
    
    /*
     * return array
     */
    public function getSupplyOrderList()
    {
        return $this->_supplyOrderList;
    }
    
    /**
     * @param $supplyOrderList
     */
    public function addSupplyOrderListToArray($supplyOrderList)
    {
        $this->_supplyOrderList[] = $supplyOrderList;
    }
}
