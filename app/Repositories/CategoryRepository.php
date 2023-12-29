<?php

namespace App\Repositories;

use App\Models\CategoryOffers;

// Import the CategoryRepositoryInterface.
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function create(array $data): CategoryOffers
    {
        return CategoryOffers::create($data);
    }
}
