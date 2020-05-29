<?php

namespace App\Services\Auth\Providers\Jwt;

interface JwtProviderInterface
{
    public function encode(array $claims);
    public function decode($token);
}
