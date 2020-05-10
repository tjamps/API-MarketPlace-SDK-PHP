<?php
/* 
 * Created by Cdiscount
 * Date : 26/04/2017
 * Time : 11:12
 */
namespace Sdk\Fulfilment;

class FulfilmentProductRequest
{
    /**
     * @var string
     */
    private $_fulfilmentReferencement = null;

    /**
     * @var array
     */
    private $_barCodeList = null;

     /**
     * FulfillmentProductRequest constructor
     */
    public function __construct() 
    {
        $this->_barCodeList = [];
    }

    /**
     * @return string
     */
    public function getFulfilmentReferencement()
    {
        return $this->_fulfilmentReferencement;
    }

    /**
     * @return array
     */
    public function getBarCodeList()
    {
        return $this->_barCodeList;
    }

    /**
     * @param $string string  
     */
    public function addBarCodeList($string)
    {
		if($string != null && !empty($string))
		{
			$this->_barCodeList[] = $string;
		}
    }

    /**
     * @param $fbcReferencementFilter string
     */
    public function setFulfilmentReferencement($fbcReferencementFilter)
    {
        $this->_fulfilmentReferencement = $fbcReferencementFilter;
    }
}
