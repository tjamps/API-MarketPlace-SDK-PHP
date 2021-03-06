<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 16/11/2016
 * Time: 16:25
 */

namespace Sdk\Soap\Product\Response;

use Zend\Config\Reader\Xml;
class GetAllAllowedCategoryTreeResponse extends GetGenericCategoryTreeResponse
{
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

            $this->_addRootCategoryTree($this->_dataResponse['s:Body']['GetAllAllowedCategoryTreeResponse']['GetAllAllowedCategoryTreeResult']['CategoryTree']);
        }
    }

    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['GetAllAllowedCategoryTreeResponse']['GetAllAllowedCategoryTreeResult'];
        $this->tokenID = $objInfoResult['TokenId'];
        $this->sellerLogin = $objInfoResult['SellerLogin'];
    }

    /**
     * Check if the response has an error message
     *
     * @return bool
     */
    private function _hasErrorMessage()
    {
        $objError = $this->_dataResponse['s:Body']['GetAllAllowedCategoryTreeResponse']['GetAllAllowedCategoryTreeResult']['ErrorMessage'];

        if (isset($objError['_']) && \strlen($objError['_']) > 0) {

            $this->hasError = true;
            $this->errorMessage = $objError['_'];
            return true;
        }
        return false;
    }
}
