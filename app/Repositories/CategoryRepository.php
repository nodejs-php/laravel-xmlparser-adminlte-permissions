<?php

namespace App\Repositories;

use App\Models\Category;

// Import the CategoryRepositoryInterface.
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function create(array $data): Category
    {
        return Category::create($data);
    }
}
