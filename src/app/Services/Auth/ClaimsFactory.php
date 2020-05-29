<?php

namespace App\Services\Auth;

use Carbon\Carbon;
use Psr\Http\Message\RequestInterface;

class ClaimsFactory
{
    protected $defaultClaims = [
        'iss',
        'iat',
        'exp',
        'nbf',
        'jti'
    ];

    protected $request;

    protected $expiry;

    public function __construct(RequestInterface $request, int $expiry)
    {
        $this->request = $request;
        $this->expiry = $expiry;
    }

    public function getDefaltClaims()
    {
        return $this->defaultClaims;
    }

    public function iss()
    {
        return $this->request->getUri()->getPath();
    }

    public function iat()
    {
        return Carbon::now()->getTimestamp();
    }

    public function nbf()
    {
        return Carbon::now()->getTimestamp();
    }

    public function jti()
    {
        return bin2hex(str_random(32));
    }

    public function exp()
    {
        return Carbon::now()->addMinutes($this->expiry)->getTimestamp();
    }

    public function get($claim)
    {
        if (!method_exists($this, $claim)) {
            return null;
        }

        return $this->{$claim}();
    }
}
