<?php

namespace Sdk\Order;

use Sdk\Soap\Common\SoapTools;

class OrderLine
{
    /**
     * @var string|null;
     */
    private $acceptationState;

    /**
     * @var string|null
     */
    private $categoryCode;

    /**
     * @var string|null
     */
    private $deliveryDateMax;

    /**
     * @var string|null
     */
    private $deliveryDateMin;

    /**
     * @var bool
     */
    private $hasClaim = false;

    /**
     * @var float
     */
    private $initialPrice = 0.0;

    /**
     * @var bool
     */
    private $isNegotiated = false;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string
     * @see ProductConditionEnum constants
     */
    private $productCondition;

    /**
     * @var string
     */
    private $productId;

    /**
     * @var float
     */
    private $purchasePrice = 0.0;
    /**
     * @var int
     */
    private $quantity = 0;

    /**
     * @var int
     */
    private $rowId = 0;

    /**
     * @var string
     */
    private $sellerProductId;

    /**
     * @var string|null
     */
    private $shippingDateMax;

    /**
     * @var string|null
     */
    private $shippingDateMin;

    /**
     * @var string
     */
    private $sku;
    /**
     * @var string
     */
    private $skuParent;
    /**
     * @var float
     */
    private $unitAdditionalShippingCharges = 0.0;
    /**
     * @var float
     */
    private $unitShippingCharges = 0.0;
    /**
     * @var bool
     */
    private $cdav = false;

    /**
     * @var string
     */
    private $productEan = '';

    /**
     * @var bool
     */
    private $productEanGenerated = false;

    /**
     * @var bool
     */
    private $refundShippingCharge = false;

    /**
     * @param string $productId
     */
    public function __construct($productId)
    {
        $this->productId = $productId;
    }

    /**
     * @return string
     */
    public function getAcceptationState()
    {
        return $this->acceptationState;
    }

    /**
     * @param string $acceptationState
     */
    public function setAcceptationState($acceptationState)
    {
        $this->acceptationState = $acceptationState;
    }

    /**
     * @return string
     */
    public function getCategoryCode()
    {
        return $this->categoryCode;
    }

    /**
     * @param string $categoryCode
     */
    public function setCategoryCode($categoryCode)
    {
        $this->categoryCode = $categoryCode;
    }

    /**
     * @return string
     */
    public function getDeliveryDateMax()
    {
        return $this->deliveryDateMax;
    }

    /**
     * @param string $deliveryDateMax
     */
    public function setDeliveryDateMax($deliveryDateMax)
    {
        $this->deliveryDateMax = $deliveryDateMax;
    }

    /**
     * @return string
     */
    public function getDeliveryDateMin()
    {
        return $this->deliveryDateMin;
    }

    /**
     * @param string $deliveryDateMin
     */
    public function setDeliveryDateMin($deliveryDateMin)
    {
        $this->deliveryDateMin = $deliveryDateMin;
    }

    /**
     * @return boolean
     */
    public function isHasClaim()
    {
        return $this->hasClaim;
    }

    /**
     * @param boolean $hasClaim
     */
    public function setHasClaim($hasClaim)
    {
        $this->hasClaim = $hasClaim;
    }

    /**
     * @return float
     */
    public function getInitialPrice()
    {
        return $this->initialPrice;
    }

    /**
     * @param float $initialPrice
     */
    public function setInitialPrice($initialPrice)
    {
        if (!SoapTools::isSoapValueNull($initialPrice)) {
            $this->initialPrice = $initialPrice;
        }
    }

    /**
     * @return boolean
     */
    public function isIsNegotiated()
    {
        return $this->isNegotiated;
    }

    /**
     * @param boolean $isNegotiated
     */
    public function setIsNegotiated($isNegotiated)
    {
        $this->isNegotiated = $isNegotiated;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getProductCondition()
    {
        return $this->productCondition;
    }

    /**
     * @param string $productCondition
     */
    public function setProductCondition($productCondition)
    {
        $this->productCondition = $productCondition;
    }

    /**
     * @return string
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @return float
     */
    public function getPurchasePrice()
    {
        return $this->purchasePrice;
    }

    /**
     * @param float $purchasePrice
     */
    public function setPurchasePrice($purchasePrice)
    {
        $this->purchasePrice = $purchasePrice;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getRowId()
    {
        return $this->rowId;
    }

    /**
     * @param int $rowId
     */
    public function setRowId($rowId)
    {
        $this->rowId = $rowId;
    }

    /**
     * @return string
     */
    public function getSellerProductId()
    {
        return $this->sellerProductId;
    }

    /**
     * @param string $sellerProductId
     */
    public function setSellerProductId($sellerProductId)
    {
        $this->sellerProductId = $sellerProductId;
    }

    /**
     * @return string
     */
    public function getShippingDateMax()
    {
        return $this->shippingDateMax;
    }

    /**
     * @param string $shippingDateMax
     */
    public function setShippingDateMax($shippingDateMax)
    {
        $this->shippingDateMax = $shippingDateMax;
    }

    /**
     * @return string
     */
    public function getShippingDateMin()
    {
        return $this->shippingDateMin;
    }

    /**
     * @param string $shippingDateMin
     */
    public function setShippingDateMin($shippingDateMin)
    {
        $this->shippingDateMin = $shippingDateMin;
    }

    /**
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    /**
     * @return string
     */
    public function getSkuParent()
    {
        return $this->skuParent;
    }

    /**
     * @param string $skuParent
     */
    public function setSkuParent($skuParent)
    {
        if (!SoapTools::isSoapValueNull($skuParent)) {
            $this->skuParent = $skuParent;
        }
    }

    /**
     * @return float
     */
    public function getUnitAdditionalShippingCharges()
    {
        return $this->unitAdditionalShippingCharges;
    }

    /**
     * @param float $unitAdditionalShippingCharges
     */
    public function setUnitAdditionalShippingCharges($unitAdditionalShippingCharges)
    {
        $this->unitAdditionalShippingCharges = $unitAdditionalShippingCharges;
    }

    /**
     * @return float
     */
    public function getUnitShippingCharges()
    {
        return $this->unitShippingCharges;
    }

    /**
     * @param float $unitShippingCharges
     */
    public function setUnitShippingCharges($unitShippingCharges)
    {
        $this->unitShippingCharges = $unitShippingCharges;
    }

    /**
     * @return boolean
     */
    public function isCdav()
    {
        return $this->cdav;
    }

    /**
     * @param boolean $cdav
     */
    public function setCdav($cdav)
    {
        $this->cdav = $cdav;
    }

    /**
     * @return string
     */
    public function getProductEan()
    {
        return $this->productEan;
    }

    /**
     * @param string $productEan
     */
    public function setProductEan($productEan)
    {
        $this->productEan = $productEan;
    }

    /**
     * @return boolean
     */
    public function isProductEanGenerated()
    {
        return $this->productEanGenerated;
    }

    /**
     * @param boolean $productEanGenerated
     */
    public function setProductEanGenerated($productEanGenerated)
    {
        $this->productEanGenerated = $productEanGenerated;
    }

    /**
     * @return boolean
     */
    public function isRefundShippingChargesResult()
    {
        return $this->refundShippingCharge;
    }

    /**
     * @param $refundShippingCharge
     */
    public function setRefundShippingCharge($refundShippingCharge)
    {
        $this->refundShippingCharge = $refundShippingCharge;
    }
}
