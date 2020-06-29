<?php

namespace Sdk\Parcel;

use JsonSerializable;

class ParcelItem implements JsonSerializable
{
    /**
     * @var string
     */
    private $productName;

    /**
     * @var string
     */
    private $sku;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @param string $sku
     */
    public function __construct($sku)
    {
        $this->sku = $sku;
        $this->quantity = 0;
    }

    /**
     * @return string
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * @param string $productName
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;
    }

    /**
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function jsonSerialize()
    {
        return [
            'productName' => $this->productName,
            'sku' => $this->sku,
            'quantity' => $this->quantity,
        ];
    }
}
