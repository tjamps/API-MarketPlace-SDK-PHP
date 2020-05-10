<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 20/10/2016
 * Time: 15:09
 */

namespace Sdk\Soap\Product\Response;

use Zend\Config\Reader\Xml;
class GetAllModelListResponse extends ModelListResponse
{
    public function __construct($dataResponse)
    {
        parent::__construct('GetAllModelListResponse', 'GetAllModelListResult');

        $reader = new Xml();
        $this->_dataResponse = $reader->fromString($dataResponse);

        // Check For error message
        if (!$this->_hasErrorMessage()) {

            /**
             * Global informations
             */
            $this->_setGlobalInformations();

            $modelListXML = $this->_dataResponse['s:Body'][$this->_tagXML][$this->_tagResultXML]['ModelList']['ProductModel'];

            foreach ($modelListXML as $productModelXML) {
                $this->_addProductModel($productModelXML);

            }
        }
    }

}
