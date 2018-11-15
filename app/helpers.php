<?php

use Zend\Diactoros\Response;

if (!function_exists('response')) {
    function response()
    {
        return new Response;
    }
}

if (!function_exists('str_random')) {
    function str_random($length)
    {
        return substr(bin2hex(random_bytes($length)), 0, $length);
    }
}


if (!function_exists('env')) {
    function env($key, $default = null)
    {
        $value = getenv($key);

        if ($value === false) {
            return $default;
        }

        switch (strtolower($value)) {
            case $value === 'true':
                return true;
            case $value === 'false':
                return false;
            default:
                return $value;
        }
    }
}
