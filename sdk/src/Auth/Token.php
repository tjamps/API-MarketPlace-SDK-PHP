<?php
/**
 * Created by CDiscount
 * User: CDiscount
 * Date: 22/09/2016
 * Time: 12:09
 */

namespace Sdk\Auth;

use DateTime;
use libxml_use_internal_errors;
use simplexml_load_string;
use ctype_alnum;
use Sdk\ApiClient\CDSApiClient;
use Sdk\ConfigTools\ConfigFileLoader;
use Sdk\HttpTools\CDSApiRequest;
//use Zend\Db\Sql\Ddl\Column\Datetime;

/**
 * Class Token
 *
 * @package Auth
 */
class Token
{
    #region Private attributes

    /**
     * @var Singleton $instance
     */
    private static $_instance = null;

    /**
     * @var bool true if the token is valid
     */
    private $_isValid = false;

    /**
     * @var DateTime date and time of the token request
     */
    private $_initdate = null;

    /**
     * @var string Token to communicate with the API
     */
    private $_token = null;

    #endregion Private attributes

    #region Constructor

    private $tokenUrls = [
        'prod' => 'https://sts.cdiscount.com/users/httpIssue.svc/?realm=https://wsvc.cdiscount.com/MarketplaceAPIService.svc',
        'preprod' => 'https://sts.preprod-cdiscount.com/users/httpIssue.svc/?realm=https://wsvc.preprod-cdiscount.com/MarketplaceAPIService.svc',
    ];

    /**
     * Token constructor.
     */
    private function __construct()
    {
        $this->_isValid = false;
        $this->_initdate = false;
    }

    #endregion Constructor

    #region Singleton

    /**
     * Return a unique instance of the token class, initiate it if needed
     * @param string $username
     * @param string $password
     * @param bool $prod
     * @return Token
     */
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    #endregion Singleton

    #region Private methods

    private function _generateNewToken()
    {
        $client = CDSApiClient::getInstance();
        $request = new CDSApiRequest($client->getUsername(), $client->getPassword(), $client->getTokenUrl());

        libxml_use_internal_errors(true);
        $xmlResult = simplexml_load_string($request->execute());

        //TODO gestion erreur token

        if ($xmlResult !== false && isset($xmlResult[0]) && ctype_alnum((string) ($xmlResult[0]))) {
            $this->_token = $xmlResult[0];

            if ($this->_token != null && $this->_token) {
                $this->_isValid = true;
                $this->_initdate = new DateTime();
            }
        }
    }

    #endregion Private methods

    #region Public methods

    /**
     * Generate a new token or return the actual active token
     */
    public function getToken()
    {
        //TODO vérifier la date

        if (!$this->_isValid) {
            $this->_generateNewToken();
        }
        return $this->_token;
    }

    /**
     * @return bool
     */
    public function isTokenValid()
    {
        return $this->_isValid;
    }

    #endregion Public methods
}
