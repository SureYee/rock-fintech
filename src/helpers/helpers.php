<?php
/**
 * Created by PhpStorm.
 * User: sure
 * Date: 2018-07-27
 * Time: 14:48
 */

if (!function_exists('isAssocArray')) {
    /**
     * 判断关联数组和索引数组
     * @param array $array
     * @return bool
     */
    function isAssocArray(array $array)
    {
        return array_diff(array_keys($array), range(0, sizeof($array))) ? true : false;
    }
}

if (!function_exists('uuid')) {
    /**
     * 生成UUID
     * @return string
     */
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
    /**
     * 字符串排序
     * @param $array
     */
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

if (!function_exists('uniqueId32')) {
    /**
     * 生成32位唯一号
     * @return string
     */
    function uniqueId32()
    {
        return md5(uniqid(md5(microtime(true)),true));
    }
};