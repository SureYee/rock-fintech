<?php
/**
 * Created by PhpStorm.
 * User: sure
 * Date: 2018-07-27
 * Time: 14:48
 */

if (!function_exists('isAssocArray')) {
    function isAssocArray(array $array)
    {
        return array_diff(array_keys($array), range(0, sizeof($array))) ? true : false;
    }
}

if (!function_exists('uuid')) {
    function uuid()
    {
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = substr($charid, 0, 8) . $hyphen
            . substr($charid, 8, 4) . $hyphen
            . substr($charid, 12, 4) . $hyphen
            . substr($charid, 16, 4) . $hyphen
            . substr($charid, 20, 12);
        return $uuid;
    }
}

if (!function_exists('kSortRecursive')) {
    function kSortRecursive(&$array)
    {
        ksort($array);
        array_walk($array, function (&$value) {
            if (is_array($value)) {
                kSortRecursive($value);
            }
        });
    }
}