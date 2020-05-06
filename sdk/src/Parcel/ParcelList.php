<?php

namespace Sdk\Parcel;

class ParcelList
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
}
