<?php
/**
 * Created by CDiscount
 * User: CDiscount
 * Date: 22/09/2016
 * Time: 11:43
 */

namespace Sdk\ApiClient;
use Sdk\Auth\Token;
use Sdk\Discussion\DiscussionPoint;
use Sdk\Mail\MailPoint;
use Sdk\Offer\OfferPoint;
use Sdk\Order\OrderPoint;
use Sdk\Product\ProductPoint;
use Sdk\Relays\RelaysPoint;
use Sdk\Seller\SellerPoint;
use Sdk\Fulfilment\FulfilmentPoint;

/**
 * Class CDSApiClient
 *
 * @package ApiClient
 */
class CDSApiClient
{

    /**
     * @var SellerPoint
     */
    private $_sellerPoint = null;
    private $username;
    private $password;
    /**
     * @var bool
     */
    private $prod;

    private $tokenUrls = [
        'prod' => 'https://sts.cdiscount.com/users/httpIssue.svc/?realm=https://wsvc.cdiscount.com/MarketplaceAPIService.svc',
        'preprod' => 'https://sts.preprod-cdiscount.com/users/httpIssue.svc/?realm=https://wsvc.preprod-cdiscount.com/MarketplaceAPIService.svc',
    ];

    private $methodUrls = [
        'prod' => 'http://www.cdiscount.com/IMarketplaceAPIService/',
        'preprod' => 'http://www.cdiscount.com/IMarketplaceAPIService/',
    ];

    private $apiUrls = [
        'prod' => 'https://wsvc.cdiscount.com/MarketplaceAPIService.svc',
        'preprod' => 'https://wsvc.preprod-cdiscount.com/MarketplaceAPIService.svc',
    ];


    /**
     * @return SellerPoint
     */
    public function getSellerPoint()
    {
        if ($this->_sellerPoint == null) {
            $this->_sellerPoint = new SellerPoint();
        }
        return $this->_sellerPoint;
    }

    /**
     * @var \Sdk\Order\OrderPoint
     */
    private $_orderPoint = null;

    /**
     * @return OrderPoint
     */
    public function getOrderPoint()
    {
        if ($this->_orderPoint == null) {
            $this->_orderPoint = new OrderPoint();
        }
        return $this->_orderPoint;
    }

    /**
     * @var \Sdk\Offer\OfferPoint
     */
    private $_offerPoint = null;

    /**
     * @return OfferPoint
     */
    public function getOfferPoint()
    {
        if ($this->_offerPoint == null) {
            $this->_offerPoint = new OfferPoint();
        }
        return $this->_offerPoint;
    }

    /**
     * @var \Sdk\Product\ProductPoint
     */
    private $_productPoint = null;

    /**
     * @return ProductPoint
     */
    public function getProductPoint()
    {
        if ($this->_productPoint == null) {
            $this->_productPoint = new ProductPoint();
        }
        return $this->_productPoint;
    }

    /**
     * @var \Sdk\Fulfilment\FulfilmentPoint
     */
    private $_fulfilmentPoint = null;

    /**
     * @return FulfilmentPoint
     */
    public function getFulfilmentPoint()
    {
        if ($this->_fulfilmentPoint == null) {
            $this->_fulfilmentPoint = new FulfilmentPoint();
        }
        return $this->_fulfilmentPoint;
    }

    /**
     * @var \Sdk\Discussion\DiscussionPoint
     */
    private $_discussionPoint = null;

    /**
     * @return \Sdk\Discussion\DiscussionPoint
     */
    public function getDiscussionPoint()
    {
        if ($this->_discussionPoint == null) {
            $this->_discussionPoint = new DiscussionPoint();
        }
        return $this->_discussionPoint;
    }

    /**
     * @var \Sdk\Relays\RelaysPoint
     */
    private $_relaysPoint = null;

    /**
     * @return RelaysPoint
     */
    public function getRelaysPoint()
    {
        if ($this->_relaysPoint == null) {
            $this->_relaysPoint = new RelaysPoint();
        }
        return $this->_relaysPoint;
    }

    /**
     * @var MailPoint
     */
    private $_mailPoint = null;

    /**
     * @return MailPoint
     */
    public function getMailPoint()
    {
        if ($this->_mailPoint == null) {
            $this->_mailPoint = new MailPoint();
        }
        return $this->_mailPoint;
    }

    public function __construct($username, $password, $prod = false)
    {
        $this->username = $username;
        $this->password = $password;
        $this->prod = $prod;
    }


    private static $instance;

    public static function getInstance($username = '', $password = '', $prod = false)
    {
        if (self::$instance === null) {
            self::$instance = new self($username, $password, $prod);
        }

        return self::$instance;
    }


    /**
     * Create and check the token
     * @param $username
     * @param $password
     * @return string
     */
    public function init()
    {
        $token = Token::getInstance()->getToken();
        return $token;
    }

    /**
     * @return bool
     */
    public function isTokenValid()
    {
        return Token::getInstance()->isTokenValid();
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return bool
     */
    public function isProd()
    {
        return $this->prod;
    }

    public function getTokenUrl()
    {
        return $this->isProd() ? $this->tokenUrls['prod'] : $this->tokenUrls['preprod'];
    }

    public function getMethodUrl()
    {
        return $this->isProd() ? $this->methodUrls['prod'] : $this->methodUrls['preprod'];
    }

    public function getApiUrl()
    {
        return $this->isProd() ? $this->apiUrls['prod'] : $this->apiUrls['preprod'];
    }
}
