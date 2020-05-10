<?php

namespace Sdk\ArrayHelpers;

use explode;
class ArrayHelpers
{

    /**
     * @param array $array
     * @param string $key
     *
     * @return bool
     *
     * @see https://github.com/rappasoft/laravel-helpers/blob/master/src/helpers.php#L267
     */
    public static function has($array, $key)
    {
        if (empty($array) || null === $key) {
            return false;
        }

        if (\array_key_exists($key, $array)) {
            return true;
        }

        foreach (explode('.', $key) as $segment) {
            if (!\is_array($array) || !\array_key_exists($segment, $array)) {
                return false;
            }

            $array = $array[$segment];
        }

        return true;
    }

}
