<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Camper;
use App\Domain\Repositories\CamperRepositoryInterface;


class EloquentCamperRepository implements CamperRepositoryInterface
{
    public function getAll(): array
    {
        // SELECT * FROM campers;
        return Camper::all()->toArray();
    }

    public function getById(int $doc): ?Camper
    {
        // SELECT * FROM campers WHERE id = $doc;
        return Camper::find($doc);
    }

    public function create(array $data): Camper
    {
        return Camper::create($data);
    }

    public function update(int $doc, array $data): bool
    {
        // SELECT * FROM campers WHERE id = $doc;
        $camper = Camper::find($doc);
        // UPDATE campers SET nombre $data[x] ... WHERE id = $doc;
        return $camper ? $camper->update($data) : false;
    }

    public function delete(int $doc): bool
    {
        // SELECT * FROM campers WHERE id = $doc;
        $camper = Camper::find($doc);
        // DELETE FROM campers WHERE id = $doc;
        return $camper ? $camper->delete() : false;
    }
}