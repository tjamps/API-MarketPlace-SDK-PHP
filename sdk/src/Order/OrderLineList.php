<?php

namespace Sdk\Order;

class OrderLineList
{
    /**
     * @var OrderLine[]
     */
    private $orderLineList;

    public function __construct()
    {
        $this->orderLineList = [];
    }

    /**
     * @param $orderLine OrderLine
     */
    public function addOrderLine($orderLine)
    {
        $this->orderLineList[] = $orderLine;
    }

    /**
     * @return OrderLine[]
     */
    public function getOrderLines()
    {
        return $this->orderLineList;
    }

    /**
     * @param string $productId
     * @return OrderLine|null
     */
    public function getOrderLineByProductId($productId)
    {
        if (!isset($productId)) {
            return null;
        }

        foreach ($this->orderLineList as $orderLine) {
            if ($orderLine->getProductId() === $productId) {
                return $orderLine;
            }
        }

        return null;
    }
}
