<?php

namespace App\Controllers;

use App\Services\Auth\JwtAuth;
use App\Controllers\Controller;
use Psr\Http\Message\ServerRequestInterface;

class UserController extends Controller
{
    protected $auth;

    public function __construct(JwtAuth $auth)
    {
        $this->auth = $auth;
    }

    public function index(ServerRequestInterface $request): array
    {
        return [
            'success' => true,
            'data' => $this->auth->user(),
        ];
    }
}
