<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 15/11/2016
 * Time: 17:43
 */

namespace Sdk\Seller;


class SellerIndicator
{

    /**
     * @var string
     */
    private $_computationDate = null;

    /**
     * @var string
     */
    private $_description = null;

    /**
     * @var float
     */
    private $_threshold = 0.0;

    /**
     * @var string
     */
    private $_thresholdType = null;

    /**
     * @var float
     */
    private $_valueD30 = 0.0;

    /**
     * @var float
     */
    private $_valueD60 = 0.0;

    /**
     * @return string
     */
    public function getComputationDate()
    {
        return $this->_computationDate;
    }

    /**
     * @param string $computationDate
     */
    public function setComputationDate($computationDate)
    {
        $this->_computationDate = $computationDate;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->_description = $description;
    }

    /**
     * @return float
     */
    public function getThreshold()
    {
        return $this->_threshold;
    }

    /**
     * @param float $threshold
     */
    public function setThreshold($threshold)
    {
        $this->_threshold = $threshold;
    }

    /**
     * @return string
     */
    public function getThresholdType()
    {
        return $this->_thresholdType;
    }

    /**
     * @param string $thresholdType
     */
    public function setThresholdType($thresholdType)
    {
        $this->_thresholdType = $thresholdType;
    }

    /**
     * @return float
     */
    public function getValueD30()
    {
        return $this->_valueD30;
    }

    /**
     * @param float $valueD30
     */
    public function setValueD30($valueD30)
    {
        $this->_valueD30 = $valueD30;
    }

    /**
     * @return float
     */
    public function getValueD60()
    {
        return $this->_valueD60;
    }

    /**
     * @param float $valueD60
     */
    public function setValueD60($valueD60)
    {
        $this->_valueD60 = $valueD60;
    }
}
