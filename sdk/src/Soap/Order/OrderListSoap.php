<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 17/10/2016
 * Time: 14:02
 */

namespace Sdk\Soap\Order;


use Sdk\Order\OrderList;
use Sdk\Order\Validate\ValidateOrder;
use Sdk\Soap\XmlUtils;

class OrderListSoap
{

    /**
     * @var XmlUtils|mixed
     */
    public $_xmlUtil;
    private $_tag = 'OrderList';

    /**
     * @var OrderList
     */
    private $_orderList = null;

    /**
     * OrderListSoap constructor.
     * @param $orderList \Sdk\Order\OrderList
     */
    public function __construct($orderList)
    {

        $this->_xmlUtil = new XmlUtils('');
        $this->_orderList = $orderList;
    }

    /**
     * @return string
     */
    public function serialize()
    {
        $xml = $this->_xmlUtil->generateOpenBaliseWithInline('validateOrderListMessage', ['xmlns:i="http://www.w3.org/2001/XMLSchema-instance"']);

        $xml .= $this->_xmlUtil->generateOpenBalise($this->_tag);

        /** @var ValidateOrder $validateOrder */
        foreach ($this->_orderList->getOrders() as $validateOrder) {

            $validateOrderSoap = new ValidateOrderSoap($validateOrder);
            $xml .= $validateOrderSoap->serialize();

        }

        $xml .= $this->_xmlUtil->generateCloseBalise($this->_tag);

        $xml .= $this->_xmlUtil->generateCloseBalise('validateOrderListMessage');

        return $xml;
    }
}
