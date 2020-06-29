<?php

namespace Sdk\Parcel;

use JsonSerializable;

class ParcelList implements JsonSerializable
{
    /**
     * @var Parcel[]
     */
    private $parcelList = [];

    /**
     * @param $parcel Parcel
     */
    public function addParcel($parcel)
    {
        $this->parcelList[] = $parcel;
    }

    /**
     * @return Parcel[]
     */
    public function getParcels()
    {
        return $this->parcelList;
    }

    public function jsonSerialize()
    {
        return [
            'parcelList' => $this->parcelList,
        ];
    }
}
