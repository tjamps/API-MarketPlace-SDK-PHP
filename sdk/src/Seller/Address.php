<?php

namespace Sdk\Seller;

use Sdk\Soap\Common\SoapTools;

class Address
{

    private $address1 = null;
    private $address2 = null;
    private $apartmentNumber = null;
    private $building = null;
    private $city = null;
    /**
     * @var null
     */
    private $civility = null;
    private $companyName = null;
    private $country = null;
    private $county = null;
    private $firstName = null;
    private $instructions = null;
    private $lastName = null;
    private $placeName = null;
    private $relayId = null;
    private $street = null;
    private $zipCode = null;

    /**
     * @return string|null
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * @param string|null $address1
     */
    public function setAddress1($address1)
    {
        if (!SoapTools::isSoapValueNull($address1)) {
            $this->address1 = $address1;
        }
    }

    /**
     * @return string|null
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * @param string|null $address2
     */
    public function setAddress2($address2)
    {
        if (!SoapTools::isSoapValueNull($address2)) {
            $this->address2 = $address2;
        }
    }

    /**
     * @return string|null
     */
    public function getApartmentNumber()
    {
        return $this->apartmentNumber;
    }

    /**
     * @param string|null $apartmentNumber
     */
    public function setApartmentNumber($apartmentNumber)
    {
        if (!SoapTools::isSoapValueNull($apartmentNumber)) {
            $this->apartmentNumber = $apartmentNumber;
        }
    }

    /**
     * @return string|null
     */
    public function getBuilding()
    {
        return $this->building;
    }

    /**
     * @param string|null $building
     */
    public function setBuilding($building)
    {
        if (!SoapTools::isSoapValueNull($building)) {
            $this->building = $building;
        }
    }

    /**
     * @return string|null
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     */
    public function setCity($city)
    {
        if (!SoapTools::isSoapValueNull($city)) {
            $this->city = $city;
        }
    }

    /**
     * @return string|null
     */
    public function getCivility()
    {
        return $this->civility;
    }

    /**
     * @param string|null $civility
     */
    public function setCivility($civility)
    {
        if (!SoapTools::isSoapValueNull($civility)) {
            $this->civility = $civility;
        }
    }

    /**
     * @return string|null
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @param string|null $companyName
     */
    public function setCompanyName($companyName)
    {
        if (!SoapTools::isSoapValueNull($companyName)) {
            $this->companyName = $companyName;
        }
    }

    /**
     * @return string|null
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string|null $country
     */
    public function setCountry($country)
    {
        if (!SoapTools::isSoapValueNull($country)) {
            $this->country = $country;
        }
    }

    /**
     * @return string|null
     */
    public function getCounty()
    {
        return $this->county;
    }

    /**
     * @param string|null $county
     */
    public function setCounty($county)
    {
        if (!SoapTools::isSoapValueNull($county)) {
            $this->county = $county;
        }
    }

    /**
     * @return string|null
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string|null $firstName
     */
    public function setFirstName($firstName)
    {
        if (!SoapTools::isSoapValueNull($firstName)) {
            $this->firstName = $firstName;
        }
    }

    /**
     * @return string|null
     */
    public function getInstructions()
    {
        return $this->instructions;
    }

    /**
     * @param string|null $instructions
     */
    public function setInstructions($instructions)
    {
        if (!SoapTools::isSoapValueNull($instructions)) {
            $this->instructions = $instructions;
        }
    }

    /**
     * @return string|null
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string|null $lastName
     */
    public function setLastName($lastName)
    {
        if (!SoapTools::isSoapValueNull($lastName)) {
            $this->lastName = $lastName;
        }
    }

    /**
     * @return string|null
     */
    public function getPlaceName()
    {
        return $this->placeName;
    }

    /**
     * @param string|null $placeName
     */
    public function setPlaceName($placeName)
    {
        if (!SoapTools::isSoapValueNull($placeName)) {
            $this->placeName = $placeName;
        }
    }

    /**
     * @return string|null
     */
    public function getRelayId()
    {
        return $this->relayId;
    }

    /**
     * @param string|null $relayId
     */
    public function setRelayId($relayId)
    {
        if (!SoapTools::isSoapValueNull($relayId)) {
            $this->relayId = $relayId;
        }
    }

    /**
     * @return string|null
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string|null $street
     */
    public function setStreet($street)
    {
        if (!SoapTools::isSoapValueNull($street)) {
            $this->street = $street;
        }
    }

    /**
     * @return string|null
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * @param string|null $zipCode
     */
    public function setZipCode($zipCode)
    {
        if (!SoapTools::isSoapValueNull($zipCode)) {
            $this->zipCode = $zipCode;
        }
    }
}
