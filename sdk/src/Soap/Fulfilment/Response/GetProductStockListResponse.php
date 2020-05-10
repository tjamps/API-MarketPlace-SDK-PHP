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
        $this->errorList = [];

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
            $this->barCodeList = [];
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

        $data = [];
        if (isset($getProductStockListResult['a:ProductStockList']['a:ProductStock'])) {
            $data = $getProductStockListResult['a:ProductStockList']['a:ProductStock'];

            if (isset($data['a:Ean'])) {
                $data = [$data];
            }
        }

        foreach ($data as $xml) {
            $productStock = new ProductStock();

            $this->setProductStockProperty(
                $xml,
                $productStock,
                'a:AverageWeeklySales',
                'setAverageWeeklySales'
            );
            $this->setProductStockProperty($xml, $productStock, 'a:BlockedStock', 'setBlockedStock');
            $this->setProductStockProperty(
                $xml,
                $productStock,
                'a:CurrentWeeklySales',
                'setCurrentWeeklySales'
            );
            $this->setProductStockProperty(
                $xml,
                $productStock,
                'a:DamagedReturns',
                'setDamagedReturns'
            );
            $this->setProductStockProperty(
                $xml,
                $productStock,
                'a:DeliveryDisputes',
                'setDeliveryDisputes'
            );
            $this->setProductStockProperty($xml, $productStock, 'a:Ean', 'setEan');
            $this->setProductStockProperty($xml, $productStock, 'a:FodStock', 'setFodStock');
            $this->setProductStockProperty(
                $xml,
                $productStock,
                'a:ForecastingStockShortage',
                'setForecastingStockShortage'
            );
            $this->setProductStockProperty($xml, $productStock, 'a:FrontStock', 'setFrontStock');
            $this->setProductStockProperty(
                $xml,
                $productStock,
                'a:IncomingShipment',
                'setIncomingShipment'
            );
            $this->setProductStockProperty($xml, $productStock, 'a:Libelle', 'setLibelle');
            $this->setProductStockProperty($xml, $productStock, 'a:LogisticFees', 'setLogisticFees');
            $this->setProductStockProperty(
                $xml,
                $productStock,
                'a:OngoingRecoveries',
                'setOngoingRecoveries'
            );
            $this->setProductStockProperty(
                $xml,
                $productStock,
                'a:OrderInProgress',
                'setOrderInProgress'
            );
            $this->setProductStockProperty(
                $xml,
                $productStock,
                'a:OverheadOutsizeFees',
                'setOverheadOutsizeFees'
            );
            $this->setProductStockProperty(
                $xml,
                $productStock,
                'a:ProductConditionId',
                'setProductConditionId'
            );
            $this->setProductStockProperty($xml, $productStock, 'a:ProductState', 'setProductState');
            $this->setProductStockProperty(
                $xml,
                $productStock,
                'a:SellerReference',
                'setSellerReference'
            );
            $this->setProductStockProperty(
                $xml,
                $productStock,
                'a:ShippableStock',
                'setShippableStock'
            );
            $this->setProductStockProperty($xml, $productStock, 'a:Sku', 'setSku');
            $this->setProductStockProperty(
                $xml,
                $productStock,
                'a:StockCategory',
                'setStockCategories'
            );
            $this->setProductStockProperty($xml, $productStock, 'a:StockFees', 'setStockFees');
            $this->setProductStockProperty(
                $xml,
                $productStock,
                'a:StockInWarehouse',
                'setStockInWarehouse'
            );
            $this->setProductStockProperty($xml, $productStock, 'a:Warehouse', 'setWarehouse');
            $this->setProductStockProperty($xml, $productStock, 'a:WarehouseCode', 'setWarehouseCode');


            $this->setProductStockBooleanProperty($xml, $productStock, 'a:IsReferenced', 'setIsReferenced');

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

        if (isset($objError['_']) && \strlen($objError['_']) > 0) {

            $this->hasError = true;
            $this->errorMessage = $objError['_'];

            return true;
        }

        return false;
    }

    /**
     * @param array $xml
     * @param ProductStock $productStock
     * @param string $property
     * @param string $method
     */
    private function setProductStockProperty($xml, ProductStock $productStock, $property, $method)
    {
        if (isset($xml[$property]) && !SoapTools::isSoapValueNull($xml[$property])) {
            $productStock->{$method}($xml[$property]);
        }
    }

    /**
     * @param array $xml
     * @param ProductStock $productStock
     * @param string $property
     * @param string $method
     */
    private function setProductStockBooleanProperty($xml, ProductStock $productStock, $property, $method)
    {
        if (isset($xml[$property]) && !SoapTools::isSoapValueNull($xml[$property])) {
            $productStock->{$method}($xml[$property] === 'true');
        }
    }
}
