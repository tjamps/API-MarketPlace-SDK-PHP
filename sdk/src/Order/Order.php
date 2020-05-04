<?php

namespace Sdk\Order;

use Sdk\Customer\Customer;
use Sdk\Parcel\ParcelList;
use Sdk\Seller\Address;

class Order
{
    /**
     * @var string
     */
    private $orderNumber;

    /**
     * @var Address
     */
    private $billingAddress = null;
    /**
     * @var Address
     */
    private $shippingAddress = null;
    /**
     * @var Corporation
     */
    private $corporation = null;

    private $creationDate = null;
    /**
     * @var Customer
     */
    private $customer = null;
    /**
     * @var bool
     */
    private $hasClaims = false;
    /**
     * @var float
     */
    private $initialTotalAmount = 0.0;
    /**
     * @var float
     */
    private $initialTotalShippingChargesAmount = 0.0;
    /**
     * @var bool
     */
    private $isCLogistiqueOrder = false;

    /**
     * @var string
     */
    private $lastUpdatedDate = null;

    /**
     * @var string
     */
    private $modifiedDate = null;

    /**
     * @var OrderLineList
     */
    private $orderLineList = null;
    /**
     * @var string
     */
    private $shippingCode = null;
    /**
     * @var float
     */
    private $siteCommissionPromisedAmount = 0.0;
    /**
     * @var float
     */
    private $siteCommissionShippedAmount = 0.0;
    /**
     * @var float
     */
    private $siteCommissionValidatedAmount = 0.0;
    /**
     * @var OrderStatusEnum
     */
    private $status = OrderStatusEnum::None;
    /**
     * @var OrderStateEnum
     */
    private $orderState = null;
    /**
     * @var ValidationStatusEnum
     */
    private $validationStatus = ValidationStatusEnum::None;
    /**
     * @var float
     */
    private $shippedTotalAmount = 0.0;
    /**
     * @var float
     */
    private $shippedTotalShippingCharges = 0.0;
    /**
     * @var float
     */
    private $validatedTotalAmount = 0.0;
    /**
     * @var float
     */
    private $validatedTotalShippingCharges = 0.0;
    /**
     * @var int
     */
    private $visaCegid = 0;

    /**
     * @var bool
     */
    private $archiveParcelList = false;

    /**
     * @var ParcelList
     */
    private $parcelList = null;
    /**
     * @var string
     */
    private $modGesLog = null;
    /**
     * @var string PartnerOrderRef
     */
    private $partnerOrderRef = '';

    private $voucherList = null;



    /**
     * Order constructor.
     * @param $orderNumber string
     */
    public function __construct($orderNumber)
    {
        $this->orderNumber = $orderNumber;
    }

    /**
     * @return string
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * @return Address
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * @var string
     */
    //TODO passer en vraie date
    /**
     * @param Address $billingAddress
     */
    public function setBillingAddress($billingAddress)
    {
        $this->billingAddress = $billingAddress;
    }

    /**
     * @return Address
     */
    public function getShippingAddress()
    {
        return $this->shippingAddress;
    }

    /**
     * @param Address $shippingAddress
     */
    public function setShippingAddress($shippingAddress)
    {
        $this->shippingAddress = $shippingAddress;
    }

    /**
     * @return Corporation
     */
    public function getCorporation()
    {
        return $this->corporation;
    }

    /**
     * @param Corporation $corporation
     */
    public function setCorporation($corporation)
    {
        $this->corporation = $corporation;
    }

    /**
     * @return string
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param string $creationDate
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    /**
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param Customer $customer
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    /**
     * @return boolean
     */
    public function isHasClaims()
    {
        return $this->hasClaims;
    }

    /**
     * @param boolean $hasClaims
     */
    public function setHasClaims($hasClaims)
    {
        $this->hasClaims = $hasClaims;
    }

    /**
     * @return float
     */
    public function getInitialTotalAmount()
    {
        return $this->initialTotalAmount;
    }

    /**
     * @param float $initialTotalAmount
     */
    public function setInitialTotalAmount($initialTotalAmount)
    {
        $this->initialTotalAmount = $initialTotalAmount;
    }

    /**
     * @return float
     */
    public function getInitialTotalShippingChargesAmount()
    {
        return $this->initialTotalShippingChargesAmount;
    }

    /**
     * @param float $initialTotalShippingChargesAmount
     */
    public function setInitialTotalShippingChargesAmount($initialTotalShippingChargesAmount)
    {
        $this->initialTotalShippingChargesAmount = $initialTotalShippingChargesAmount;
    }

    /**
     * @return boolean
     */
    public function isIsCLogistiqueOrder()
    {
        return $this->isCLogistiqueOrder;
    }

    /**
     * @param boolean $isCLogistiqueOrder
     */
    public function setIsCLogistiqueOrder($isCLogistiqueOrder)
    {
        $this->isCLogistiqueOrder = $isCLogistiqueOrder;
    }

    /**
     * @return string
     */
    public function getLastUpdatedDate()
    {
        return $this->lastUpdatedDate;
    }

    /**
     * @param string $lastUpdatedDate
     */
    public function setLastUpdatedDate($lastUpdatedDate)
    {
        $this->lastUpdatedDate = $lastUpdatedDate;
    }

    /**
     * @return string
     */
    public function getModifiedDate()
    {
        return $this->modifiedDate;
    }

    /**
     * @param string $modifiedDate
     */
    public function setModifiedDate($modifiedDate)
    {
        $this->modifiedDate = $modifiedDate;
    }

