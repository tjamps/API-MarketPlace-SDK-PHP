<?php
/*
 * Created by CDiscount
 * Date: 04/05/2017
 */

namespace Sdk\Soap\Fulfilment\Response;

use Zend\Config\Reader\Xml;
use Sdk\Soap\Common\AbstractResponse;
use \Sdk\Soap\Common\SoapTools;
use Sdk\Fulfilment\SubmitFulfilmentOnDemandSupplyOrderResult;

class SubmitFulfilmentOnDemandSupplyOrderResponse extends AbstractResponse
{

    /**
     * @var array
     */
    private $_dataResponse = null;

    /*
     * @var SubmitFulfilmentOnDemandSupplyOrderResult
     */
    private $_submitFulfilmentOnDemandSupplyOrderResult= null;

    /*
     * SubmitFulfilmentOnDemandSupplyOrderResponse constructor
     * @param $response
     */
    public function __construct($response)
    {
        $reader = new Xml();
        $this->_dataResponse = $reader->fromString($response);
        $this->errorList = [];

        $this->operationSuccess = $this->isOperationSuccess($this->_dataResponse['s:Body']['SubmitFulfilmentOnDemandSupplyOrderResponse']['SubmitFulfilmentOnDemandSupplyOrderResult']);
        if ($this->operationSuccess)
        {
            $this->_setGlobalInformations();
            $this->generateDepositIdResult();
        }
    }

    /*
     * @return \Sdk\Fulfilment\SubmitFulfilmentOnDemandSupplyOrderResult
     */
    public function getSubmitFulfilmentOnDemandSupplyOrderResult()
    {
        return $this->_submitFulfilmentOnDemandSupplyOrderResult;
    }

    /*
     * @param  $submitFulfilmentOnDemandSupplyOrderResult
     */
     public function setSubmitFulfilmentOnDemandSupplyOrderResult($submitFulfilmentOnDemandSupplyOrderResult)
    {
        $this->_submitFulfilmentOnDemandSupplyOrderResult=$submitFulfilmentOnDemandSupplyOrderResult;
    }

    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['SubmitFulfilmentOnDemandSupplyOrderResponse']['SubmitFulfilmentOnDemandSupplyOrderResult'];
        $this->tokenID = $objInfoResult['TokenId'];
        $this->sellerLogin = $objInfoResult['SellerLogin'];
    }

    private function generateDepositIdResult()
    {
        $submitFulfilmentOnDemandSupplyOrderResultXml = $this->_dataResponse['s:Body']['SubmitFulfilmentOnDemandSupplyOrderResponse']['SubmitFulfilmentOnDemandSupplyOrderResult'];

            $this->_submitFulfilmentOnDemandSupplyOrderResult = new SubmitFulfilmentOnDemandSupplyOrderResult();
             //errorMessage and errorList
            if (isset($submitFulfilmentOnDemandSupplyOrderResultXml['ErrorMessage']['_']) && \strlen($submitFulfilmentOnDemandSupplyOrderResultXml['ErrorMessage']['_']) > 0 && !SoapTools::isSoapValueNull($submitFulfilmentOnDemandSupplyOrderResultXml['ErrorMessage']))
            {
                $this->_submitFulfilmentOnDemandSupplyOrderResult->setErrorMessage($submitFulfilmentOnDemandSupplyOrderResultXml['ErrorMessage']['_']);
                $this->_submitFulfilmentOnDemandSupplyOrderResult->addErrorToList($submitFulfilmentOnDemandSupplyOrderResultXml['ErrorMessage']['_']);
                $this->errorList[] = $submitFulfilmentOnDemandSupplyOrderResultXml['ErrorMessage']['_'];
            }
            //operation success
            if (isset($submitFulfilmentOnDemandSupplyOrderResultXml['OperationSuccess']['_']) && $submitFulfilmentOnDemandSupplyOrderResultXml['OperationSuccess']['_'] == 'true')
            {
                $this->_submitFulfilmentOnDemandSupplyOrderResult->setOperationSuccess(true);
            }

            //deposit id
            if (isset($submitFulfilmentOnDemandSupplyOrderResultXml['DepositId']) && !SoapTools::isSoapValueNull($submitFulfilmentOnDemandSupplyOrderResultXml['DepositId']))
            {
                $this->_submitFulfilmentOnDemandSupplyOrderResult->setDepositId($submitFulfilmentOnDemandSupplyOrderResultXml['DepositId']);
            }
    }
}
