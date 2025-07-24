<?php

namespace App\UseCases;

use App\Domain\Models\Camper;
use App\Domain\Repositories\CamperRepositoryInterface;

class CreateCamper {

    public function __construct(private CamperRepositoryInterface $repo){}

    public function execute(array $data): Camper {
        return $this->repo->create($data);
    }
}