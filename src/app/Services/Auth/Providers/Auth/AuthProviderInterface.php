<?php

namespace App\Services\Auth\Providers\Auth;

interface AuthProviderInterface
{
    public function byCredentials(string $username, string $password);
    public function byId($id);
}
