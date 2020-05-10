<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 18/10/2016
 * Time: 10:46
 */

namespace Sdk\Order\Validate;

use Sdk\Order\Order;

class ValidateOrderResult extends Order
{

    private $_validated = false;

    /**
     * @var ValidateOrderLineResults
     */
    private $_validateOrderLineResults = null;

    /**
     * @param $validated
     */
    public function setValidated($validated)
    {
        $this->_validated = $validated;
    }

    /**
     * @return boolean
     */
    public function isValidated()
    {
        return $this->_validated;
    }

    /**
     * @return ValidateOrderLineResults
     */
    public function getValidateOrderLineResults()
    {
        return $this->_validateOrderLineResults;
    }

    /**
     * @param ValidateOrderLineResults $validateOrderLineResults
     */
    public function setValidateOrderLineResults($validateOrderLineResults)
    {
        $this->_validateOrderLineResults = $validateOrderLineResults;
    }


}
