<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 14/10/2016
 * Time: 13:29
 */

namespace Sdk\Parcel;


class Parcel
{
    /**
     * @var string
     */
    private $_customerNum = null;

    /**
     * @var string
     */
    private $_externalCarrierName = null;

    /**
     * @var string
     */
    private $_externalCarrierTrackingUrl = null;

    /**
     * @var bool
     */
    private $_customerReturn = false;

    /**
     * @var String
     */
    private $_parcelStatus = null;

    /**
     * @var string
     */
    private $_realCarrierCode = null;

    /**
     * @var ParcelItemList
     */
    private $_parcelItemList = null;
    
    /*
     * @var array
     */
    private $_trackingList = null;

    public function __construct()
    {
        $this->_parcelItemList = new ParcelItemList();
    }

    /**
     * @return string
     */
    public function getCustomerNum()
    {
        return $this->_customerNum;
    }

    /**
     * @param string $customerNum
     */
    public function setCustomerNum($customerNum)
    {
        $this->_customerNum = $customerNum;
    }

    /**
     * @return string
     */
    public function getExternalCarrierName()
    {
        return $this->_externalCarrierName;
    }

    /**
     * @param string $externalCarrierName
     */
    public function setExternalCarrierName($externalCarrierName)
    {
        $this->_externalCarrierName = $externalCarrierName;
    }

    /**
     * @return string
     */
    public function getExternalCarrierTrackingUrl()
    {
        return $this->_externalCarrierTrackingUrl;
    }

    /**
     * @param string $externalCarrierTrackingUrl
     */
    public function setExternalCarrierTrackingUrl($externalCarrierTrackingUrl)
    {
        $this->_externalCarrierTrackingUrl = $externalCarrierTrackingUrl;
    }

    /**
     * @return boolean
     */
    public function isCustomerReturn()
    {
        return $this->_customerReturn;
    }

    /**
     * @param boolean $customerReturn
     */
    public function setCustomerReturn($customerReturn)
    {
        $this->_customerReturn = $customerReturn;
    }

    /**
     * @return String
     */
    public function getParcelStatus()
    {
        return $this->_parcelStatus;
    }

    /**
     * @param String $parcelStatus
     */
    public function setParcelStatus($parcelStatus)
    {
        $this->_parcelStatus = $parcelStatus;
    }

    /**
     * @return string
     */
    public function getRealCarrierCode()
    {
        return $this->_realCarrierCode;
    }

    /**
     * @param string $realCarrierCode
     */
    public function setRealCarrierCode($realCarrierCode)
    {
        $this->_realCarrierCode = $realCarrierCode;
    }

    /**
     * @return ParcelItemList
     */
    public function getParcelItemList()
    {
        return $this->_parcelItemList;
    }
    
    /*
     * @return array of \Sdk\Parcel\Tracking
     */
    public function getTrackingList()
    {
        return $this->_trackingList;
    }
    
    /*
     * @var $trackingList \Sdk\Parcel\TrackingList
     */
    public function setTrackingList($trackingList)
    {
        $this->_trackingList = $trackingList;
    }
}
