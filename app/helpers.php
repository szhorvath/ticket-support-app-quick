<?php

use Zend\Diactoros\Response;

if (!function_exists('response')) {
    function response()
    {
        return new Response;
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
