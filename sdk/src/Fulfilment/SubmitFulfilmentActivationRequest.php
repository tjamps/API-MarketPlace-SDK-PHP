<?php
/*
 * Created by CDiscount
 * Date: 04/05/2017
 */

namespace Sdk\Fulfilment;

class SubmitFulfilmentActivationRequest
{
    /*
     * @var array
     */
    private $_productActivationList = null;
    
    /*
     * SubmitFulfilmentActivationRequest constructor
     */
    public function __construct() 
    {
        $this->_productActivationList = [];
    }
    
    /*
     * @return array
     */
    public function getProductActivationList()
    {
        return $this->_productActivationList;
    }
    
    /*
     * @param productActivation
     */
    public function addProductActivationData($productActivation)
    {
        $this->_productActivationList[] = $productActivation;
    }
}
