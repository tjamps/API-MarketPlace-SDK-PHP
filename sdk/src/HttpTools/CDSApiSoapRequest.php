<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 04/10/2016
 * Time: 13:27
 */

namespace Sdk\HttpTools;


use Zend\Http\Client;
use Zend\Http\Client\Adapter\Curl;
use Zend\Http\Request;

class CDSApiSoapRequest
{
    /**
     * @var Curl
     */
    private $_adapter = null;

    /**
     * @var Client
     */
    private $_client = null;

    /**
     * @var Request
     */
    private $_request = null;

    /**
     * @var array header
     */
    private $_header = null;

    /**
     * CDSApiSoapRequest constructor.
     *
     * @param $method
     * @param $headerMethodURL
     * @param $apiURL
     * @param $data
     */
    public function __construct($method, $headerMethodURL, $apiURL, $data)
    {

        $this->_client = new Client($apiURL);
        $this->_client->setMethod('post');
        $this->_client->setRawBody($data);
        $this->_client->setHeaders([
            'Content-Type: text/xml;charset=UTF-8',
            'SOAPAction: http://www.cdiscount.com/IMarketplaceAPIService/' . $method . '',
        ]);

        $this->_adapter = new Curl();
        $this->_setAdapaterOptions($data, $apiURL);
        $this->_client->setAdapter($this->_adapter);
    }

    /**
     * @param $data
     * @param $url
     */
    private function _setAdapaterOptions($data, $url)
    {
        $this->_adapter->setOptions([
            'curloptions' => [
                CURLOPT_URL => $url,
                CURLOPT_VERBOSE => false,
                CURLOPT_HEADER => true,
                CURLOPT_POST => true,
                CURLOPT_SSLVERSION => 4,
                CURLOPT_SSL_VERIFYPEER => FALSE,
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_TIMEOUT => 600
            ]
        ]);
    }

    /**
     * @return string
     */
    public function call()
    {
        $response = $this->_client->send();
        return $response->getBody();
    }

}
