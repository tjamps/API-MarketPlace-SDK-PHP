<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 04/11/2016
 * Time: 11:31
 */

namespace Sdk\Soap\Discussion\Response;


use Zend\Config\Reader\Xml;
use Sdk\Discussion\Message;
use Sdk\Discussion\OrderQuestion;
use Sdk\Soap\Common\AbstractResponse;

class GetOrderQuestionListResponse extends AbstractResponse
{
    /**
     * @var array
     */
    private $_dataResponse = null;

    /**
     * @var array
     */
    private $_orderQuestionList = null;

    /**
     * GetOrderQuestionListResponse constructor.
     * @param $response
     */
    public function __construct($response)
    {

        $reader = new Xml();
        $this->_dataResponse = $reader->fromString($response);

        // Check For error message
        if (!$this->_hasErrorMessage()) {

            /**
             * Global informations
             */
            $this->_setGlobalInformations();

            $this->_orderQuestionList = [];

            $this->_generateOrderQuestionListFromXML($this->_dataResponse['s:Body']['GetOrderQuestionListResponse']['GetOrderQuestionListResult']['OrderQuestionList']);
        }
    }

    /**
     * @return array
     */
    public function getOrderQuestionList()
    {
        return $this->_orderQuestionList;
    }

    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['GetOrderQuestionListResponse']['GetOrderQuestionListResult'];
        $this->tokenID = $objInfoResult['TokenId'];
        $this->sellerLogin = $objInfoResult['SellerLogin'];
    }

    /**
     * Check if the response has an error message
     * @return bool
     */
    private function _hasErrorMessage()
    {
        $objError = $this->_dataResponse['s:Body']['GetOrderQuestionListResponse']['GetOrderQuestionListResult']['ErrorMessage'];
        $this->errorList = [];

        if (isset($objError['_']) && \strlen($objError['_']) > 0) {

            $this->hasError = true;
            $this->errorMessage = $objError['_'];
            $this->errorList[] = $this->errorMessage;
            return true;
        }
        return false;
    }

    /**
     * @param $orderQuestionList
     */
    private function _generateOrderQuestionListFromXML($orderQuestionList)
    {
        foreach ($orderQuestionList['OrderQuestion'] as $questionXML) {

            $orderQuestion = new OrderQuestion($questionXML['Id']);

            $orderQuestion->setCloseDate($questionXML['CloseDate']);
            $orderQuestion->setCreationDate($questionXML['CreationDate']);
            $orderQuestion->setLastUpdatedDate($questionXML['LastUpdatedDate']);
            if (isset($questionXML['Status'])) {
                $orderQuestion->setStatus($questionXML['Status']);
            }
            if (isset($questionXML['Subject'])) {
                $orderQuestion->setSubject($questionXML['Subject']);
            }
            if (isset($questionXML['OrderNumber'])) {
                $orderQuestion->setOrderNumber($questionXML['OrderNumber']);
            }

            $manyMessage = true;
            foreach ($questionXML['Messages']['Message'] as $messageXML) {

                if (!isset($messageXML['Content'])) {
                    $manyMessage = false;
                    break;
                }
                $message = new Message();
                if (isset($messageXML['Content'])) {
                    $message->setContent($messageXML['Content']);
                }
                if (isset($messageXML['Sender'])) {
                    $message->setSender($messageXML['Sender']);
                }
                if (isset($messageXML['Timestamp'])) {
                    $message->setTimestamp($messageXML['Timestamp']);
                }
                $orderQuestion->addMessageToList($message);
            }

            if (!$manyMessage) {

                $message = new Message();
                if (isset($questionXML['Messages']['Message']['Content'])) {
                    $message->setContent($questionXML['Messages']['Message']['Content']);
                }
                if (isset($questionXML['Messages']['Message']['Sender'])) {
                    $message->setSender($questionXML['Messages']['Message']['Sender']);
                }
                if (isset($questionXML['Messages']['Message']['Timestamp'])) {
                    $message->setTimestamp($questionXML['Messages']['Message']['Timestamp']);
                }

                $orderQuestion->addMessageToList($message);
            }

            $this->_orderQuestionList[] = $orderQuestion;
        }
    }


}
