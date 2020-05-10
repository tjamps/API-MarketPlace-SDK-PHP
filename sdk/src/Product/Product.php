<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 19/10/2016
 * Time: 17:03
 */

namespace Sdk\Product;


class Product
{
    /**
     * @var string
     */
    private $_brandName = null;

    /**
     * @var string
     */
    private $_EANList = null;

    /**
     * @var string
     */
    private $_name = null;

    /**
     * @var string \Sdk\Product\ProductTypeEnum
     */
    private $_productType = null;

    /**
     * @var string
     */
    private $_SKU = null;

    /**
     * @var string
     */
    private $_sellerProductId = null;

    /**
     * Product constructor.
     * @param $sku
     */
    public function __construct($sku)
    {
        $this->_SKU = $sku;
    }

    /**
     * @return string
     */
    public function getBrandName()
    {
        return $this->_brandName;
    }

    /**
     * @param string $brandName
     */
    public function setBrandName($brandName)
    {
        $this->_brandName = $brandName;
    }

    /**
     * @return string
     */
    public function getEANList()
    {
        return $this->_EANList;
    }

    /**
     * @param string $EANList
     */
    public function setEANList($EANList)
    {
        $this->_EANList = $EANList;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * @return string
     */
    public function getProductType()
    {
        return $this->_productType;
    }

    /**
     * @param string $productType
     */
    public function setProductType($productType)
    {
        $this->_productType = $productType;
    }

    /**
     * @return string
     */
    public function getSKU()
    {
        return $this->_SKU;
    }

    /**
     * @return string
     */
    public function getSellerProductId()
    {
        return $this->_sellerProductId;
    }

    /**
     * @param string $sellerProductId
     */
    public function setSellerProductId($sellerProductId)
    {
        $this->_sellerProductId = $sellerProductId;
    }

}
