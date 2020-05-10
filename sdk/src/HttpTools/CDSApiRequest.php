<?php

/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 26/09/2016
 * Time: 09:53
 */

namespace Sdk\HttpTools;

use Zend\Http\Client\Adapter\Curl;
use Zend\Http\Client;
use Zend\Http\Request;
use base64_encode;
/**
 * Request in order to get a Token
 *
 * Class CDSApiRequest
 * @package Sdk\HttpTools
 */
class CDSApiRequest
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
     * @var string
     */
    private $_httpHeader = "";

    /**
     * @param $username
     * @param $password
     */
    private function _setHttpHeader($username, $password)
    {
        $authentication = base64_encode($username . ':' . $password);
        $this->_httpHeader = ['Authorization: Basic ' . $authentication];
    }

    private function _setAdapaterOptions($username, $password)
    {
        $this->_adapter->setOptions([
            'curloptions' => [
                CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
                CURLOPT_USERPWD => "$username:$password",
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_SSL_VERIFYPEER => FALSE,
                CURLOPT_SSL_VERIFYHOST => FALSE,
            ]
        ]);
    }

    /**
     * CDSApiRequest constructor.
     * @param $username
     * @param $password
     * @param $urltoken
     */
    public function __construct($username, $password, $urltoken)
    {
        //$this->_setHttpHeader($username, $password);

        $this->_request = new Request();
        $this->_request->setUri($urltoken);
        $this->_request->setMethod('GET');

        $this->_client = new Client();
        $this->_adapter = new Curl();
        $this->_client->setAdapter($this->_adapter);

        $this->_setAdapaterOptions($username, $password);
    }

    /**
     * @return string
     */
    public function execute()
    {
        $response = $this->_client->send($this->_request);
        return $response->getBody();
    }
}
