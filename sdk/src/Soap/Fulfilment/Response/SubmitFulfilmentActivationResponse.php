<?php
/*
 * Created by CDiscount
 * Date: 04/05/2017
 */

namespace Sdk\Soap\Fulfilment\Response;

use Zend\Config\Reader\Xml;
use Sdk\Soap\Common\AbstractResponse;
use \Sdk\Soap\Common\SoapTools;
use Sdk\Fulfilment\SubmitFulfilmentActivationResult;

class SubmitFulfilmentActivationResponse extends AbstractResponse
{
    /**
     * @var array
     */
    private $_dataResponse = null;


    private $_submitFulfilmentActivationResult= null;

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
        if(isset($this->_dataResponse['s:Body']['SubmitFulfilmentActivationResponse']['SubmitFulfilmentActivationResult']))
        {
             $this->operationSuccess = $this->isOperationSuccess($this->_dataResponse['s:Body']['SubmitFulfilmentActivationResponse']['SubmitFulfilmentActivationResult']);
             if ($this->operationSuccess)
              {
                $this->_setGlobalInformations();
                $this->generateDepositIdResult();
              }
        }
    }

    public function getSubmitFulfilmentActivationResult()
    {
        return $this->_submitFulfilmentActivationResult;
    }

    /*
     * @param  $submitFulfilmentActivationResult \Sdk\Fulfilment\SubmitFulfilmentActivationResult
     */
     public function setSubmitFulfilmentActivationResult($submitFulfilmentActivationResult)
    {
        $this->_submitFulfilmentActivationResult=$submitFulfilmentActivationResult;
    }

    public function generateDepositIdResult()
    {
        $submitFulfilmentActivationResultXml = $this->_dataResponse['s:Body']['SubmitFulfilmentActivationResponse']['SubmitFulfilmentActivationResult'];

        $this->_submitFulfilmentActivationResult = new SubmitFulfilmentActivationResult();

        if (isset($submitFulfilmentSupplyOrderResultXml['ErrorMessage']['_']) && \strlen($submitFulfilmentActivationResultXml['ErrorMessage']['_']) > 0 && !SoapTools::isSoapValueNull($submitFulfilmentActivationResultXml['ErrorMessage']))
        {
            $this->_submitFulfilmentActivationResult->setErrorMessage($submitFulfilmentActivationResultXml['ErrorMessage']['_']);
            $this->_submitFulfilmentActivationResult->addErrorToList($submitFulfilmentActivationResultXml['ErrorMessage']['_']);
            $this->errorList[] = $submitFulfilmentActivationResultXml['ErrorMessage']['_'];
        }
        //operation success
        if (isset($submitFulfilmentActivationResultXml['OperationSuccess']['_']) && $submitFulfilmentActivationResultXml['OperationSuccess']['_'] == 'true')
        {
            $this->_submitFulfilmentActivationResult->setOperationSuccess(true);
        }

        //deposit id
        if (isset($submitFulfilmentActivationResultXml['DepositId']) && !SoapTools::isSoapValueNull($submitFulfilmentActivationResultXml['DepositId']))
        {
            $this->_submitFulfilmentActivationResult->setDepositId($submitFulfilmentActivationResultXml['DepositId']);
        }
    }

    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['SubmitFulfilmentActivationResponse']['SubmitFulfilmentActivationResult'];
        $this->tokenID = $objInfoResult['TokenId'];
        $this->sellerLogin = $objInfoResult['SellerLogin'];
    }

}
