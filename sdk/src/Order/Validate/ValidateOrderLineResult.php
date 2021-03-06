<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 18/10/2016
 * Time: 14:17
 */

namespace Sdk\Order\Validate;


class ValidateOrderLineResult
{
    private $_errors = [];

    /**
     * @var bool
     */
    private $_updated = false;

    /**
     * @var string
     */
    private $_sellerProductId = null;

    /**
     * ValidateOrderLineResult constructor.
     * @param $sellerProductId
     */
    public function __construct($sellerProductId)
    {
        $this->_sellerProductId = $sellerProductId;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->_errors;
    }

    /**
     * @param $error string
     */
    public function addError($error)
    {
        $this->_errors[] = $error;
    }

    /**
     * @return boolean
     */
    public function isUpdated()
    {
        return $this->_updated;
    }

    /**
     * @param boolean $updated
     */
    public function setUpdated($updated)
    {
        $this->_updated = $updated;
    }

    /**
     * @return string
     */
    public function getSellerProductId()
    {
        return $this->_sellerProductId;
    }
}
