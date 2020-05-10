<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 14/11/2016
 * Time: 16:32
 */

namespace Sdk\Soap\Mail\Response;


use Zend\Config\Reader\Xml;
use Sdk\Soap\Common\AbstractResponse;

class GenerateDiscussionMailGuidResponse extends AbstractResponse
{
    /**
     * @var mixed[]|mixed
     */
    public $_discussionMailList;
    /**
     * @var array|null
     */
    private $_dataResponse = null;

    /**
     * @var array
     */
    private $_discussionMailGuidList = null;

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

            //$this->_generateDiscussionMailListFromXML($this->_dataResponse['s:Body']['GetDiscussionMailListResponse']['GetDiscussionMailListResult']['DiscussionMailList']);
        }
    }

    /**
     * @return array
     */
    public function getDiscussionMailGuidList()
    {
        return $this->_discussionMailGuidList;
    }

    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['GenerateDiscussionMailGuidResponse']['GenerateDiscussionMailGuidResult'];
        $this->tokenID = $objInfoResult['TokenId'];
        $this->sellerLogin = $objInfoResult['SellerLogin'];
    }

    /**
     * Check if the response has an error message
     * @return bool
     */
    private function _hasErrorMessage()
    {
        $objError = $this->_dataResponse['s:Body']['GenerateDiscussionMailGuidResponse']['GenerateDiscussionMailGuidResult']['ErrorMessage'];
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
    private function _generateDiscussionMailGuidFromXML($discussionMailListXML)
    {
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
