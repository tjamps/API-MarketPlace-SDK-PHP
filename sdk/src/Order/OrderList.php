<?php

namespace Sdk\Order;

class OrderList
{

    /**
     * @var array Sdk\Order\Order
     */
    private $_orderList = null;

    public function __construct()
    {
        $this->_orderList = [];
    }

    /**
     * @param $order Order
     */
    public function addOrder($order)
    {
        array_push($this->_orderList, $order);
    }

    /**
     * @return Order[]
     */
    public function getOrders()
    {
        return $this->_orderList;
    }

    /**
     * @param $orderNumber
     * @return null|Order
     */
    public function getOrderByNumber($orderNumber)
    {
        if (!isset($orderNumber)) {
            return null;
        }

        /** @var Order $order */
        foreach ($this->_orderList as $order) {
            if ($order->getOrderNumber() == $orderNumber) {
                return $order;
            }
        }
        return null;
    }
}
