<?php
/*
 * Created by EQUIPE-SQLI
 * Date : 15/05/2017
 * Time : 08:46
 */

namespace Sdk\Soap\Fulfilment\Response;

use Zend\Config\Reader\Xml;
use Sdk\Soap\Common\AbstractResponse;
use \Sdk\Soap\Common\SoapTools;
use \Sdk\Fulfilment\FulfilmentActivationReportListResult;
use \Sdk\Fulfilment\FulfilmentActivationReport;
use \Sdk\Fulfilment\FulfilmentActivationReportDetails;

class GetFulfilmentActivationReportRequestXmlResponse extends AbstractResponse
{

     /**
     * @var array
     */
    private $_dataResponse = null;

    /*
     * @var fulfilmentActivationReportListResult
     */
    private $_fulfilmentActivationReportListResult = null;

    /*
     * SubmitFulfilmentSupplyOrderResponse constructor
     * @param $response
     */
    public function __construct($response)
    {
        $reader = new Xml();
        $this->_dataResponse = $reader->fromString($response);
        $this->errorList = [];

        // Check For error message
        if(isset($this->_dataResponse['s:Body']['GetFulfilmentActivationReportListResponse']['GetFulfilmentActivationReportListResult']))
        {
            $this->operationSuccess = $this->isOperationSuccess($this->_dataResponse['s:Body']['GetFulfilmentActivationReportListResponse']['GetFulfilmentActivationReportListResult']);
            if ($this->operationSuccess)
            {
                $this->_setGlobalInformations();
                $this->generateResult();
            }
         }
     }

    /*
     * @return fulfilmentActivationReportListResult
     */
    public function getFulfilmentActivationReportListResult()
    {
        return $this->_fulfilmentActivationReportListResult;
    }

