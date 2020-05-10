<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 19/10/2016
 * Time: 17:03
 */

namespace Sdk\Product;

/**
 * Product identity class
 */
class ProductIdentity
{
    /**
     * @var string
     */
    private $_brandName = null;

    /**
     * @var string
     */
    private $_EAN = null;

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
    private $_fatherProductId = null;

    /**
     * @var string
     */
    private $_categoryCode = null;
    
    /**
     * @var string
     */
    private $_color = null;    
    
    /**
     * @var string
     */
    private $_errorMessage = null;
    
    /**
     * @var string
     */
    private $_hasError = null;
    
    /**
     * @var string
     */
    private $_imageURL = null;
    
    /**
     * @var string
     */
    private $_size = null;    

    /**
     * Product constructor.
     * @param $EAN
     */
    public function __construct($EAN)
    {
        $this->_EAN = $EAN;
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
    public function getEAN()
    {
        return $this->_EAN;
    }

    /**
     * @param string $EAN
     */
    public function setEAN($EAN)
    {
        $this->_EAN = $EAN;
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
    public function getFatherProductId()
    {
        return $this->_fatherProductId;
    }

    /**
     * @param string $fatherProductId
     */
    public function setFatherProductId($fatherProductId)
    {
        $this->_fatherProductId = $fatherProductId;
    }

    /**
     * @return string
     */
    public function getCategoryCode()
    {
        return $this->_categoryCode;
    }

    /**
     * @param string $category
     */
    public function setCategoryCode($category)
    {
        $this->_categoryCode = $category;
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->_color;
    }

    /**
     * @param string $color
     */
    public function setColor($color)
    {
        $this->_color = $color;
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->_errorMessage;
    }

    /**
     * @param string $errorMessage
     */
    public function setErrorMessage($errorMessage)
    {
        $this->_errorMessage = $errorMessage;
    }

    /**
     * @return string
     */
    public function getHasError()
    {
        return $this->_hasError;
    }

    /**
     * @param string $hasError
     */
    public function setHasError($hasError)
    {
        $this->_hasError = $hasError;
    }

    /**
     * @return string
     */
    public function getImageURL()
    {
        return $this->_imageURL;
    }

    /**
     * @param string $imageUrl
     */
    public function setImageURL($imageURL)
    {
        $this->_imageURL = $imageURL;
    }

    /**
     * @return string
     */
    public function getSize()
    {
        return $this->_size;
    }

    /**
     * @param string $size
     */
    public function setSize($size)
    {
        $this->_size = $size;
    }
}
