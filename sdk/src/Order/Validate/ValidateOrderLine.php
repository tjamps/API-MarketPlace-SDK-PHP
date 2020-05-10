<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 17/10/2016
 * Time: 13:11
 */

namespace Sdk\Order\Validate;

use Sdk\Order\AskingForReturnType;
use Sdk\Order\OrderLine;

class ValidateOrderLine extends OrderLine
{
    
    /*
     * @var enum
     */
    private $_typeOfReturn = AskingForReturnType::AskingForReturn;

    public function __construct($sellerProductId, $acceptationState, $productCondition)
    {
        parent::setSellerProductId($sellerProductId);
        parent::setProductCondition($productCondition);
        parent::setAcceptationState($acceptationState);
        parent::__construct(0);
    }
    
    /*
     * @return enum
     */
    public function getTypeOfReturn()
    {
        return $this->_typeOfReturn;
    }
    
    /*
     * @param $typeOfReturn Sdk\Order\AskingForReturnType
     */
    public function setTypeOfReturn($typeOfReturn)
    {
        $this->_typeOfReturn = $typeOfReturn;
    }
}
