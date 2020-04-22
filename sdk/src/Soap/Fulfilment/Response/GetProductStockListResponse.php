<?php

namespace Sdk\Soap\Fulfilment\Response;

use InvalidArgumentException;
use Sdk\Fulfilment\ProductStock;
use Sdk\Soap\Common\AbstractResponse;
use Sdk\Soap\Common\SoapTools;
use Zend\Config\Reader\Xml;

class GetProductStockListResponse extends AbstractResponse
{
    /**
     * @var array
     */
    private $dataResponse = null;

    /**
     * @var array
     */
    private $barCodeList = null;

    /**
     * @var string
     */
    private $status = null;

    /**
     * @var string
     */
    private $totalProductCount = null;

    public function __construct($response)
    {
        $reader = new Xml();
        $this->dataResponse = $reader->fromString($response);
        $this->errorList = array();

        if (!isset($this->dataResponse['s:Body']['GetProductStockListResponse']['GetProductStockListResult'])) {
            throw new InvalidArgumentException(
                sprintf(
                    'Cannot get GetProductStockListResponse from server response, server responded with: "%s"',
                    $this->dataResponse
                )
            );
        }

        // Check For error message
        if ($this->isOperationSuccess(
                $this->dataResponse['s:Body']['GetProductStockListResponse']['GetProductStockListResult']
            )
            && !$this->hasErrorMessage()
        ) {
            $this->setGlobalInformations();
            $this->barCodeList = array();
            $this->generateProductStockList();
        }
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getTotalProductCount()
    {
        return $this->totalProductCount;
    }

    public function generateProductStockList()
    {
        $getProductStockListResult = $this->dataResponse['s:Body']['GetProductStockListResponse']['GetProductStockListResult'];

        $productStock = [];
        if (isset($getProductStockListResult['a:ProductStockList']['a:productStock'])) {
            $productStock = $getProductStockListResult['a:ProductStockList']['a:productStock'];

            if (isset($productStock['a:Ean'])) {
                $productStock = [$productStock];
            }
        }

        foreach ($productStock as $productStockXml) {
            $productStock = new ProductStock();

            $this->setProductStockProperty(
                $productStockXml,
                $productStock,
                'a:AverageWeeklySales',
                'setAverageWeeklySales'
            );
            $this->setProductStockProperty($productStockXml, $productStock, 'a:BlockedStock', 'setBlockedStock');
            $this->setProductStockProperty(
                $productStockXml,
                $productStock,
                'a:CurrentWeeklySales',
                'setCurrentWeeklySales'
            );
            $this->setProductStockProperty(
                $productStockXml,
                $productStock,
                'a:DamagedReturns',
                'setDamagedReturns'
            );
            $this->setProductStockProperty(
                $productStockXml,
                $productStock,
                'a:DeliveryDisputes',
                'setDeliveryDisputes'
            );
            $this->setProductStockProperty($productStockXml, $productStock, 'a:Ean', 'setEan');
            $this->setProductStockProperty($productStockXml, $productStock, 'a:FodStock', 'setFodStock');
            $this->setProductStockProperty(
                $productStockXml,
                $productStock,
                'a:ForecastingStockShortage',
                'setForecastingStockShortage'
            );
            $this->setProductStockProperty($productStockXml, $productStock, 'a:FrontStock', 'setFrontStock');
            $this->setProductStockProperty(
                $productStockXml,
                $productStock,
                'a:IncomingShipment',
                'setIncomingShipment'
            );
            $this->setProductStockProperty($productStockXml, $productStock, 'a:Libelle', 'setLibelle');
            $this->setProductStockProperty($productStockXml, $productStock, 'a:LogisticFees', 'setLogisticFees');
            $this->setProductStockProperty(
                $productStockXml,
                $productStock,
                'a:OngoingRecoveries',
                'setOngoingRecoveries'
            );
            $this->setProductStockProperty(
                $productStockXml,
                $productStock,
                'a:OrderInProgress',
                'setOrderInProgress'
            );
            $this->setProductStockProperty(
                $productStockXml,
                $productStock,
                'a:OverheadOutsizeFees',
                'setOverheadOutsizeFees'
            );
            $this->setProductStockProperty(
                $productStockXml,
                $productStock,
                'a:ProductConditionId',
                'setProductConditionId'
            );
            $this->setProductStockProperty($productStockXml, $productStock, 'a:ProductState', 'setProductState');
            $this->setProductStockProperty(
                $productStockXml,
                $productStock,
                'a:SellerReference',
                'setSellerReference'
            );
            $this->setProductStockProperty(
                $productStockXml,
                $productStock,
                'a:ShippableStock',
                'setShippableStock'
            );
            $this->setProductStockProperty($productStockXml, $productStock, 'a:Sku', 'setSku');
            $this->setProductStockProperty(
                $productStockXml,
                $productStock,
                'a:StockCategory',
                'setStockCategories'
            );
            $this->setProductStockProperty($productStockXml, $productStock, 'a:StockFees', 'setStockFees');
            $this->setProductStockProperty(
                $productStockXml,
                $productStock,
                'a:StockInWarehouse',
                'setStockInWarehouse'
            );
            $this->setProductStockProperty($productStockXml, $productStock, 'a:Warehouse', 'setWarehouse');
            $this->setProductStockProperty($productStockXml, $productStock, 'a:WarehouseCode', 'setWarehouseCode');


            $this->setProductStockBooleanProperty($productStockXml, $productStock, 'a:IsReferenced', 'setIsReferenced');

            $this->barCodeList[] = $productStock;
        }

    }

    /**
     * @return array
     */
    public function getProductStockList()
    {
        return $this->barCodeList;
    }

    /**
     * Set Token ID and Seller Login from XML response
     */
    private function setGlobalInformations()
    {
        $objInfoResult = $this->dataResponse['s:Body']['GetProductStockListResponse']['GetProductStockListResult'];
        $this->tokenID = $objInfoResult['TokenId'];
        $this->sellerLogin = $objInfoResult['SellerLogin'];
        $this->status = $objInfoResult['a:Status'];
        $this->totalProductCount = $objInfoResult['a:TotalProductCount'];
    }

    /**
     * Check if the XML response has an error message
     *
     * @return bool
     */
    private function hasErrorMessage()
    {
        $objError = $this->dataResponse['s:Body']['GetProductStockListResponse']['GetProductStockListResult']['ErrorMessage'];

        if (isset($objError['_']) && strlen($objError['_']) > 0) {

            $this->hasError = true;
            $this->errorMessage = $objError['_'];

            return true;
        }

        return false;
    }

    /**
     * @param array $productStockXml
     * @param ProductStock $productStock
     * @param string $property
     * @param string $method
     */
    private function setProductStockProperty($productStockXml, ProductStock $productStock, $property, $method)
    {
        if (isset($productStockXml[$property]) && !SoapTools::isSoapValueNull($productStockXml[$property])) {
            $productStock->{$method}($productStockXml[$property]);
        }
    }

    /**
     * @param array $productStockXml
     * @param ProductStock $productStock
     * @param string $property
     * @param string $method
     */
    private function setProductStockBooleanProperty($productStockXml, ProductStock $productStock, $property, $method)
    {
        if (isset($productStockXml[$property]) && !SoapTools::isSoapValueNull($productStockXml[$property])) {
            $productStock->{$method}($productStockXml[$property] === 'true');
        }
    }
}
