<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 18/10/2016
 * Time: 14:17
 */

namespace Sdk\Order\Validate;


class ValidateOrderLineResults
{
    /**
     * @var array \Sdk\Order\Validate\ValidateOrderLineResult
     */
    private $_validateOrderLineResults = [];

    /**
     * @return array
     */
    public function getValidateOrderLineResultList()
    {
        return $this->_validateOrderLineResults;
    }

    /**
     * @param $orderLineResult \Sdk\Order\Validate\ValidateOrderLineResult
     */
    public function addValidateOrderLineResult($orderLineResult)
    {
       $this->_validateOrderLineResults[] = $orderLineResult;
    }

}
