<?php

namespace Sdk\Parcel;

class ParcelItemList
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
}
