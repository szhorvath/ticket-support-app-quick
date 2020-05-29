<?php declare(strict_types=1);

namespace App\Controllers\Auth;

use App\Services\Auth\JwtAuth;
use App\Controllers\Controller;
use Psr\Http\Message\ServerRequestInterface;
use League\Route\Http\Exception\UnauthorizedException;

class LoginController extends Controller
{
    protected $auth;

    public function __construct(JwtAuth $auth)
    {
        $this->auth = $auth;
    }

    public function index(ServerRequestInterface $request): array
    {
        $params = $request->getParsedBody();

        if (!$token = $this->auth->attempt($params['email'], $params['password'])) {
            throw new UnauthorizedException;
        }

        return [
            'success' => true,
            'token' =>  $token,
        ];
    }
}
