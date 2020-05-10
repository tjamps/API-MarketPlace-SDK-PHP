<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 19/10/2016
 * Time: 11:55
 */

namespace Sdk\Product;


use Sdk\Soap\Common\SoapTools;

class CategoryTree
{

    /**
     * @var bool
     */
    private $_allowOfferIntegration = false;

    /**
     * @var bool
     */
    private $_allowProductIntegration = false;

    /**
     * @var string
     */
    private $_code = null;

    /**
     * @var string
     */
    private $_name = null;

    /**
     * @var boolean
     */
    private $_eanOptional = false;

    /**
     * @var array \Sdk\Product\CategoryTree
     */
    private $_childrenCategoryList = [];

    /**
     * @return boolean
     */
    public function isAllowOfferIntegration()
    {
        return $this->_allowOfferIntegration;
    }

    /**
     * @param boolean $allowOfferIntegration
     */
    public function setAllowOfferIntegration($allowOfferIntegration)
    {
        $this->_allowOfferIntegration = $allowOfferIntegration;
    }

    /**
     * @return boolean
     */
    public function isAllowProductIntegration()
    {
        return $this->_allowProductIntegration;
    }

    /**
     * @param boolean $allowProductIntegration
     */
    public function setAllowProductIntegration($allowProductIntegration)
    {
        $this->_allowProductIntegration = $allowProductIntegration;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->_code;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        if (!SoapTools::isSoapValueNull($code)) {
            $this->_code = $code;
        }
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
        if (!SoapTools::isSoapValueNull($name)) {
            $this->_name = $name;
        }
    }

    /**
     * @return boolean
     */
    public function isEanOptional()
    {
        return $this->_eanOptional;
    }

    /**
     * @param boolean $eanOptional
     */
    public function setEanOptional($eanOptional)
    {
        $this->_eanOptional = $eanOptional;
    }

    /**
     * @return array
     */
    public function getChildrenCategoryList()
    {
        return $this->_childrenCategoryList;
    }

    /**
     * @param $child \Sdk\Product\CategoryTree
     */
    public function addChild($child)
    {
        $this->_childrenCategoryList[] = $child;
    }
}
