<?php

use Slim\App;
use App\Middleware\JsonBodyParserMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;

return function(App $app) {
    // Middlewares
    // Capa que actua entre la solicitud y la respuesta
    // Ayuda a modificar o intersectar (validar)

    // Global -> a todas las Request del Backend
    $app->add(function(Request $req, Handler $han): Response {
        $response = $han->handle($req);
        return $response->withHeader('Content-Type', 'application/json');
    });

    // Custom Global Middleware
    $app->add(new JsonBodyParserMiddleware());
};