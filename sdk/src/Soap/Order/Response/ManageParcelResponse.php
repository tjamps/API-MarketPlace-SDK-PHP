<?php

/*
 * Created by Cdiscount
 * Date : 19/01/2017
 * Time : 15:46
 */
namespace Sdk\Soap\Order\Response;

use Zend\Config\Reader\Xml;
use Sdk\Soap\Common\AbstractResponse;
use \Sdk\Order\ParcelActionResult;
use \Sdk\Order\ParcelActionResultList;
use \Sdk\Soap\Common\SoapTools;

class ManageParcelResponse extends AbstractResponse
{

    /**
     * @var array
     */
    private $_dataResponse = null;

    /*
     * @var array
     */
    private $_parcelActionsResultList = null;

    /*
     * ManageParcelResponse constructor
     * @param $response
     */
    public function __construct($response)
    {
        $reader = new Xml();
        $this->_dataResponse = $reader->fromString($response);
        $this->errorList = [];

        // Check For error message
        if ($this->isOperationSuccess($this->_dataResponse['s:Body']['ManageParcelResponse']['ManageParcelResult']))
        {
            $this->_setGlobalInformations();
            $this->_parcelActionsResultList = new ParcelActionResultList();
            $this->generateParcelActionResultList();
        }
    }

    /*
     * @return array
     */
    public function getParcelActionResults()
    {
        return $this->_parcelActionsResultList;
    }

     /**
     * Check if the response has an error message
     * @return bool
     */
    protected function isOperationSuccess($xml)
    {
        $objError = AbstractResponse::isOperationSuccess($xml);
        $objErrorParcel = $xml['ParcelActionResultList'];

        if (isset($objError)) {
            $this->operationSuccess = $objError;
        }

        if(isset($objError) && !$objError &&  isset($objErrorParcel) && \is_array($objErrorParcel) && \count($objErrorParcel) > 0 ){
            return true;
        }

        return $objError;
    }

    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['ManageParcelResponse']['ManageParcelResult'];
        $this->tokenID = $objInfoResult['TokenId'];
        $this->sellerLogin = $objInfoResult['SellerLogin'];
    }

    /*
     * Fill the array _parcelActionsResultList from XML response
     */
    private function generateParcelActionResultList()
    {
        $manageParcelResult = $this->_dataResponse['s:Body']['ManageParcelResponse']['ManageParcelResult'];

	/*
         * \Sdk\Order\ParcelActionResultList
         */
        foreach ($manageParcelResult['ParcelActionResultList'] as $parcelActionResultXml)
        {
         /*
          * NB : a ne pas ajouter sellerLogin et token id dans le sous classe parcelActionResult
          * par ce que ça existe dèja dans la classe manageParcelResult
          */

            $parcelActionResult = new ParcelActionResult();
            //errorMessage and errorList
            if (isset($parcelActionResultXml['ErrorMessage']['_']) && \strlen($parcelActionResultXml['ErrorMessage']['_']) > 0 && !SoapTools::isSoapValueNull($parcelActionResultXml['ErrorMessage']))
            {
                $parcelActionResult->setErrorMessage($parcelActionResultXml['ErrorMessage']['_']);
                $parcelActionResult->addErrorToList($parcelActionResultXml['ErrorMessage']['_']);
                $this->errorList[] = $parcelActionResultXml['ErrorMessage']['_'];
            }
            //operation success
            if (isset($parcelActionResultXml['OperationSuccess']['_']) && $parcelActionResultXml['OperationSuccess']['_'] == 'true')
            {
                $parcelActionResult->setOperationSuccess(true);
            }

            //action type
            if (isset($parcelActionResultXml['ActionType']) && !SoapTools::isSoapValueNull($parcelActionResultXml['ActionType']))
            {
                $parcelActionResult->setActionType($parcelActionResultXml['ActionType']);
            }
            //is action created
            if (isset($parcelActionResultXml['IsActionCreated']) && !SoapTools::isSoapValueNull($parcelActionResultXml['IsActionCreated']) && $parcelActionResultXml['IsActionCreated'] == 'true')
            {
                $parcelActionResult->setIsActionCreated(true);
            }
            //parcelNumber
            if (isset($parcelActionResultXml['ParcelNumber']) && !SoapTools::isSoapValueNull($parcelActionResultXml['ParcelNumber']))
            {
                $parcelActionResult->setParcelNumber($parcelActionResultXml['ParcelNumber']);
            }

            $this->_parcelActionsResultList->addParcelActionResultToArray($parcelActionResult);
        }
    }
}
