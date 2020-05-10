<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 09/11/2016
 * Time: 09:53
 */

namespace Sdk\Common;


use Sdk\Soap\Common\SoapTools;

class ReportLog
{

    /**
     * @var array
     */
    protected $_propertyList = null;
    /**
     * @var string
     */
    private $_logDate = null;

    /**
     * @var string
     */
    private $_SKU = null;

    /**
     * @var bool
     */
    private $_validated = false;

    /**
     * @return string
     */
    public function getLogDate()
    {
        return $this->_logDate;
    }

    /**
     * @param string $logDate
     */
    public function setLogDate($logDate)
    {
        if (!SoapTools::isSoapValueNull($logDate)) {
            $this->_logDate = $logDate;
        }
    }

    /**
     * @return string
     */
    public function getSKU()
    {
        return $this->_SKU;
    }

    /**
     * @param string $SKU
     */
    public function setSKU($SKU)
    {
        if (!SoapTools::isSoapValueNull($SKU)) {
            $this->_SKU = $SKU;
        }
    }

    /**
     * @return boolean
     */
    public function isValidated()
    {
        return $this->_validated;
    }

    /**
     * @param boolean $validated
     */
    public function setValidated($validated)
    {
        $this->_validated = $validated;
    }

    /**
     * @return array
     */
    public function getPropertyList()
    {
        return $this->_propertyList;
    }
}
