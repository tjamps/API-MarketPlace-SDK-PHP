<?php
/*
 * Created by CDiscount
 * Date: 04/05/2017
 */

namespace Sdk\Soap\Fulfilment\Response;

use Zend\Config\Reader\Xml;
use Sdk\Soap\Common\AbstractResponse;
use \Sdk\Soap\Common\SoapTools;
use Sdk\Fulfilment\SubmitFulfilmentSupplyOrderResult;

class SubmitFulfilmentSupplyOrderResponse extends AbstractResponse
{

    /**
     * @var array
     */
    private $_dataResponse = null;

    /*
     * @var SubmitFulfilmentSupplyOrderResult
     */
    private $_submitFulfilmentSupplyOrderResult= null;

    /*
     * SubmitFulfilmentSupplyOrderResponse constructor
     * @param $response
     */
    public function __construct($response)
    {
        $reader = new Xml();
        $this->_dataResponse = $reader->fromString($response);
        $this->errorList = [];

        if(isset($this->_dataResponse['s:Body']['SubmitFulfilmentSupplyOrderResponse']['SubmitFulfilmentSupplyOrderResult']))
        {
            $this->operationSuccess = $this->isOperationSuccess($this->_dataResponse['s:Body']['SubmitFulfilmentSupplyOrderResponse']['SubmitFulfilmentSupplyOrderResult']);
            if ($this->operationSuccess)
             {
                 $this->_setGlobalInformations();
                 $this->generateDepositIdResult();
             }
        }

		if(isset($this->_dataResponse['s:Body']['s:Fault']['faultstring']))
		{
			$this->generateFaultResult();
		}
    }

    /*
     * @return \Sdk\Fulfilment\SubmitFulfilmentSupplyOrderResult
     */
    public function getSubmitFulfilmentSupplyOrderResult()
    {
        return $this->_submitFulfilmentSupplyOrderResult;
    }

    /*
     * @param  $submitFulfilmentSupplyOrderResult
     */
     public function setSubmitFulfilmentSupplyOrderResult($submitFulfilmentSupplyOrderResult)
    {
        $this->_submitFulfilmentSupplyOrderResult=$submitFulfilmentSupplyOrderResult;
    }

    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        if(isset($this->_dataResponse['s:Body']['SubmitFulfilmentSupplyOrderResponse']['SubmitFulfilmentSupplyOrderResult']))
        {
            $objInfoResult = $this->_dataResponse['s:Body']['SubmitFulfilmentSupplyOrderResponse']['SubmitFulfilmentSupplyOrderResult'];
            $this->tokenID = $objInfoResult['TokenId'];
            $this->sellerLogin = $objInfoResult['SellerLogin'];
        }
    }

	/**
     * Get Deposit id
     */
    private function generateDepositIdResult()
    {
       if(isset($this->_dataResponse['s:Body']['SubmitFulfilmentSupplyOrderResponse']['SubmitFulfilmentSupplyOrderResult']))
       {
            $submitFulfilmentSupplyOrderResultXml = $this->_dataResponse['s:Body']['SubmitFulfilmentSupplyOrderResponse']['SubmitFulfilmentSupplyOrderResult'];
       }

            $this->_submitFulfilmentSupplyOrderResult = new SubmitFulfilmentSupplyOrderResult();
             //errorMessage and errorList
            if (isset($submitFulfilmentSupplyOrderResultXml['ErrorMessage']['_']) && \strlen($submitFulfilmentSupplyOrderResultXml['ErrorMessage']['_']) > 0 && !SoapTools::isSoapValueNull($submitFulfilmentSupplyOrderResultXml['ErrorMessage']))
            {
                $this->_submitFulfilmentSupplyOrderResult->setErrorMessage($submitFulfilmentSupplyOrderResultXml['ErrorMessage']['_']);
                $this->_submitFulfilmentSupplyOrderResult->addErrorToList($submitFulfilmentSupplyOrderResultXml['ErrorMessage']['_']);
                $this->errorList[] = $submitFulfilmentSupplyOrderResultXml['ErrorMessage']['_'];
            }
            //operation success
            if (isset($submitFulfilmentSupplyOrderResultXml['OperationSuccess']['_']) && $submitFulfilmentSupplyOrderResultXml['OperationSuccess']['_'] == 'true')
            {
                $this->_submitFulfilmentSupplyOrderResult->setOperationSuccess(true);
            }
            //deposit id
            if (isset($submitFulfilmentSupplyOrderResultXml['DepositId']))
            {
                $this->_submitFulfilmentSupplyOrderResult->setDepositId($submitFulfilmentSupplyOrderResultXml['DepositId']);
            }
    }

	 /**
     * Get error list
     */
	 private function generateFaultResult()
    {
       if(isset($this->_dataResponse['s:Body']['s:Fault']['faultstring']['_']))
       {
            $submitFulfilmentSupplyOrderResultXml = $this->_dataResponse['s:Body']['s:Fault']['faultstring']['_'];

            $this->_submitFulfilmentSupplyOrderResult = new SubmitFulfilmentSupplyOrderResult();
             //errorMessage and errorList
			$this->_submitFulfilmentSupplyOrderResult->setErrorMessage($submitFulfilmentSupplyOrderResultXml);
			$this->_submitFulfilmentSupplyOrderResult->addErrorToList($submitFulfilmentSupplyOrderResultXml);
			$this->errorList[] = $submitFulfilmentSupplyOrderResultXml;

            //operation success
            $this->_submitFulfilmentSupplyOrderResult->setOperationSuccess(false);

        }
    }
}
