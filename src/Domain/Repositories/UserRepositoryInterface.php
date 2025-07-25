<?php

namespace App\Domain\Repositories;

use App\Domain\Models\User;

interface UserRepositoryInterface {

    public function create(array $data): User;

}