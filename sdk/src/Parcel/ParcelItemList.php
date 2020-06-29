<?php

namespace Sdk\Parcel;

use JsonSerializable;

class ParcelItemList implements JsonSerializable
{
    /**
     * @var ParcelItem[]
     */
    private $parcelItemList;

    public function __construct()
    {
        $this->parcelItemList = [];
    }

    /**
     * @param $parcelItem ParcelItem
     */
    public function addParcelItem($parcelItem)
    {
        $this->parcelItemList[] = $parcelItem;
    }

    /**
     * @return ParcelItem[]
     */
    public function getParcelItems()
    {
        return $this->parcelItemList;
    }

    public function jsonSerialize()
    {
        return [
            'parcelItemList' => $this->parcelItemList,
        ];
    }
}
