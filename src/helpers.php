<?php

namespace AESEncrypt;

if (!function_exists('AESEncrypt\mysqldecrypt')) {
    /**
     * Creates a Stringy object and returns it on success.
     *
     * @param  string  $column The character encoding
     * @return string column with decrypt function
     */
    function mysqldecrypt($column, $alias = null)
    {
        return "AES_DECRYPT({$column}, '" . env('APP_AESENCRYPT_KEY') ."') as `" . ($alias ? $alias : $column) . "`";
    }
}

if (!function_exists('AESEncrypt\mysqlencrypt')) {
    /**
     * Creates a Stringy object and returns it on success.
     *
     * @param string $column The character encoding
     * @return string column with decrypt function
     * @throws \Exception
     */
    function mysqlencrypt($column, $alias = null)
    {
        $iv = bin2hex(random_bytes(16));
        return "AES_ENCRYPT({$column}, '" . env('APP_AESENCRYPT_KEY') ."') as `" . ($alias ? $alias : $column) . "`";
    }
}
