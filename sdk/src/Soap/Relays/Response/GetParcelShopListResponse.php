<?php
/**
 * Created by Cdiscount.
 * Date: 02/12/2016
 * Time: 15:04
 */


namespace Sdk\Soap\Relays\Response;

use Zend\Config\Reader\Xml;
use Sdk\Soap\Common\AbstractResponse;

class GetParcelShopListResponse extends AbstractResponse
{

    public $_offerQuestionList;
    /**
     * @var array
     */
    private $_dataResponse = null;

    /**
     * @var array
     */
    private $_parcelShopList = null;

    /**
     * GetParcelShopListResponse constructor.
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

            $this->_parcelShopList = [];

            $this->_generateParcelShopListFromXML($this->_dataResponse['s:Body']['GetParcelShopListResponse']['GetParcelShopListResult']['ParcelShopList']);
        }
    }

    /**
     * @return array
     */
    public function getParcelShopList()
    {
        return $this->_parcelShopList;
    }

    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['GetParcelShopListResponse']['GetParcelShopListResult'];
        $this->tokenID = $objInfoResult['TokenId'];
        $this->sellerLogin = $objInfoResult['SellerLogin'];
    }

    /**
     * Check if the response has an error message
     * @return bool
     */
    private function _hasErrorMessage()
    {
        $objError = $this->_dataResponse['s:Body']['GetParcelShopListResponse']['GetParcelShopListResult']['ErrorMessage'];
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
     * @param $parcelShopListXML
     */
    private function _generateParcelShopListFromXML($parcelShopListXML)
    {
        $manyParcels = true;
        foreach ($parcelShopListXML['ParcelShop'] as $parcelShopXML) {

            if (!isset($parcelShopXML['City'])) {
                $manyParcels = false;
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

        if (!$manyParcels) {

            $message = new Message();
            $message->setContent($questionXML['Messages']['Message']['Content']);
            $message->setSender($questionXML['Messages']['Message']['Sender']);
            $message->setTimestamp($questionXML['Messages']['Message']['Timestamp']);
            $offerQuestion->addMessageToList($message);
        }

        $this->_offerQuestionList[] = $offerQuestion;
    }


}
