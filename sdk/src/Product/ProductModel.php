<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 20/10/2016
 * Time: 16:18
 */

namespace Sdk\Product;


class ProductModel
{
    /**
     * @var string
     */
    private $_categoryCode = null;

    /**
     * @var string
     */
    private $_name = null;

    /**
     * @var int
     */
    private $_modelId = 0;

    /**
     * @var array
     */
    private $_keyValueProperties = [];
	
	/**
     * @var array
     */
    private $_mandatoryModelProperties = [];

    /**
     * @var string
     */
    private $_productXmlStructure = null;

    /**
     * ProductModel constructor.
     * @param $modelD
     */
    public function __construct($modelD)
    {
        $this->_modelId = $modelD;
    }

    /**
     * @return string
     */
    public function getCategoryCode()
    {
        return $this->_categoryCode;
    }

    /**
     * @param string $categoryCode
     */
    public function setCategoryCode($categoryCode)
    {
        $this->_categoryCode = $categoryCode;
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
     * @return int
     */
    public function getModelId()
    {
        return $this->_modelId;
    }

    /**
     * @param $keyvalueObj
     *
     */
    public function addKeyValueProperty($keyvalueObj)
    {
        $this->_keyValueProperties[] = $keyvalueObj;
    }

    /**
     * @return array
     */
    public function getValueProperties()
    {
        return $this->_keyValueProperties;
    }

    /**
     * @param $mandatoryModelProperty
     *
     */
    public function addMandatoryModelProperty($mandatoryModelProperty)
    {
        $this->_mandatoryModelProperties[] = $mandatoryModelProperty;
    }

    /**
     * @return array
     */
    public function getMandatoryModelProperties()
    {
        return $this->_mandatoryModelProperties;
    }

    /**
     * @return string
     */
    public function getProductXmlStructure()
    {
        return $this->_productXmlStructure;
    }

    /**
     * @param string $productXmlStructure
     */
    public function setProductXmlStructure($productXmlStructure)
    {
        $this->_productXmlStructure = $productXmlStructure;
    }
}
