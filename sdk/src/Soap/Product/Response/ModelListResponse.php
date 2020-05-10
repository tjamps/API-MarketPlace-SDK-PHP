<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 20/10/2016
 * Time: 15:12
 */

namespace Sdk\Soap\Product\Response;


use var_dump;
use Sdk\Product\KeyValueProperty;
use Sdk\Product\ProductModel;
use Sdk\Soap\Common\AbstractResponse;
use Sdk\Soap\Common\SoapTools;

class ModelListResponse extends AbstractResponse
{

    /**
     * @var array
     */
    private $_modelList = null;

    /**
     * @return array
     */
    public function getModelList()
    {
        return $this->_modelList;
    }

    /**
     * @var null
     */
    protected $_dataResponse = null;

    /**
     * @var string
     */
    protected $_tagXML = null;

    /**
     * @var string
     */
    protected $_tagResultXML = null;

    /**
     * ModelListResponse constructor.
     * @param $tagXML
     * @param $tagResultXML
     */
    public function __construct($tagXML, $tagResultXML)
    {
        $this->_tagXML = $tagXML;
        $this->_tagResultXML = $tagResultXML;

        $this->_modelList = [];
    }

    protected function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body'][$this->_tagXML][$this->_tagResultXML];
        $this->tokenID = $objInfoResult['TokenId'];
        $this->sellerLogin = $objInfoResult['SellerLogin'];
    }

    /**
     * @return bool
     */
    protected function _hasErrorMessage()
    {


        $objError = $this->_dataResponse['s:Body'][$this->_tagXML][$this->_tagResultXML]['ErrorMessage'];

        if (isset($objError['_']) && \strlen($objError['_']) > 0) {

            $this->hasError = true;
            $this->errorMessage = $objError['_'];
            return true;
        }
        return false;
    }

    /**
     * @param $productModelXML
     */
    protected function _addProductModel($productModelXML)
    {
        $productModel = new ProductModel((int) ($productModelXML['ModelId']));

        $productModel->setCategoryCode($productModelXML['CategoryCode']);
        $productModel->setName($productModelXML['Name']);

        foreach ($productModelXML['Definition']['ListProperties']['a:KeyValueOfstringArrayOfstringty7Ep6D1'] as $keyValueXml) {

            $keyvalueObj = new KeyValueProperty($keyValueXml['a:Key']);

            foreach ($keyValueXml['a:Value']['a:string'] as $value) {
                $keyvalueObj->addValue($value);
            }

            $productModel->addKeyValueProperty($keyvalueObj);
        }

        if (isset($productModelXML['Definition']['MandatoryModelProperties']) && !SoapTools::isSoapValueNull($productModelXML['Definition']['MandatoryModelProperties'])
            && isset($productModelXML['Definition']['MandatoryModelProperties']['a:string'])) {

            var_dump($productModelXML['Definition']['MandatoryModelProperties']);

            foreach ($productModelXML['Definition']['MandatoryModelProperties']['a:string'] as $mandatoryModelProperty) {
                $productModel->addMandatoryModelProperty($mandatoryModelProperty);
            }
        }

        $this->_modelList[] = $productModel;
    }
}
