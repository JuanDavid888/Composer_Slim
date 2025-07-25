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
        // SELECT * FROM campers WHERE id = id;
        // return Camper::find($doc);

        // SELECT * FROM campers WHERE documento = $doc LIMIT 1,1;
        return Camper::where('documento', $doc)->first();
    }

    public function create(array $data): Camper
    {
        $exists = $this->getById($data['documento']);
        if($exists) {
            return $exists;
        }
        return Camper::create($data);
    }

    public function update(int $doc, array $data): bool
    {
        // SELECT * FROM campers WHERE id = $doc;
        // Elije de data el documento a cambiar, pero sin cambiar documento
        $camper = $this->getById($data['documento']);

        // SELECT * FROM campers WHERE documento = $doc;
        // Elije de la url el documento, siendo posible cambiar el documento
        // $camper = Camper::where('documento', $doc)->first();

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