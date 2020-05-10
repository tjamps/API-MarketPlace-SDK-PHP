<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 27/09/2016
 * Time: 15:20
 */

namespace Sdk\Seller;


class Seller
{
    private $_email = null;

    /**
     * @var
     */
    private $_isAvailable = null;

    private $_login = null;

    private $_mobileNumber = null;

    private $_phoneNumber = null;

    private $_sellerAddress = null;

    private $_shopName = null;

    private $_shopUrl = null;

    private $_siretNumber = null;

    private $_state = null;

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return mixed
     */
    public function getIsAvailable()
    {
        return $this->_isAvailable;
    }

    /**
     * @param mixed $isAvailable
     */
    public function setIsAvailable($isAvailable)
    {
        $this->_isAvailable = $isAvailable;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->_login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->_login = $login;
    }

    /**
     * @return mixed
     */
    public function getMobileNumber()
    {
        return $this->_mobileNumber;
    }

    /**
     * @param mixed $mobileNumber
     */
    public function setMobileNumber($mobileNumber)
    {
        $this->_mobileNumber = $mobileNumber;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->_phoneNumber;
    }

    /**
     * @param mixed $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->_phoneNumber = $phoneNumber;
    }

    /**
     * @return Address
     */
    public function getSellerAddress()
    {
        return $this->_sellerAddress;
    }

    /**
     * @param null $sellerAdress
     */
    public function setSellerAddress($sellerAdress)
    {
        $this->_sellerAddress = $sellerAdress;
    }

    /**
     * @return null
     */
    public function getShopName()
    {
        return $this->_shopName;
    }

    /**
     * @param null $shopName
     */
    public function setShopName($shopName)
    {
        $this->_shopName = $shopName;
    }

    /**
     * @return null
     */
    public function getShopUrl()
    {
        return $this->_shopUrl;
    }

    /**
     * @param null $shopUrl
     */
    public function setShopUrl($shopUrl)
    {
        $this->_shopUrl = $shopUrl;
    }

    /**
     * @return null
     */
    public function getSiretNumber()
    {
        return $this->_siretNumber;
    }

    /**
     * @param null $siretNumber
     */
    public function setSiretNumber($siretNumber)
    {
        $this->_siretNumber = $siretNumber;
    }

    /**
     * @return null
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * @param null $state
     */
    public function setState($state)
    {
        $this->_state = $state;
    }
}
