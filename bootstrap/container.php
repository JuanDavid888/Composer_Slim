<?php

use App\Domain\Repositories\CamperRepositoryInterface;
use App\Domain\Repositories\UserRepositoryInterface;
use App\Handler\CustomErrorHandler;
use App\Infrastructure\Repositories\EloquentCamperRepository;
use App\Infrastructure\Repositories\EloquentUserRepository;
use DI\Container;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Interfaces\ErrorHandlerInterface;

// Clase a reemplazar y valor creado a recibir
$container = new Container();

// El parametro de CamperController es CamperRepositoryInterface, pero recibe las instrucciones de EloquentCamperRepository
$container->set(CamperRepositoryInterface::class, function() {
    return new EloquentCamperRepository();
});

$container->set(UserRepositoryInterface::class, function() {
    return new EloquentUserRepository();
});

// new CamperController(new EloquentCamperRespository())
// Manejador
$container->set(ErrorHandlerInterface::class, function() use ($container) {
    return new CustomErrorHandler(
        $container->get(ResponseFactoryInterface::class)
    );
});

return $container;