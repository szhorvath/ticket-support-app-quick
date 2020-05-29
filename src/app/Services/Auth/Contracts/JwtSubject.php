<?php

namespace App\Services\Auth\Contracts;

interface JwtSubject
{
    public function getJwtIdentifier();
}
