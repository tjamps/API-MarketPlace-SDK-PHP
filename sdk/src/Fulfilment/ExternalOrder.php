<?php
/**
 * Created by El Ibaoui Otmane (SQLI)
 * Date: 5/05/2017
 * Time: 16:08
 */

namespace Sdk\Fulfilment;

use JsonSerializable;

/**
 * External Order
 */
class ExternalOrder implements JsonSerializable
{

    /**
     * @var ExternalCustomer
     */
    private $_externalCustomer = null;

    /**
     * @var array ExternalOrderLine
     */
    private $_externalOrderLine = [];

    /*
     * @var Int
     */
    private $_customerOrderNumber = null;

    /*
     * @var String
     */
    private $_corporation = null;

    /*
     * @var String
     */
    private $_comments = null;

    /*
     * @var string
     */
    private $_orderDate = null;

    /*
     * @var String
     */
    private $_shippingMode = null;

    /*
     * @var Long
     */
    private $_sellerId = null;

    /*
     * @var String
     */
    private $_shippingCode = null;

    /*
     * @var String
     */
    private $_siteConfigurationId = null;

    /*
     * @var String
     */
    private $_sellerEmail = null;

    /*
     * @var String
     */
    private $_siteId = null;

    /**
     * @return ExternalCustomer
     */
    public function getExternalCustomer()
    {
        return $this->_externalCustomer;
    }

    /**
     * @param ExternalCustomer $externalCustomer
     */
    public function setExternalCustomer($externalCustomer)
    {
        $this->_externalCustomer = $externalCustomer;
    }

    /**
     * @return array ExternalOrderLine
     */
    public function getExternalOrderLine()
    {
        return $this->_externalOrderLine;
    }

    /**
     * @param array ExternalOrderLine
     */
    public function setExternalOrderLine($externalOrderLine)
    {
        $this->_externalOrderLine[] = $externalOrderLine;
    }

    /**
     * @function addExternalOrderLine() ExternalOrderLine
     */
    public function addExternalOrderLine($orderLine)
    {
        $object = new ExternalOrderLine();
        $object->setProductEan($orderLine->getProductEan());
        $object->setProductReference($orderLine->getProductReference());
        $object->setQuantity($orderLine->getQuantity());
        $_externalOrderLine[] = $object;
    }

    /*
     * @return Int
     */
    public function getCustomerOrderNumber()
    {
        return $this->_customerOrderNumber;
    }

    /*
     * @param $customerOrderNumber
     */
    public function setCustomerOrderNumber($customerOrderNumber)
    {
        $this->_customerOrderNumber = $customerOrderNumber;
    }

    /*
     * @return String
     */
    public function getCorporation()
    {
        return $this->_corporation;
    }

    /*
     * @param $corporation
     */
    public function setCorporation($corporation)
    {
        $this->_corporation = $corporation;
    }

    /*
     * @return String
     */
    public function getComments()
    {
        return $this->_comments;
    }

    /*
     * @param $comments
     */
    public function setComments($comments)
    {
        $this->_comments = $comments;
    }

    /*
     * @return string
     */
    public function getOrderDate()
    {
        return $this->_orderDate;
    }

    /*
     * @param $orderDate
     */
    public function setOrderDate($orderDate)
    {
        $this->_orderDate = $orderDate;
    }

    /*
     * @return String
     */
    public function getShippingMode()
    {
        return $this->_shippingMode;
    }

    /*
     * @param $shippingMode
     */
    public function setShippingMode($shippingMode)
    {
        $this->_shippingMode = $shippingMode;
    }

    /*
     * @return String
     */
    public function getSellerId()
    {
        return $this->_sellerId;
    }

    /*
     * @param $sellerId
     */
    public function setSellerId($sellerId)
    {
        $this->_sellerId = $sellerId;
    }

    /*
     * @return String
     */
    public function getShippingCode()
    {
        return $this->_shippingCode;
    }

    /*
     * @param $shippingCode
     */
    public function setShippingCode($shippingCode)
    {
        $this->_shippingCode = $shippingCode;
    }

    /*
     * @return String
     */
    public function getSiteConfigurationId()
    {
        return $this->_siteConfigurationId;
    }

    /*
     * @param $siteConfigurationId
     */
    public function setSiteConfigurationId($siteConfigurationId)
    {
        $this->_siteConfigurationId = $siteConfigurationId;
    }

    /*
     * @return String
     */
    public function getSellerEmail()
    {
        return $this->_sellerEmail;
    }

    /*
     * @param $sellerEmail
     */
    public function setSellerEmail($sellerEmail)
    {
        $this->_sellerEmail = $sellerEmail;
    }

    /*
     * @return String
     */
    public function getSiteId()
    {
        return $this->_siteId;
    }

    /*
     * @param $siteId
     */
    public function setSiteId($siteId)
    {
        $this->_siteId = $siteId;
    }

    public function jsonSerialize()
    {
        return [
            'comments' => $this->_comments,
            'corporation' => $this->_corporation,
            'customerOrderNumber' => $this->_customerOrderNumber,
            'externalCustomer' => $this->_externalCustomer,
            'externalOrderLine' => $this->_externalOrderLine,
            'orderDate' => $this->_orderDate,
            'sellerEmail' => $this->_sellerEmail,
            'sellerId' => $this->_sellerId,
            'shippingCode' => $this->_shippingCode,
            'shippingMode' => $this->_shippingMode,
            'siteConfigurationId' => $this->_siteConfigurationId,
            'siteId' => $this->_siteId,
        ];
    }


}
