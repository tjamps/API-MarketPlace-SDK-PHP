<?php

/*
 * Created by CDiscount
 * Date: 31/01/2017
 * Time: 15:13
 */
namespace Sdk\Soap\Order\Refund\Response;

use Zend\Config\Reader\Xml;
use Sdk\Order\Refund\CommercialGestureList;
use Sdk\Order\Refund\RefundInformationMessage;
use Sdk\Order\Refund\SellerRefundResult;
use Sdk\Order\Refund\SellerRefundResultList;
use Sdk\Soap\Common\AbstractResponse;
use Sdk\Soap\Common\SoapTools;

/**
 * class contains result of the request
 * @author mohammed.sajid
 */
class CreateRefundVoucherResponse extends AbstractResponse
{
    /*
     * @var array
     */
    private $_dataResponse = null;

    /*
     * @var array
     */
    private $_commercialGestureList = null;

    /*
     * @var string
     */
    private $_orderNumber = null;

    /*
     * @var array
     */
    private $_sellerRefundResult = null;

    public function __construct($response)
    {
        $reader = new Xml();
        $this->_dataResponse = $reader->fromString($response);
        $this->errorList = [];

        // Check For error message
        if ($this->isOperationSuccess($this->_dataResponse['s:Body']['CreateRefundVoucherResponse']['CreateRefundVoucherResult']))
        {
            $this->_setGlobalInformations();
            $this->_commercialGestureList = new CommercialGestureList();
            $this->_sellerRefundResult = new SellerRefundResultList();
            $this->_orderNumber = $this->_dataResponse['s:Body']['CreateRefundVoucherResponse']['CreateRefundVoucherResult']['OrderNumber'];

            $createRefundVoucherResult = $this->_dataResponse['s:Body']['CreateRefundVoucherResponse']['CreateRefundVoucherResult'];

            $this->generateCommercialGestureList($createRefundVoucherResult);
            $this->generateSellerRefundList($createRefundVoucherResult);
        }
    }

    /*
     * @return string
     */
    public function getOrderNumber()
    {
        return $this->_orderNumber;
    }

    /*
     * @return array
     */
    public function getCommercialGestures()
    {
        return $this->_commercialGestureList;
    }

    /*
     * @return array
     */
    public function getSellerRefunds()
    {
        return $this->_sellerRefundResult;
    }

    /**
     * Check if the response has an error message
     * @return bool
     */
    protected function isOperationSuccess($xml)
    {
        $objError = AbstractResponse::isOperationSuccess($xml);
        $objErrorCogesture = $xml['CommercialGestureList'];
        $objErrorSellerRefund = $xml['SellerRefundList'];

        if (isset($objError)) {
            $this->operationSuccess = $objError;
        }

        if(isset($objError) && !$objError &&  ((isset($objErrorCogesture) && \is_array($objErrorCogesture) && \count($objErrorCogesture) > 0 )
                || (isset($objErrorSellerRefund) && \is_array($objErrorSellerRefund) && \count($objErrorSellerRefund) > 0))){
            return true;
        }

        return $objError;
    }

     /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['CreateRefundVoucherResponse']['CreateRefundVoucherResult'];
        $this->tokenID = $objInfoResult['TokenId'];
        $this->sellerLogin = $objInfoResult['SellerLogin'];
    }

    /*
     * @param $createRefundVoucherResult
     * Fill the array _commercialGestureList from commercial gesture list response xml
     */
    private function generateCommercialGestureList($createRefundVoucherResult)
    {

        /*
         * \Sdk\Order\Refund\CommercialGestureList
         */
        foreach ($createRefundVoucherResult['CommercialGestureList'] as $refundInformationMessageXML) {
            $refundInformationMessage = new RefundInformationMessage();
            //errormessage
            if (isset($refundInformationMessageXML['ErrorMessage']['_']) && \strlen($refundInformationMessageXML['ErrorMessage']['_']) > 0 && !SoapTools::isSoapValueNull($refundInformationMessageXML['ErrorMessage'])) {
                $refundInformationMessage->setErrorMessage($refundInformationMessageXML['ErrorMessage']['_']);
                $refundInformationMessage->addErrorToList($refundInformationMessageXML['ErrorMessage']['_']);
                $this->errorList[] = $refundInformationMessageXML['ErrorMessage']['_'];
            }
            //operation succes
            if (isset($refundInformationMessageXML['OperationSuccess']['_']) && $refundInformationMessageXML['OperationSuccess']['_'] == 'true') {
                $refundInformationMessage->setOperationSuccess(true);
            }
            //amount
            if (isset($refundInformationMessageXML['Amount']) && !SoapTools::isSoapValueNull($refundInformationMessageXML['Amount'])) {
                $refundInformationMessage->setAmountResult($refundInformationMessageXML['Amount']);
            }
            //motive id
            if (isset($refundInformationMessageXML['MotiveId']) && !SoapTools::isSoapValueNull($refundInformationMessageXML['MotiveId'])) {
                $refundInformationMessage->setMotiveIdResult($refundInformationMessageXML['MotiveId']);
            }

            $this->_commercialGestureList->addRefundInformationMessageToList($refundInformationMessage);
        }
    }

    /*
     * @param $createRefundVoucherResult
     * Fill the _sellerRefundResult from seller refund list response xml
     */
    private function generateSellerRefundList($createRefundVoucherResult)
    {

        /*
         * \Sdk\Order\Refund\SellerRefundResultList
         */
        foreach ($createRefundVoucherResult['SellerRefundList'] as $sellerRefundResultXML) {

            $sellerRefundResult = new SellerRefundResult();
            //error message
            if (isset($sellerRefundResultXML['ErrorMessage']['_']) && \strlen($sellerRefundResultXML['ErrorMessage']['_']) > 0 && !SoapTools::isSoapValueNull($sellerRefundResultXML['ErrorMessage'])) {
                $sellerRefundResult->setErrorMessage($sellerRefundResultXML['ErrorMessage']['_']);
                $sellerRefundResult->addErrorToList($sellerRefundResultXML['ErrorMessage']['_']);
                $this->errorList[] = $sellerRefundResultXML['ErrorMessage']['_'];
            }
            //operation success
            if (isset($sellerRefundResultXML['OperationSuccess']['_']) && $sellerRefundResultXML['OperationSuccess']['_'] == 'true') {
                $sellerRefundResult->setOperationSuccess(true);
            }
            //Ean
            if (isset($sellerRefundResultXML['Ean']) && !SoapTools::isSoapValueNull($sellerRefundResultXML['Ean'])) {
                $sellerRefundResult->setEanResult($sellerRefundResultXML['Ean']);
            }
            //Motive
            if (isset($sellerRefundResultXML['Motive']) && !SoapTools::isSoapValueNull($sellerRefundResultXML['Motive'])) {
                $sellerRefundResult->setMotiveResult($sellerRefundResultXML['Motive']);
            }
            //SellerProductId
            if (isset($sellerRefundResultXML['SellerProductId']) && !SoapTools::isSoapValueNull($sellerRefundResultXML['SellerProductId'])) {
                $sellerRefundResult->setSellerProductIdResult($sellerRefundResultXML['SellerProductId']);
            }
            //Value
            if (isset($sellerRefundResultXML['Value']) && !SoapTools::isSoapValueNull($sellerRefundResultXML['Value'])) {
                $sellerRefundResult->setValueResult($sellerRefundResultXML['Value']);
            }

            $this->_sellerRefundResult->addSellerRefundResultToList($sellerRefundResult);
        }
    }
}
