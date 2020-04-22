<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 10/05/2017
 * Time: 09:52
 */

namespace Sdk\Fulfilment;

/**
 * Product Stock class
 */
class ProductStock
{

    /**
     * @var string
     */
    private $averageWeeklySales = null;

    /**
     * @var string
     */
    private $blockedStock = null;

    /**
     * @var string
     */
    private $currentWeeklySales = null;

    /**
     * @var string
     */
    private $damagedReturns = null;

    /**
     * @var string
     */
    private $deliveryDisputes = null;

    /**
     * @var string
     */
    private $ean = null;

    /**
     * @var string
     */
    private $fodStock = null;

    /**
     * @var string
     */
    private $forecastingStockShortage = null;

    /**
     * @var string
     */
    private $frontStock = null;

    /**
     * @var string
     */
    private $incomingShipment = null;

    /**
     * @var bool
     */
    private $isReferenced = null;

    /**
     * @var string
     */
    private $libelle = null;

    /**
     * @var string
     */
    private $logisticFees = null;

    /**
     * @var string
     */
    private $ongoingRecoveries = null;
    /**
     * @var string
     */
    private $orderInProgress = null;

    /**
     * @var string
     */
    private $overheadOutsizeFees = null;

    /**
     * @var string
     */
    private $productConditionId = null;

    /**
     * @var string
     */
    private $productState = null;

    /**
     * @var string
     */
    private $sellerReference = null;

    /**
     * @var string
     */
    private $shippableStock = null;

    /**
     * @var string
     */
    private $sku = null;

    /**
     * @var string
     */
    private $stockCategories = null;
    /**
     * @var string
     */
    private $stockFees = null;
    /**
     * @var string
     */
    private $stockInWarehouse = null;

    /**
     * @var string
     */
    private $warehouse = null;

    /**
     * @var string
     */
    private $warehouseCode = null;

    /**
     * @return string
     */
    public function getBlockedStock()
    {
        return $this->blockedStock;
    }

    /**
     * @param int $blockedStock
     */
    public function setBlockedStock($blockedStock)
    {
        $this->blockedStock = $blockedStock;
    }

    /**
     * @return string
     */
    public function getEan()
    {
        return $this->ean;
    }

    /**
     * @param int $ean
     */
    public function setEan($ean)
    {
        $this->ean = $ean;
    }

    /**
     * @return string
     */
    public function getFodStock()
    {
        return $this->fodStock;
    }

    /**
     * @param int $fodStock
     */
    public function setFodStock($fodStock)
    {
        $this->fodStock = $fodStock;
    }

    /**
     * @return string
     */
    public function getFrontStock()
    {
        return $this->frontStock;
    }

    /**
     * @param int $frontStock
     */
    public function setFrontStock($frontStock)
    {
        $this->frontStock = $frontStock;
    }

    /**
     * @return bool
     */
    public function getIsReferenced()
    {
        return $this->isReferenced;
    }

    /**
     * @param bool $isReferenced
     */
    public function setIsReferenced($isReferenced)
    {
        $this->isReferenced = $isReferenced;
    }

    /**
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param string $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * @return string
     */
    public function getSellerReference()
    {
        return $this->sellerReference;
    }