    /**
     * @return OrderLineList
     */
    public function getOrderLineList()
    {
        return $this->orderLineList;
    }

    /**
     * @param OrderLineList $orderLineList
     */
    public function setOrderLineList($orderLineList)
    {
        $this->orderLineList = $orderLineList;
    }

    /**
     * @return string
     */
    public function getShippingCode()
    {
        return $this->shippingCode;
    }

    /**
     * @param string $shippingCode
     */
    public function setShippingCode($shippingCode)
    {
        $this->shippingCode = $shippingCode;
    }

    /**
     * @return float
     */
    public function getSiteCommissionPromisedAmount()
    {
        return $this->siteCommissionPromisedAmount;
    }

    /**
     * @param float $siteCommissionPromisedAmount
     */
    public function setSiteCommissionPromisedAmount($siteCommissionPromisedAmount)
    {
        $this->siteCommissionPromisedAmount = $siteCommissionPromisedAmount;
    }

    /**
     * @return float
     */
    public function getSiteCommissionShippedAmount()
    {
        return $this->siteCommissionShippedAmount;
    }

    /**
     * @param float $siteCommissionShippedAmount
     */
    public function setSiteCommissionShippedAmount($siteCommissionShippedAmount)
    {
        $this->siteCommissionShippedAmount = $siteCommissionShippedAmount;
    }

    /**
     * @return float
     */
    public function getSiteCommissionValidatedAmount()
    {
        return $this->siteCommissionValidatedAmount;
    }

    /**
     * @param float $siteCommissionValidatedAmount
     */
    public function setSiteCommissionValidatedAmount($siteCommissionValidatedAmount)
    {
        $this->siteCommissionValidatedAmount = $siteCommissionValidatedAmount;
    }

    /**
     * @return OrderStatusEnum
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param OrderStatusEnum $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string OrderStateEnum
     */
    public function getOrderState()
    {
        return $this->orderState;
    }

    /**
     * @param string $orderState
     */
    public function setOrderState($orderState)
    {
        $this->orderState = $orderState;
    }

    /**
     * @return ValidationStatusEnum
     */
    public function getValidationStatus()
    {
        return $this->validationStatus;
    }

    /**
     * @param ValidationStatusEnum $validationStatus
     */
    public function setValidationStatus($validationStatus)
    {
        $this->validationStatus = $validationStatus;
    }

    /**
     * @return float
     */
    public function getShippedTotalAmount()
    {
        return $this->shippedTotalAmount;
    }

    /**
     * @param float $shippedTotalAmount
     */
    public function setShippedTotalAmount($shippedTotalAmount)
    {
        $this->shippedTotalAmount = $shippedTotalAmount;
    }

    /**
     * @return float
     */
    public function getShippedTotalShippingCharges()
    {
        return $this->shippedTotalShippingCharges;
    }

    /**
     * @param float $shippedTotalShippingCharges
     */
    public function setShippedTotalShippingCharges($shippedTotalShippingCharges)
    {
        $this->shippedTotalShippingCharges = $shippedTotalShippingCharges;
    }

    /**
     * @return float
     */
    public function getValidatedTotalAmount()
    {
        return $this->validatedTotalAmount;
    }

    /**
     * @param float $validatedTotalAmount
     */
    public function setValidatedTotalAmount($validatedTotalAmount)
    {
        $this->validatedTotalAmount = $validatedTotalAmount;
    }

    /**
     * @return float
     */
    public function getValidatedTotalShippingCharges()
    {
        return $this->validatedTotalShippingCharges;
    }

    /**
     * @param float $validatedTotalShippingCharges
     */
    public function setValidatedTotalShippingCharges($validatedTotalShippingCharges)
    {
        $this->validatedTotalShippingCharges = $validatedTotalShippingCharges;
    }

    /**
     * @return int
     */
    public function getVisaCegid()
    {
        return $this->visaCegid;
    }

    /**
     * @param int $visaCegid
     */
    public function setVisaCegid($visaCegid)
    {
        $this->visaCegid = $visaCegid;
    }

    /**
     * @return boolean
     */
    public function isArchiveParcelList()
    {
        return $this->archiveParcelList;
    }

    /**
     * @param boolean $archiveParcelList
     */
    public function setArchiveParcelList($archiveParcelList)
    {
        $this->archiveParcelList = $archiveParcelList;
    }

    /**
     * @return ParcelList
     */
    public function getParcelList()
    {
        return $this->parcelList;
    }

    /**
     * @param $parcelList
     */
    public function setParcelList($parcelList)
    {
        $this->parcelList = $parcelList;
    }

    /**
     * @return string
     */
    public function getModGesLog()
    {
        return $this->modGesLog;
    }

    /**
     * @param $modGesLog
     */
    public function setModGesLog($modGesLog)
    {
        $this->modGesLog = $modGesLog;
    }

    /**
     * @return string
     */
    public function getPartnerOrderRef()
    {
        return $this->partnerOrderRef;
    }

    /**
     * @param string $partnerOrderRef
     */
    public function setPartnerOrderRef($partnerOrderRef)
    {
        $this->partnerOrderRef = $partnerOrderRef;
    }

    /**
     * @return array
     */
    public function getVoucherList()
    {
        return $this->voucherList;
    }

    /**
     * @param $voucherList \Sdk\Order\VoucherList
     */
    public function setVoucherList($voucherList)
    {
        $this->voucherList = $voucherList;
    }
}
