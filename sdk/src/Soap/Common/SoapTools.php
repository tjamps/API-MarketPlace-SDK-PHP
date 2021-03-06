<?php

namespace Sdk\Soap\Common;

class SoapTools
{
    /**
     * @param array|string $value
     * @return bool
     */
    public static function isSoapValueNull($value)
    {
        return (isset($value['nil']) && $value['nil'] === 'true') || empty($value);
    }
}
