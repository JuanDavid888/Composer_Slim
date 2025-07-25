<?php

use App\Domain\Repositories\CamperRepositoryInterface;
use App\Domain\Repositories\UserRepositoryInterface;
use App\Infrastructure\Repositories\EloquentCamperRepository;
use App\Infrastructure\Repositories\EloquentUserRepository;
use DI\Container; 

// Clase a reemplazar y valor creado a recibir
$container = new Container();

// El parametro de CamperController es CamperRepositoryInterface, pero recibe las instrucciones de EloquentCamperRepository
$container->set(CamperRepositoryInterface::class, function() {
    return new EloquentCamperRepository();
});

$container->set(UserRepositoryInterface::class, function() {
    return new EloquentUserRepository();
});

return $container;