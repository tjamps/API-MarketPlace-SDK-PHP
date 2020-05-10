<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 08/11/2016
 * Time: 15:23
 */

namespace Sdk\Soap\Offer\Response;


use Zend\Config\Reader\Xml;
use Sdk\Soap\Common\AbstractResponse;
use Sdk\Soap\Common\SoapTools;

class SubmitOfferPackageResponse extends AbstractResponse
{

    /**
     * @var array
     */
    private $_dataResponse = null;

    /**
     * @var int
     */
    private $_packageId = 0;

    /**
     * @var string
     */
    private $_packageIntegrationStatus = null;

    /**
     * @var array
     */
    private $_productLogList = null;

    /**
     * SubmitOfferPackageResponse constructor.
     * @param $response
     */
    public function __construct($response)
    {

        $reader = new Xml();
        $this->_dataResponse = $reader->fromString($response);

        $this->_productLogList = [];

        // Check For error message
        if (!$this->_hasErrorMessage()) {

            /**
             * Global informations
             */
            $this->_setGlobalInformations();

            $this->_setImportInformationsFromXML($this->_dataResponse['s:Body']['SubmitOfferPackageResponse']['SubmitOfferPackageResult']);
        }
    }

    /**
     * @return int
     */
    public function getPackageId()
    {
        return $this->_packageId;
    }

    /**
     * @return string
     */
    public function getPackageIntegrationStatus()
    {
        return $this->_packageIntegrationStatus;
    }

    /**
     * @return array
     */
    public function getProductLogList()
    {
        return $this->_productLogList;
    }

    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['SubmitOfferPackageResponse']['SubmitOfferPackageResult'];
        $this->tokenID = $objInfoResult['TokenId'];
        $this->sellerLogin = $objInfoResult['SellerLogin'];
    }

    /**
     * Check if the response has an error message
     * @return bool
     */
    private function _hasErrorMessage()
    {
        $objError = $this->_dataResponse['s:Body']['SubmitOfferPackageResponse']['SubmitOfferPackageResult']['ErrorMessage'];
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
     * @param $submitProductPackageResult
     */
    private function _setImportInformationsFromXML($submitProductPackageResult)
    {
        $this->_packageId = $submitProductPackageResult['PackageId'];

        if (isset($submitProductPackageResult['PackageIntegrationStatus']) && !SoapTools::isSoapValueNull($submitProductPackageResult['PackageIntegrationStatus'])) {
            $this->_packageIntegrationStatus = $submitProductPackageResult['PackageIntegrationStatus'];
        }
        if (isset($submitProductPackageResult['ProductLogList']) && !SoapTools::isSoapValueNull($submitProductPackageResult['ProductLogList'])) {
            $this->_productLogList = $submitProductPackageResult['ProductLogList'];
        }
    }
}
