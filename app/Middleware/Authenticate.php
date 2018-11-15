<?php declare(strict_types=1);

namespace App\Middleware;

use App\Services\Auth\JwtAuth;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;
use League\Route\Http\Exception\UnauthorizedException;

class Authenticate implements MiddlewareInterface
{
    protected $auth;

    public function __construct(JwtAuth $auth)
    {
        $this->auth = $auth;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        if (!$header = $this->getAuthorizationHeader($request)) {
            throw new UnauthorizedException;
        }

        try {
            if (!$user = $this->auth->authenticate($header)->user()) {
                throw new UnauthorizedException;
            };
        } catch (Exception $e) {
            throw new UnauthorizedException;
        }

        return $handler->handle($request);
    }

    protected function getAuthorizationHeader(ServerRequestInterface $request)
    {
        $header = $request->getHeader('Authorization');

        return reset($header);
    }
}
