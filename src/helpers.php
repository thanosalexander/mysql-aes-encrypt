<?php

namespace AESEncrypt;

if (!function_exists('AESEncrypt\mysqldecrypt')) {
    /**
     * Creates a Stringy object and returns it on success.
     *
     * @param  string  $column The character encoding
     * @return Stringy column with decrypt function
     */
    function mysqldecrypt($column, $alias = null)
    {
        return "AES_DECRYPT(SUBSTRING_INDEX({$column}, '.iv.', 1), '" . env('APP_AESENCRYPT_KEY') ."') as `" . ($alias ? $alias : $column) . "`";
    }
}

if (!function_exists('AESEncrypt\mysqlencrypt')) {
    /**
     * Creates a Stringy object and returns it on success.
     *
     * @param  string  $column The character encoding
     * @return Stringy column with decrypt function
     */
    function mysqlencrypt($column, $alias = null)
    {
        $iv = bin2hex(random_bytes(16));
        return "CONCAT(AES_ENCRYPT({$column}, '" . env('APP_AESENCRYPT_KEY') ."') as `" . ($alias ? $alias : $column) . "`";
    }
}
