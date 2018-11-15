<?php

namespace App\Services\Auth\Providers\Jwt;

use App\Services\Auth\Providers\Jwt\JwtProviderInterface;
use Firebase\JWT\JWT;

class FirebaseProvider implements JwtProviderInterface
{
    protected $secret;

    public function __construct(string $secret)
    {
        $this->secret = $secret;
    }

    public function encode(array $claims)
    {
        return JWT::encode($claims, $this->secret, 'HS256');
    }

    public function decode($token)
    {
        return JWT::decode($token, $this->secret, ['HS256']);
    }
}
