<?php
/**
 * Created by El Ibaoui Otmane (SQLI)
 * Date: 05/05/2017
 * Time: 16:08
 */

namespace Sdk\Fulfilment;

use JsonSerializable;

/**
 * ExternalCustomer
 */
class ExternalCustomer implements JsonSerializable
{

    /*
     * @var String
     */
    private $_civility = null;

    /*
     * @var String
     */
    private $_customerFirstName = null;

    /*
     * @var String
     */
    private $_customerLastName = null;

    /*
     * @var String
     */
    private $_customerEmailAddress = null;

    /*
     * @var String
     */
    private $_shippingAddress = null;

    /*
     * @var String
     */
    private $_additionalShippingAddress = null;

    /*
     * @var String
     */
    private $_locality = null;

    /*
     * @var String
     */
    private $_shippingAddressTitle = null;

    /*
     * @var String
     */
    private $_shippingPostalCode = null;

    /*
     * @var String
     */
    private $_shippingCity = null;

    /*
     * @var String
     */
    private $_shippingCountry = null;

    /*
     * @var String
     */
    private $_landLinePhoneNumber = null;

    /*
     * @var String
     */
    private $_cellPhoneNumber = null;

    /*
     * @return string
     */
    public function getCivility()
    {
        return $this->_civility;
    }

    /*
     * @param $civility
     */
    public function setCivility($civility)
    {
        $this->_civility = $civility;
    }

    /*
     * @return string
     */
    public function getCustomerFirstName()
    {
        return $this->_customerFirstName;
    }

    /*
     * @param $customerFirstName
     */
    public function setCustomerFirstName($customerFirstName)
    {
        $this->_customerFirstName = $customerFirstName;
    }

    /*
     * @return String
     */
    public function getCustomerLastName()
    {
        return $this->_customerLastName;
    }

    /*
     * @param $customerLastName
     */
    public function setCustomerLastName($customerLastName)
    {
        $this->_customerLastName = $customerLastName;
    }

    /*
     * @return String
     */
    public function getCustomerEmailAddress()
    {
        return $this->_customerEmailAddress;
    }

    /*
     * @param $customerEmailAddress
     */
    public function setCustomerEmailAddress($customerEmailAddress)
    {
        $this->_customerEmailAddress = $customerEmailAddress;
    }

    /*
     * @return String
     */
    public function getShippingAddress()
    {
        return $this->_shippingAddress;
    }

    /*
     * @param $shippingAddress
     */
    public function setShippingAddress($shippingAddress)
    {
        $this->_shippingAddress = $shippingAddress;
    }

    /*
     * @return String
     */
    public function getAdditionalShippingAddress()
    {
        return $this->_additionalShippingAddress;
    }

    /*
     * @param $additionalShippingAddress
     */
    public function setAdditionalShippingAddress($additionalShippingAddress)
    {
        $this->_additionalShippingAddress = $additionalShippingAddress;
    }

    /*
     * @return String
     */
    public function getLocality()
    {
        return $this->_locality;
    }

    /*
     * @param $locality
     */
    public function setLocality($locality)
    {
        $this->_locality = $locality;
    }

    /*
     * @return String
     */
    public function getShippingAddressTitle()
    {
        return $this->_shippingAddressTitle;
    }

    /*
     * @param $shippingAddressTitle
     */
    public function setShippingAddressTitle($shippingAddressTitle)
    {
        $this->_shippingAddressTitle = $shippingAddressTitle;
    }

    /*
     * @return String
     */
    public function getShippingPostalCode()
    {
        return $this->_shippingPostalCode;
    }

    /*
     * @param $shippingPostalCode
     */
    public function setShippingPostalCode($shippingPostalCode)
    {
        $this->_shippingPostalCode = $shippingPostalCode;
    }

    /*
     * @return String
     */
    public function getShippingCity()
    {
        return $this->_shippingCity;
    }

    /*
     * @param $_shippingCity
     */
    public function setShippingCity($shippingCity)
    {
        $this->_shippingCity = $shippingCity;
    }

    /*
     * @return String
     */
    public function getShippingCountry()
    {
        return $this->_shippingCountry;
    }

    /*
     * @param $ShippingCountry
     */
    public function setShippingCountry($shippingCountry)
    {
        $this->_shippingCountry = $shippingCountry;
    }

    /*
     * @return String
     */
    public function getLandLinePhoneNumber()
    {
        return $this->_landLinePhoneNumber;
    }

    /*
     * @param $landLinePhoneNumber
     */
    public function setLandLinePhoneNumber($landLinePhoneNumber)
    {
        $this->_landLinePhoneNumber = $landLinePhoneNumber;
    }

    /*
     * @return String
     */
    public function getCellPhoneNumber()
    {
        return $this->_cellPhoneNumber;
    }

    /*
     * @param $cellPhoneNumber
     */
    public function setCellPhoneNumber($cellPhoneNumber)
    {
        $this->_cellPhoneNumber = $cellPhoneNumber;
    }

    public function jsonSerialize()
    {
        return [
            'additionalShippingAddress' => $this->_additionalShippingAddress,
            'cellPhoneNumber' => $this->_cellPhoneNumber,
            'civility' => $this->_civility,
            'customerEmailAddress' => $this->_customerEmailAddress,
            'customerFirstName' => $this->_customerFirstName,
            'customerLastName' => $this->_customerLastName,
            'landLinePhoneNumber' => $this->_landLinePhoneNumber,
            'locality' => $this->_locality,
            'shippingAddress' => $this->_shippingAddress,
            'shippingAddressTitle' => $this->_shippingAddressTitle,
            'shippingCity' => $this->_shippingCity,
            'shippingCountry' => $this->_shippingCountry,
            'shippingPostalCode' => $this->_shippingPostalCode,
        ];
    }


}
