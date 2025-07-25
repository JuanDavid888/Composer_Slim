<?php

use App\Controllers\CamperController;
use App\Middleware\RoleMiddleware;
use App\Middleware\AuthMiddleware;
use Slim\App;

return function(App $app) {
    $app->group('/campers', function($group) {
        $group->get('', [CamperController::class, 'index']);

        $group->get('/{documento}', [CamperController::class, 'show']);

        $group->post('', [CamperController::class, 'store']);

        $group->put('/{documento}', [CamperController::class, 'update']);

        $group->delete('/{documento}', [CamperController::class, 'destroy']);
    })->add(new RoleMiddleware('user'))
    ->add(new AuthMiddleware());
};
