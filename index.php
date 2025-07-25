<?php

require_once "vendor/autoload.php";

use App\Infrastructure\Database\Connection;
use Slim\Factory\AppFactory;
use Dotenv\Dotenv;

// Variables de .env
$dotenv = Dotenv::createImmutable(__DIR__. '/');
$dotenv->load(); // $_ENV[...]

// Se carga el Container de PHP-DI
$container = require_once 'bootstrap/container.php';

// Se asigna a Slim el contenedor
AppFactory::setContainer($container);

// Iniciar la conexion con la db
Connection::init();

$app = AppFactory::create();

// Ejecutando los scripts de

// public/
(require_once 'public/index.php')($app);

// routes/
(require_once 'routes/users.php')($app);
(require_once 'routes/campers.php')($app);

$app->run();