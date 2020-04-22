<?php

/*
 * Created by El Ibaoui Otmane (SQLI)
 * Date : 08/05/2017
 * Time : 17:46
 */
namespace Sdk\Soap\Fulfilment\Response;

use Sdk\Soap\Common\AbstractResponse;
use \Sdk\Fulfilment\ProductStockList;
use \Sdk\Fulfilment\ProductStockListMessage;
use \Sdk\Soap\Common\SoapTools;

class CreateExternalOrderResponse extends AbstractResponse
{
    /**
     * @var array
     */
    private $_dataResponse = null;

    /*
     * CreateExternalOrderResponse constructor
     * @param $response
     */
    public function __construct($response)
    {
        $reader = new \Zend\Config\Reader\Xml();
        $this->_dataResponse = $reader->fromString($response);
        // Check For Operation Success
        if ($this->isOperationSuccess($this->_dataResponse['s:Body']['CreateExternalOrderResponse']['CreateExternalOrderResult']))
        {
            $this->operationSuccess=true;
            $this->_setGlobalInformations();
        }
    }
    /**
     * Set Token ID and Seller Login from XML response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['CreateExternalOrderResponse']['CreateExternalOrderResult'];
        $this->tokenID = $objInfoResult['TokenId'];
        $this->sellerLogin = $objInfoResult['SellerLogin'];
    }

    /**
     * Check if the XML response has an error message
     *
     * @return bool
     */
    private function _hasErrorMessage()
    {
        $objError = $this->_dataResponse['s:Body']['CreateExternalOrderResponse']['CreateExternalOrderResult']['ErrorMessage'];

        if (isset($objError['_']) && strlen($objError['_']) > 0) {

            $this->hasError = true;
            $this->errorMessage = $objError['_'];
            return true;
        }
        return false;
    }
 }
