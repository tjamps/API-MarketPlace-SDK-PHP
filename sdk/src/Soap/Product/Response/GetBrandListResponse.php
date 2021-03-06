<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 02/11/2016
 * Time: 09:40
 */

namespace Sdk\Soap\Product\Response;


use Zend\Config\Reader\Xml;
use Sdk\Soap\Common\AbstractResponse;

class GetBrandListResponse extends AbstractResponse
{

    /**
     * @var array|null
     */
    private $_dataResponse = null;

    /**
     * @var array
     */
    private $_brandList = null;

    /**
     * GetAllowedCategoryTreeResponse constructor.
     * @param $response
     */
    public function __construct($response)
    {

        $reader = new Xml();
        $this->_dataResponse = $reader->fromString($response);

        // Check For error message
        if (!$this->_hasErrorMessage()) {

            /**
             * Global informations
             */
            $this->_setGlobalInformations();

            $this->_brandList = [];

            $this->_generateBrandListFromXML($this->_dataResponse['s:Body']['GetBrandListResponse']['GetBrandListResult']['a:BrandList']);
        }
    }

    /**
     * @return array
     */
    public function getBrandList()
    {
        return $this->_brandList;
    }

    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['GetBrandListResponse']['GetBrandListResult'];
        $this->tokenID = $objInfoResult['TokenId'];
        $this->sellerLogin = $objInfoResult['SellerLogin'];
    }

    /**
     * Check if the response has an error message
     * @return bool
     */
    private function _hasErrorMessage()
    {
        $objError = $this->_dataResponse['s:Body']['GetBrandListResponse']['GetBrandListResult']['ErrorMessage'];
        $this->errorList = [];

        if (isset($objError['_']) && \strlen($objError['_']) > 0) {

            $this->hasError = true;
            $this->errorMessage = $objError['_'];
            $this->errorList[] = $this->errorMessage;
            return true;
        }
        return false;
    }

    private function _generateBrandListFromXML($brandList)
    {
        foreach ($brandList['Brand'] as $brand) {
            $this->_brandList[] = $brand['BrandName'];
        }
    }
}
