<?php

namespace App\UseCases;

use App\Domain\Models\Camper;
use App\Domain\Repositories\CamperRepositoryInterface;

class GetCamperById {

    public function __construct(private CamperRepositoryInterface $repo){}

    public function execute(int $doc): ?Camper {
        return $this->repo->getById($doc);
    }
}