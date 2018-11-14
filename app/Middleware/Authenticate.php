<?php declare(strict_types=1);

namespace App\Middleware;

use App\Services\Auth\Auth;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;

class Authenticate implements MiddlewareInterface
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        if ($this->auth === true) {
            return $handler->handle($request);
        }

        return $handler->handle($request);
        // return new RedirectResponse(/* .. */);
    }
}
