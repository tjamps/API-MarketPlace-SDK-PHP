<?php
/**
 * Created by Cdiscount.
 * Date: 01/12/2016
 * Time: 15:46
 */

namespace Sdk\Soap\Order\Response;

use Zend\Config\Reader\Xml;
use Sdk\Delivey\Carrier;
use Sdk\Soap\Common\AbstractResponse;
use Sdk\Soap\Common\SoapTools;

class GetGlobalConfigurationResponse extends AbstractResponse
{

    /**
     * @var array
     */
    private $_dataResponse = null;

    /**
     * @var array
     */
    private $_carrierList = null;

    /**
     * GetGlobalConfigurationResponse constructor.
     * @param $response
     */
    public function __construct($response)
    {
        $reader = new Xml();
        $this->_dataResponse = $reader->fromString($response);

        $this->_carrierList = [];

        /** Check For error message */
        if (!$this->_hasErrorMessage()) {

            /**
             * Global informations
             */
            $this->_setGlobalInformations();

            $this->_carrierList = [];

            $this->_getCarrierListFromXML($this->_dataResponse['s:Body']['GetGlobalConfigurationResponse']['GetGlobalConfigurationResult']['CarrierList']);
        }
    }

    /**
     * @return array
     */
    public function getCarrierList()
    {
        return $this->_carrierList;
    }

    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['GetGlobalConfigurationResponse']['GetGlobalConfigurationResult'];
        $this->tokenID = $objInfoResult['TokenId'];
        $this->sellerLogin = $objInfoResult['SellerLogin'];
    }

    /**
     * Check if the response has an error message
     * @return bool
     */
    private function _hasErrorMessage()
    {
        $objError = $this->_dataResponse['s:Body']['GetGlobalConfigurationResponse']['GetGlobalConfigurationResult']['ErrorMessage'];
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
     * @param $carrierListXML
     */
    private function _getCarrierListFromXML($carrierListXML)
    {
        foreach ($carrierListXML['Carrier'] as $carrierXML) {

            if (isset($carrierXML['CarrierId']) && !SoapTools::isSoapValueNull($carrierXML['CarrierId'])) {

                $carrier = new Carrier($carrierXML['CarrierId']);
                if (isset($carrierXML['DefaultURL']) && !SoapTools::isSoapValueNull($carrierXML['DefaultURL'])) {
                    $carrier->setDefaultURL($carrierXML['DefaultURL']);
                }
                if (isset($carrierXML['Name']) && !SoapTools::isSoapValueNull($carrierXML['Name'])) {
                    $carrier->setName($carrierXML['Name']);
                }

                $this->_carrierList[] = $carrier;
            }
        }
    }
}
