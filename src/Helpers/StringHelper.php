<?php

namespace Khwadj\Helpers;

class StringHelper
{
    /**
     * @param $haystack
     * @param $needle
     * @return bool
     */
    static function endsWith($haystack, $needle)
    {
        return substr_compare($haystack, $needle, -strlen($needle)) === 0;
    }

    /**
     * Splits a $string of a given $encoding into pieces of $size
     * Requires mbcrypt
     *
     * @param        $string
     * @param        $size
     * @param string $encoding
     * @return array
     */
    static function split_string($string, $size, $encoding = NULL)
    {
        if ( $encoding === NULL ) $encoding = mb_internal_encoding();
        $len = mb_strlen($string, $encoding);
        $res = [];
        $index = 0;
        for ($i = 0; $i < $len; $i += $size) {
            $res[] = mb_substr($string, $i, $size, $encoding);
        }

        return $res;
    }
}