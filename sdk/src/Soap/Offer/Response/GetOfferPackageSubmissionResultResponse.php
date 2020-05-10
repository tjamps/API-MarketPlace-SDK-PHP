<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 08/11/2016
 * Time: 17:50
 */

namespace Sdk\Soap\Offer\Response;


use Zend\Config\Reader\Xml;
use Sdk\Offer\OfferReportLog;
use Sdk\Offer\OfferReportPropertyLog;
use Sdk\Soap\Common\AbstractResponse;

class GetOfferPackageSubmissionResultResponse extends AbstractResponse
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
    private $_offerLogList = null;

    /**
     * @var bool
     */
    private $_packageImportHasErrors = false;

    /**
     * SubmitProductPackageResponse constructor.
     * @param $response
     */
    public function __construct($response)
    {

        $reader = new Xml();
        $this->_dataResponse = $reader->fromString($response);

        $this->_offerLogList = [];

        // Check For error message
        if (!$this->_hasErrorMessage()) {

            /**
             * Global informations
             */
            $this->_setGlobalInformations();

            if (isset($this->_dataResponse['s:Body']['GetOfferPackageSubmissionResultResponse']['GetOfferPackageSubmissionResultResult']['OfferLogList'])) {
                $this->_setImportInformationsFromXML($this->_dataResponse['s:Body']['GetOfferPackageSubmissionResultResponse']['GetOfferPackageSubmissionResultResult']['OfferLogList']);
            }
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
    public function getOfferLogList()
    {
        return $this->_offerLogList;
    }

    /**
     * @return boolean
     */
    public function isPackageImportHasErrors()
    {
        return $this->_packageImportHasErrors;
    }

    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['GetOfferPackageSubmissionResultResponse']['GetOfferPackageSubmissionResultResult'];
        $this->tokenID = $objInfoResult['TokenId'];
        $this->sellerLogin = $objInfoResult['SellerLogin'];
        $this->_packageId = $objInfoResult['PackageId'];
        $this->_packageIntegrationStatus = $objInfoResult['PackageIntegrationStatus'];
    }

    /**
     * Check if the response has an error message
     * @return bool
     */
    private function _hasErrorMessage()
    {
        $objError = $this->_dataResponse['s:Body']['GetOfferPackageSubmissionResultResponse']['GetOfferPackageSubmissionResultResult']['ErrorMessage'];
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
     * @param $offerLogXML
     */
    private function _setImportInformationsFromXML($offerLogXML)
    {
        $isMul = true;

        if (!isset($offerLogXML['OfferReportLog'])) {
            return;
        }

        foreach ($offerLogXML['OfferReportLog'] as $reportXML) {

            if (!isset($reportXML['LogDate'])) {
                $isMul = false;
                break;
            }

        }

        if (!$isMul) {

            $offerReportLog = new OfferReportLog();

            /** LogDate */
            $offerReportLog->setLogDate($offerLogXML['OfferReportLog']['LogDate']);

            /** ProductIntegrationStatus */
            $offerReportLog->setOfferIntegrationStatus($offerLogXML['OfferReportLog']['OfferIntegrationStatus']);

            /** Product EAN */
            $offerReportLog->setProductEan($offerLogXML['OfferReportLog']['ProductEan']);

            /** PropertyList - ProductReportPropertyLog */
            $offerReportPropertyLog = new OfferReportPropertyLog($offerLogXML['OfferReportLog']['PropertyList']['OfferReportPropertyLog']['PropertyCode']);
            $offerReportPropertyLog->setLogMessage($offerLogXML['OfferReportLog']['PropertyList']['OfferReportPropertyLog']['LogMessage']);
            $offerReportPropertyLog->setName($offerLogXML['OfferReportLog']['PropertyList']['OfferReportPropertyLog']['Name']);
            $offerReportPropertyLog->setPropertyError($offerLogXML['OfferReportLog']['PropertyList']['OfferReportPropertyLog']['PropertyError']);
            $offerReportLog->addOfferReportPropertyLog($offerReportPropertyLog);

            /** Seller Product ID */
            $offerReportLog->setSellerProductId($offerLogXML['OfferReportLog']['SellerProductId']);

            /** SKU */
            if (isset($offerLogXML['OfferReportLog']['SKU'])) {
                $offerReportLog->setSKU($offerLogXML['OfferReportLog']['SKU']);
            }

            /** Validated */
            if ($offerLogXML['OfferReportLog']['Validated'] == 'true') {
                $offerReportLog->setValidated(true);
            }

            $this->_offerLogList[] = $offerReportLog;
        }
    }
}
