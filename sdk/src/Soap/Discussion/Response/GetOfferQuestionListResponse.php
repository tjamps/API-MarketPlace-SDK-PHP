<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 04/11/2016
 * Time: 09:59
 */

namespace Sdk\Soap\Discussion\Response;


use Zend\Config\Reader\Xml;
use Sdk\Discussion\Message;
use Sdk\Discussion\OfferQuestion;
use Sdk\Soap\Common\AbstractResponse;

class GetOfferQuestionListResponse extends AbstractResponse
{
    /**
     * @var array|null
     */
    private $_dataResponse = null;

    /**
     * @var array
     */
    private $_offerQuestionList = null;

    /**
     * GetOfferQuestionListResponse constructor.
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

            $this->_offerQuestionList = [];

            if(isset($this->_dataResponse['s:Body']['GetOfferQuestionListResponse']['GetOfferQuestionListResult']['OfferQuestionList'])
            && isset($this->_dataResponse['s:Body']['GetOfferQuestionListResponse']['GetOfferQuestionListResult']['OfferQuestionList']['OfferQuestion'])) {
                $this->_generateOfferQuestionListFromXML($this->_dataResponse['s:Body']['GetOfferQuestionListResponse']['GetOfferQuestionListResult']['OfferQuestionList']);
            }
        }
    }

    /**
     * @return array
     */
    public function getOfferQuestionList()
    {
        return $this->_offerQuestionList;
    }

    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['GetOfferQuestionListResponse']['GetOfferQuestionListResult'];
        $this->tokenID = $objInfoResult['TokenId'];
        $this->sellerLogin = $objInfoResult['SellerLogin'];
    }

    /**
     * Check if the response has an error message
     * @return bool
     */
    private function _hasErrorMessage()
    {
        $objError = $this->_dataResponse['s:Body']['GetOfferQuestionListResponse']['GetOfferQuestionListResult']['ErrorMessage'];
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
     * @param $offerQuestionListXML
     */
    private function _generateOfferQuestionListFromXML($offerQuestionListXML)
    {
        foreach ($offerQuestionListXML['OfferQuestion'] as $questionXML) {

            $offerQuestion = new OfferQuestion($questionXML['Id']);

            $offerQuestion->setCloseDate($questionXML['CloseDate']);
            $offerQuestion->setCreationDate($questionXML['CreationDate']);
            $offerQuestion->setLastUpdatedDate($questionXML['LastUpdatedDate']);
            if (isset($questionXML['Status'])) {
                $offerQuestion->setStatus($questionXML['Status']);
            }
            if (isset($questionXML['Subject'])) {
                $offerQuestion->setSubject($questionXML['Subject']);
            }
            if (isset($questionXML['ProductEAN'])) {
                $offerQuestion->setProductEAN($questionXML['ProductEAN']);
            }
            if (isset($questionXML['ProductSellerReference'])) {
                $offerQuestion->setProductSellerReference($questionXML['ProductSellerReference']);
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
                $offerQuestion->addMessageToList($message);
            }

            if (!$manyMessage) {

                $message = new Message();
                $message->setContent($questionXML['Messages']['Message']['Content']);
                $message->setSender($questionXML['Messages']['Message']['Sender']);
                $message->setTimestamp($questionXML['Messages']['Message']['Timestamp']);
                $offerQuestion->addMessageToList($message);
            }

            $this->_offerQuestionList[] = $offerQuestion;
        }
    }
}
