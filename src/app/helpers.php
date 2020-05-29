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

if (!function_exists('base_path')) {
    function base_path($path = null)
    {
        if (!$path) {
            return __DIR__ . '/../';
        }

        return __DIR__ . "/../{$path}";
    }
}


if (!function_exists('env')) {
    function env($key, $default = null)
    {
        $value = getenv($key);

        if ($value === false) {
            return $default;
        }

        if ($value === '') return null;

        switch (strtolower($value)) {
            case $value === 'true':
                return true;
            case $value === 'false':
                return false;
            case $value === 'null':
                return null;
            default:
                return $value;
        }
    }
}
