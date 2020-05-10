<?php

/**
 * Created by CDiscount
 * Date: 01/02/2017
 * Time: 11:04
 */
namespace Sdk\Order\Refund;

/**
 * Class contains methods to get o set the commercial gesture list response
 * @author mohammed.sajid
 */
class CommercialGestureList 
{
    /*
     * @var array
     */
    private $_commercialGestureList = [];
    
    /*
     * @return array
     */
    public function getCommercialGestureResultList()
    {
        return $this->_commercialGestureList;
    }
    
    /*
     * @param $refundInformationMessage \Sdk\Order\Refund\RefundInformationMessage
     */
    public function addRefundInformationMessageToList($refundInformationMessage)
    {
        $this->_commercialGestureList[] = $refundInformationMessage;
    }
}
