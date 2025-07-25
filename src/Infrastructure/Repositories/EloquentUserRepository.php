<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\User;
use App\Domain\Repositories\UserRepositoryInterface;
use Exception;

class EloquentUserRepository implements UserRepositoryInterface {

    public function create(array $data): User
    {
        $exists = User::where('email', $data['email'])->first();
        if($exists) {
            // Mostrar un error
            throw new Exception('Error, el usuario ya existe');
        }

        return User::create($data);
    }
}