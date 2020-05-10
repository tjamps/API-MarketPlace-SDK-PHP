<?php
/*
 * Created by CDiscount
 * Date: 18/05/2017
 */

namespace Sdk\Soap\Fulfilment\Response;

use Zend\Config\Reader\Xml;
use Sdk\Soap\Common\AbstractResponse;
use \Sdk\Soap\Common\SoapTools;
use Sdk\Fulfilment\SubmitOfferStateActionResult;

class SubmitOfferStateActionResponse extends AbstractResponse
{

    /**
     * @var array
     */
    private $_dataResponse = null;

    /*
     * @var SubmitOfferStateActionResult
     */
    private $_submitOfferStateActionResult= null;

    /*
     * SubmitOfferStateActionResponse constructor
     * @param $response
     */
    public function __construct($response)
    {
        $reader = new Xml();
        $this->_dataResponse = $reader->fromString($response);
        $this->errorList = [];

        // Check For error message
        if(isset($this->_dataResponse['s:Body']['SubmitOfferStateActionResponse']['SubmitOfferStateActionResult']))
        {
            $this->operationSuccess = $this->isOperationSuccess($this->_dataResponse['s:Body']['SubmitOfferStateActionResponse']['SubmitOfferStateActionResult']);
            if ($this->operationSuccess)
            {
                $this->_setGlobalInformations();
                $this->generateResult();
            }
        }
    }

    /*
     * @return submitOfferStateActionResult
     */
    public function getSubmitOfferStateActionResult()
    {
        return $this->_submitOfferStateActionResult;
    }

    /*
     * @param  $submitOfferStateActionResult \Sdk\Fulfilment\SubmitOfferStateActionResult
     */
     public function setSubmitOfferStateActionResult($submitOfferStateActionResult)
    {
        $this->_submitOfferStateActionResult=$submitOfferStateActionResult;
    }

    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['SubmitOfferStateActionResponse']['SubmitOfferStateActionResult'];
        $this->tokenID = $objInfoResult['TokenId'];
        $this->sellerLogin = $objInfoResult['SellerLogin'];
    }

    private function generateResult()
    {
        $submitOfferStateActionResultXml = $this->_dataResponse['s:Body']['SubmitOfferStateActionResponse']['SubmitOfferStateActionResult'];

        $this->_submitOfferStateActionResult = new SubmitOfferStateActionResult();
         //errorMessage and errorList
            if (isset($submitOfferStateActionResultXml['ErrorMessage']['_']) && \strlen($submitOfferStateActionResultXml['ErrorMessage']['_']) > 0 && !SoapTools::isSoapValueNull($submitOfferStateActionResultXml['ErrorMessage']))
            {
                $this->_submitOfferStateActionResult->setErrorMessage($submitOfferStateActionResultXml['ErrorMessage']['_']);
                $this->_submitOfferStateActionResult->addErrorToList($submitOfferStateActionResultXml['ErrorMessage']['_']);
                $this->errorList[] = $submitOfferStateActionResultXml['ErrorMessage']['_'];
            }
            //operation success
            if (isset($submitOfferStateActionResultXml['OperationSuccess']['_']) && $submitOfferStateActionResultXml['OperationSuccess']['_'] == 'true')
            {
                $this->_submitOfferStateActionResult->setOperationSuccess(true);
            }
            else
            {
                $this->_submitOfferStateActionResult->setOperationSuccess(false);
            }
    }

}
