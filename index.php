<?php

require_once "vendor/autoload.php";

use App\Middleware\JsonBodyParserMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->get('/', function(Request $req, Response $res, array $args) {
    $res->getBody()->write(json_encode(["message" => "Hola desde Slim"]));
    return $res;
});
// Middlewares
// Capa que actua entre la solicitud y la respuesta
// Ayuda a modificar o intersectar (validar)

// Global -> a todas las Request del Backend
$app->add(function(Request $req, Handler $han): Response {
    $response = $han->handle($req);
    return $response->withHeader('Content-Type', 'application/json'); // Aplica a todo lo que vaya hacia abajo
});

// Custom Global Middleware
$app->add(new JsonBodyParserMiddleware());

$app->run();