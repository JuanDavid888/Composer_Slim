<?php

namespace App\Domain\Repositories;

use App\Domain\Models\Camper;


interface CamperRepositoryInterface {
    public function getAll(): array;

    public function getById(int $doc): ?Camper;

    public function create(array $data): Camper;

    public function update(int $doc, array $data): bool;

    public function delete(int $doc): bool;
}
