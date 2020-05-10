<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 09/11/2016
 * Time: 15:24
 */

namespace Sdk\Soap\Mail\Response;


use Zend\Config\Reader\Xml;
use Sdk\Mail\DiscussionMail;
use Sdk\Soap\Common\AbstractResponse;
use Sdk\Soap\Common\SoapTools;

class GetDiscussionMailListResponse extends AbstractResponse
{
    /**
     * @var array|null
     */
    private $_dataResponse = null;

    /**
     * @var array
     */
    private $_discussionMailList = null;

    /**
     * @return array
     */
    public function getDiscussionMailList()
    {
        return $this->_discussionMailList;
    }

    /**
     * GetDiscussionMailListResponse constructor.
     * @param $response
     */
    public function __construct($response)
    {
        $reader = new Xml();
        $this->_dataResponse = $reader->fromString($response);

        /** Check For error message */
        if (!$this->_hasErrorMessage()) {

            /**
             * Global informations
             */
            $this->_setGlobalInformations();

            $this->_discussionMailList = [];

            $this->_generateDiscussionMailListFromXML($this->_dataResponse['s:Body']['GetDiscussionMailListResponse']['GetDiscussionMailListResult']['DiscussionMailList']);
        }
    }

    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['GetDiscussionMailListResponse']['GetDiscussionMailListResult'];
        $this->tokenID = $objInfoResult['TokenId'];
        $this->sellerLogin = $objInfoResult['SellerLogin'];
    }

    /**
     * Check if the response has an error message
     * @return bool
     */
    private function _hasErrorMessage()
    {
        $objError = $this->_dataResponse['s:Body']['GetDiscussionMailListResponse']['GetDiscussionMailListResult']['ErrorMessage'];
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
     * @param $discussionMailListXML
     */
    private function _generateDiscussionMailListFromXML($discussionMailListXML)
    {
        $manyMessage = true;
        foreach ($discussionMailListXML['DiscussionMail'] as $discussionMailXML) {

            if (!isset($discussionMailXML['DiscussionId'])) {
                $manyMessage = false;
                break;
            }

            $discussionMail = new DiscussionMail((int) ($discussionMailXML['DiscussionId']));
            if (isset($discussionMailXML['OperationStatus']) && !SoapTools::isSoapValueNull($discussionMailXML['OperationStatus'])) {
                $discussionMail->setOperationStatus($discussionMailXML['OperationStatus']);
            }
            if (isset($discussionMailXML['MailAddress']) && !SoapTools::isSoapValueNull($discussionMailXML['MailAddress'])) {
                $discussionMail->setMailAddress($discussionMailXML['MailAddress']);
            }
            $this->_discussionMailList[] = $discussionMail;
        }

        if (!$manyMessage) {
            $discussionMail = new DiscussionMail((int) ($discussionMailListXML['DiscussionMail']['DiscussionId']));
            if (isset($discussionMailListXML['DiscussionMail']['OperationStatus']) && !SoapTools::isSoapValueNull($discussionMailListXML['DiscussionMail']['OperationStatus'])) {
                $discussionMail->setOperationStatus($discussionMailListXML['DiscussionMail']['OperationStatus']);
            }
            if (isset($discussionMailListXML['DiscussionMail']['MailAddress']) && !SoapTools::isSoapValueNull($discussionMailListXML['DiscussionMail']['MailAddress'])) {
                $discussionMail->setMailAddress($discussionMailListXML['DiscussionMail']['MailAddress']);
            }
            $this->_discussionMailList[] = $discussionMail;
        }
    }
}