    /*
     * @param $fulfilmentActivationReportListResult \Sdk\Fulfilment\FulfilmentActivationReportListResult
     */
     public function setFulfilmentSupplyOrderReportListResult($fulfilmentActivationReportListResult)
    {
        $this->_fulfilmentActivationReportListResult=$fulfilmentActivationReportListResult;
    }

    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['GetFulfilmentActivationReportListResponse']['GetFulfilmentActivationReportListResult'];
        $this->tokenID = $objInfoResult['TokenId'];
        $this->sellerLogin = $objInfoResult['SellerLogin'];
    }

    /**
     * Get activation report list result
     */
    private function generateResult()
    {

        $fulfilmentActivationReportListResult = $this->_dataResponse['s:Body']['GetFulfilmentActivationReportListResponse']['GetFulfilmentActivationReportListResult'];

        $this->_fulfilmentActivationReportListResult = new FulfilmentActivationReportListResult();

        if(isset($fulfilmentActivationReportListResult['FulfilmentActivationReportList']['FulfilmentActivationReport']))
        {
            $fulfilmentActivationReports = $fulfilmentActivationReportListResult['FulfilmentActivationReportList']['FulfilmentActivationReport'];

            if(isset($fulfilmentActivationReports['DepositId']))
            {
                $fulfilmentActivationReports = [$fulfilmentActivationReports];
            }
        }

        if(isset($fulfilmentActivationReports))
        {

            foreach ($fulfilmentActivationReports as $fulfilmentActivationReportItem)
            {
                $fulfilmentActivationReport = new FulfilmentActivationReport();

                if(isset($fulfilmentActivationReportItem['DepositId']) && !SoapTools::isSoapValueNull($fulfilmentActivationReportItem['DepositId']))
                {
                    $fulfilmentActivationReport->setDepositId($fulfilmentActivationReportItem['DepositId']);
                }

                if(isset($fulfilmentActivationReportItem['ReportDate']) && !SoapTools::isSoapValueNull($fulfilmentActivationReportItem['ReportDate']))
                {
                    $fulfilmentActivationReport->setReportDate($fulfilmentActivationReportItem['ReportDate']);
                }

                if(isset($fulfilmentActivationReportItem['NumberOfRemainingProductsToProcess']) && !SoapTools::isSoapValueNull($fulfilmentActivationReportItem['NumberOfRemainingProductsToProcess']))
                {
                    $fulfilmentActivationReport->setNumberOfRemainingProductsToProcess($fulfilmentActivationReportItem['NumberOfRemainingProductsToProcess']);
                }

                if(isset($fulfilmentActivationReportItem['NumberOfProductsInError']) && !SoapTools::isSoapValueNull($fulfilmentActivationReportItem['NumberOfProductsInError']))
                {
                    $fulfilmentActivationReport->setNumberOfProductsInError($fulfilmentActivationReportItem['NumberOfProductsInError']);
                }

                if(isset($fulfilmentActivationReportItem['NumberOfProducts']) && !SoapTools::isSoapValueNull($fulfilmentActivationReportItem['NumberOfProducts']))
                {
                    $fulfilmentActivationReport->setNumberOfProducts($fulfilmentActivationReportItem['NumberOfProducts']);
                }

                if(isset($fulfilmentActivationReportItem['NumberOfProcessedProducts']) && !SoapTools::isSoapValueNull($fulfilmentActivationReportItem['NumberOfProcessedProducts']))
                {
                    $fulfilmentActivationReport->setNumberOfProcessedProducts($fulfilmentActivationReportItem['NumberOfProcessedProducts']);
                }

                if(isset($fulfilmentActivationReportItem['NumberOfDeactivatedProducts']) && !SoapTools::isSoapValueNull($fulfilmentActivationReportItem['NumberOfDeactivatedProducts']))
                {
                    $fulfilmentActivationReport->setNumberOfDeactivatedProducts($fulfilmentActivationReportItem['NumberOfDeactivatedProducts']);
                }

                if(isset($fulfilmentActivationReportItem['NumberOfActivatedProducts']) && !SoapTools::isSoapValueNull($fulfilmentActivationReportItem['NumberOfActivatedProducts']))
                {
                    $fulfilmentActivationReport->setNumberOfActivatedProducts($fulfilmentActivationReportItem['NumberOfActivatedProducts']);
                }

                if(isset($fulfilmentActivationReportItem['DetailsList']['FulfilmentActivationReportDetails']) && !SoapTools::isSoapValueNull($fulfilmentActivationReportItem['DetailsList']['FulfilmentActivationReportDetails']))
                {
                    $FulfilmentActivationReportDetailsList = $fulfilmentActivationReportItem['DetailsList']['FulfilmentActivationReportDetails'];

                    if(isset($FulfilmentActivationReportDetailsList['ProductEan']))
                    {
                        $FulfilmentActivationReportDetailsList = [$FulfilmentActivationReportDetailsList];
                    }
                }

                if(isset($FulfilmentActivationReportDetailsList))
                {
                    foreach ($FulfilmentActivationReportDetailsList as $FulfilmentActivationReportDetailsItem)
                    {
                        $fulfilmentActivationReportDetails = new FulfilmentActivationReportDetails();

                        if(isset($FulfilmentActivationReportDetailsItem['Action']) && !SoapTools::isSoapValueNull($FulfilmentActivationReportDetailsItem['Action']))
                        {
                            $fulfilmentActivationReportDetails->setAction($FulfilmentActivationReportDetailsItem['Action']);
                        }

                        if(isset($FulfilmentActivationReportDetailsItem['ActionSuccess']) && !SoapTools::isSoapValueNull($FulfilmentActivationReportDetailsItem['ActionSuccess']))
                        {
                            $fulfilmentActivationReportDetails->setActionSuccess($FulfilmentActivationReportDetailsItem['ActionSuccess']);
                        }

                        if(isset($FulfilmentActivationReportDetailsItem['Description']) && !SoapTools::isSoapValueNull($FulfilmentActivationReportDetailsItem['Description']))
                        {
                            $fulfilmentActivationReportDetails->setDescription($FulfilmentActivationReportDetailsItem['Description']);
                        }

                        if(isset($FulfilmentActivationReportDetailsItem['Length']) && !SoapTools::isSoapValueNull($FulfilmentActivationReportDetailsItem['Length']))
                        {
                            $fulfilmentActivationReportDetails->setLength($FulfilmentActivationReportDetailsItem['Length']);
                        }

                        if(isset($FulfilmentActivationReportDetailsItem['Height']) && !SoapTools::isSoapValueNull($FulfilmentActivationReportDetailsItem['Height']))
                        {
                            $fulfilmentActivationReportDetails->setHeight($FulfilmentActivationReportDetailsItem['Height']);
                        }

                        if(isset($FulfilmentActivationReportDetailsItem['SKU']) && !SoapTools::isSoapValueNull($FulfilmentActivationReportDetailsItem['SKU']))
                        {
                            $fulfilmentActivationReportDetails->setSKU($FulfilmentActivationReportDetailsItem['SKU']);
                        }

                        if(isset($FulfilmentActivationReportDetailsItem['SellerProductReference']) && !SoapTools::isSoapValueNull($FulfilmentActivationReportDetailsItem['SellerProductReference']))
                        {
                            $fulfilmentActivationReportDetails->setSellerProductReference($FulfilmentActivationReportDetailsItem['SellerProductReference']);
                        }

                        if(isset($FulfilmentActivationReportDetailsItem['ProductEan']) && !SoapTools::isSoapValueNull($FulfilmentActivationReportDetailsItem['ProductEan']))
                        {
                            $fulfilmentActivationReportDetails->setProductEAN($FulfilmentActivationReportDetailsItem['ProductEan']);
                        }

                        if(isset($FulfilmentActivationReportDetailsItem['Weight']) && !SoapTools::isSoapValueNull($FulfilmentActivationReportDetailsItem['Weight']))
                        {
                            $fulfilmentActivationReportDetails->setWeight($FulfilmentActivationReportDetailsItem['Weight']);
                        }

                        if(isset($FulfilmentActivationReportDetailsItem['Width']) && !SoapTools::isSoapValueNull($FulfilmentActivationReportDetailsItem['Width']))
                        {
                            $fulfilmentActivationReportDetails->setWidth($FulfilmentActivationReportDetailsItem['Width']);
                        }

                        $fulfilmentActivationReport->addFulfilmentActivationReportDetails($fulfilmentActivationReportDetails);
                    }
                }

                $this->_fulfilmentActivationReportListResult->addFulfilmentActivationReport($fulfilmentActivationReport);

            }

        }
    }
}
