<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface OfferRepositoryInterface
{
    public function create(array $attributes);

    public function getAll(): Collection;

    public function delete();
}
