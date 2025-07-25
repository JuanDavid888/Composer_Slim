<?php

namespace App\Middleware;

use App\Domain\Models\User;
use Psr\Http\Message\ServerRequestInterface AS Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Slim\Psr7\Response as SlimResponse;

class RoleMiddleware {

    public function __construct(private readonly string $role){}

    public function __invoke(Request $request, Handler $handler): Response
    {
        $user = $request->getAttribute('user');
        if(!$user || $user->rol != $this->role) {
            $response = new SlimResponse();
            $response->getBody()->write(json_encode(['error' => 'Acceso prohibido']));

            return $response->withStatus(403)->withHeader('Content-Type', 'application/json');
        }

        return $handler->handle($request);
    }
}