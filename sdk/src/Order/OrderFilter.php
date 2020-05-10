<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 11/10/2016
 * Time: 09:57
 */

namespace Sdk\Order;


use Sdk\Common\Filter;

class OrderFilter extends Filter
{
    private $_fetchOrderLines = false;

    private $_states = [];
    
    /*
     * @var boolean
     */
    private $_fetchParcels = false;
    
    /*
     * @var string
     */
    private $_orderType = OrderTypeEnum::None;
    
    /*
     * @var string
     */
    private $_partnerOrderRef = null;

    /*
     * @var array
     */
    private $_orderReferenceList = [];

    /**
     * @return boolean
     */
    public function isFetchOrderLines()
    {
        return $this->_fetchOrderLines;
    }

    /**
     * @param boolean $fetchOrderLines
     */
    public function setFetchOrderLines($fetchOrderLines)
    {
        $this->_fetchOrderLines = $fetchOrderLines;
    }

    /**
     * @return array
     */
    public function getStates()
    {
        return $this->_states;
    }

    /**
     * @param $state
     */
    public function addState($state)
    {
        $this->_states[] = $state;
    }
    
    /*
     * @return boolean
     */
    public function isFetchParcels()
    {
        return $this->_fetchParcels;
    }
    
    /*
     * @param $fetchParcel
     */
    public function setFetchParcels($fetchParcel)
    {
        $this->_fetchParcels = $fetchParcel;
    }
    
    /*
     * @return string
     */
    public function getOrderType()
    {
        return $this->_orderType;
    }
    
    /*
     * @param $orderType
     */
    public function setOrderType($orderType)
    {
        $this->_orderType = $orderType;
    }
    
    /*
     * @return string
     */
    public function getPartnerOrderRef()
    {
        return $this->_partnerOrderRef;
    }
    
    /*
     * @param $partnerOrderRef
     */
    public function setPartnerOrderRef($partnerOrderRef)
    {
        $this->_partnerOrderRef = $partnerOrderRef;
    }
    
    /*
     * @return array
     */
    public function getOrderReferenceList()
    {
        return $this->_orderReferenceList;
    }
    
    /*
     * @param $orderReference
     */
    public function addOrderReferenceToList($orderReference)
    {
        $this->_orderReferenceList[] = $orderReference;
    }
}
