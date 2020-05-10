<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 09/11/2016
 * Time: 13:32
 */

namespace Sdk\Soap\Discussion\Response;


use Zend\Config\Reader\Xml;
use Sdk\Discussion\CloseDiscussionResult;
use Sdk\Soap\Common\AbstractResponse;
use Sdk\Soap\Common\SoapTools;

class CloseDiscussionListResponse extends AbstractResponse
{
    /**
     * @var array
     */
    private $_dataResponse = null;

    /**
     * @var array
     */
    private $_closeDiscussionResultList = null;

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

            $this->_closeDiscussionResultList = [];

            if (isset($this->_dataResponse['s:Body']['CloseDiscussionListResponse']['CloseDiscussionListResult']['CloseDiscussionResultList']) &&
                !SoapTools::isSoapValueNull($this->_dataResponse['s:Body']['CloseDiscussionListResponse']['CloseDiscussionListResult']['CloseDiscussionResultList'])
            ) {
                $this->_generateCloseDiscussionResultList($this->_dataResponse['s:Body']['CloseDiscussionListResponse']['CloseDiscussionListResult']['CloseDiscussionResultList']);
            }
        }
    }

    /**
     * @return array
     */
    public function getCloseDiscussionResultList()
    {
        return $this->_closeDiscussionResultList;
    }

    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['CloseDiscussionListResponse']['CloseDiscussionListResult'];
        $this->tokenID = $objInfoResult['TokenId'];
        $this->sellerLogin = $objInfoResult['SellerLogin'];
    }

    /**
     * Check if the response has an error message
     * @return bool
     */
    private function _hasErrorMessage()
    {
        $objError = $this->_dataResponse['s:Body']['CloseDiscussionListResponse']['CloseDiscussionListResult']['ErrorMessage'];
        $this->errorList = [];

        if (isset($objError['_']) && \strlen($objError['_']) > 0) {

            $this->hasError = true;
            $this->errorMessage = $objError['_'];
            $this->errorList[] = $this->errorMessage;
            return true;
        }
        return false;
    }

    private function _generateCloseDiscussionResultList($closeDiscussionResultListXML)
    {
        foreach ($closeDiscussionResultListXML['CloseDiscussionResult'] as $closeDiscussionXML) {

            $closeDiscussionResult = new CloseDiscussionResult((int) ($closeDiscussionXML['DiscussionId']));
            $closeDiscussionResult->setOperationStatus($closeDiscussionXML['OperationStatus']);
        }
    }
}