    /**
     * @param string $sellerReference
     */
    public function setSellerReference($sellerReference)
    {
        $this->sellerReference = $sellerReference;
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
    public function getStockInWarehouse()
    {
        return $this->stockInWarehouse;
    }

    /**
     * @param int $stockInWarehouse
     */
    public function setStockInWarehouse($stockInWarehouse)
    {
        $this->stockInWarehouse = $stockInWarehouse;
    }

    /**
     * @return string
     */
    public function getWarehouse()
    {
        return $this->warehouse;
    }

    /**
     * @param string $warehouse
     */
    public function setWarehouse($warehouse)
    {
        $this->warehouse = $warehouse;
    }

    /**
     * @return string
     */
    public function getWarehouseCode()
    {
        return $this->warehouseCode;
    }

    /**
     * @param string $warehouseCode
     */
    public function setWarehouseCode($warehouseCode)
    {
        $this->warehouseCode = $warehouseCode;
    }

    /**
     * @return string
     */
    public function getAverageWeeklySales()
    {
        return $this->averageWeeklySales;
    }

    /**
     * @param string $averageWeeklySales
     */
    public function setAverageWeeklySales($averageWeeklySales)
    {
        $this->averageWeeklySales = $averageWeeklySales;
    }

    /**
     * @return string
     */
    public function getCurrentWeeklySales()
    {
        return $this->currentWeeklySales;
    }

    /**
     * @param string $currentWeeklySales
     */
    public function setCurrentWeeklySales($currentWeeklySales)
    {
        $this->currentWeeklySales = $currentWeeklySales;
    }

    /**
     * @return string
     */
    public function getDamagedReturns()
    {
        return $this->damagedReturns;
    }

    /**
     * @param string $damagedReturns
     */
    public function setDamagedReturns($damagedReturns)
    {
        $this->damagedReturns = $damagedReturns;
    }

    /**
     * @return string
     */
    public function getDeliveryDisputes()
    {
        return $this->deliveryDisputes;
    }

    /**
     * @param string $deliveryDisputes
     */
    public function setDeliveryDisputes($deliveryDisputes)
    {
        $this->deliveryDisputes = $deliveryDisputes;
    }

    /**
     * @return string
     */
    public function getForecastingStockShortage()
    {
        return $this->forecastingStockShortage;
    }

    /**
     * @param string $forecastingStockShortage
     */
    public function setForecastingStockShortage($forecastingStockShortage)
    {
        $this->forecastingStockShortage = $forecastingStockShortage;
    }

    /**
     * @return string
     */
    public function getIncomingShipment()
    {
        return $this->incomingShipment;
    }

    /**
     * @param string $incomingShipment
     */
    public function setIncomingShipment($incomingShipment)
    {
        $this->incomingShipment = $incomingShipment;
    }

    /**
     * @return string
     */
    public function getLogisticFees()
    {
        return $this->logisticFees;
    }

    /**
     * @param string $logisticFees
     */
    public function setLogisticFees($logisticFees)
    {
        $this->logisticFees = $logisticFees;
    }

    /**
     * @return string
     */
    public function getOngoingRecoveries()
    {
        return $this->ongoingRecoveries;
    }

    /**
     * @param string $ongoingRecoveries
     */
    public function setOngoingRecoveries($ongoingRecoveries)
    {
        $this->ongoingRecoveries = $ongoingRecoveries;
    }

    /**
     * @return string
     */
    public function getOrderInProgress()
    {
        return $this->orderInProgress;
    }

    /**
     * @param string $orderInProgress
     */
    public function setOrderInProgress($orderInProgress)
    {
        $this->orderInProgress = $orderInProgress;
    }

    /**
     * @return string
     */
    public function getOverheadOutsizeFees()
    {
        return $this->overheadOutsizeFees;
    }

    /**
     * @param string $overheadOutsizeFees
     */
    public function setOverheadOutsizeFees($overheadOutsizeFees)
    {
        $this->overheadOutsizeFees = $overheadOutsizeFees;
    }

    /**
     * @return string
     */
    public function getProductConditionId()
    {
        return $this->productConditionId;
    }

    /**
     * @param string $productConditionId
     */
    public function setProductConditionId($productConditionId)
    {
        $this->productConditionId = $productConditionId;
    }

    /**
     * @return string
     */
    public function getProductState()
    {
        return $this->productState;
    }

    /**
     * @param string $productState
     */
    public function setProductState($productState)
    {
        $this->productState = $productState;
    }

    /**
     * @return string
     */
    public function getShippableStock()
    {
        return $this->shippableStock;
    }

    /**
     * @param string $shippableStock
     */
    public function setShippableStock($shippableStock)
    {
        $this->shippableStock = $shippableStock;
    }

    /**
     * @return string
     */
    public function getStockCategories()
    {
        return $this->stockCategories;
    }

    /**
     * @param string $stockCategories
     */
    public function setStockCategories($stockCategories)
    {
        $this->stockCategories = $stockCategories;
    }

    /**
     * @return string
     */
    public function getStockFees()
    {
        return $this->stockFees;
    }

    /**
     * @param string $stockFees
     */
    public function setStockFees($stockFees)
    {
        $this->stockFees = $stockFees;
    }


}
