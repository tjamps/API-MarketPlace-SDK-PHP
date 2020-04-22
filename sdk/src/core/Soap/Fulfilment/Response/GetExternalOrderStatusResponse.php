<?php

namespace Sdk\Soap\Fulfilment\Response;

use Sdk\Soap\Common\AbstractResponse;
use Zend\Config\Reader\Xml;

class GetExternalOrderStatusResponse extends AbstractResponse
{
    /**
     * @var array
     */
    private $dataResponse = null;

    /**
     * @var string
     */
    private $status = null;

    public function __construct($response)
    {
        $reader = new Xml();
        $this->dataResponse = $reader->fromString($response);

        $this->checkResponseDataValidity(
            $this->dataResponse,
            's:Body.GetExternalOrderStatusResponse.GetExternalOrderStatusResult'
        );

        $externalOrderStatusXml = $this->dataResponse['s:Body']['GetExternalOrderStatusResponse']['GetExternalOrderStatusResult'];

        $this->checkErrors($externalOrderStatusXml);

        $this->generateExternalOrderStatus();
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    private function generateExternalOrderStatus()
    {
        $externalOrderStatusXml = $this->dataResponse['s:Body']['GetExternalOrderStatusResponse']['GetExternalOrderStatusResult'];

        if ($this->isXmlValueSet($externalOrderStatusXml, 'a:Status')) {
            $this->status = $externalOrderStatusXml['a:Status'];
        }
    }
}
