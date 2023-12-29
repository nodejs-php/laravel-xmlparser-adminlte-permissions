<?php

// Define the namespace for the interface.
namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface ProductRepositoryInterface
{
    public function create(array $attributes);

    public function getAll(): Collection;
}
