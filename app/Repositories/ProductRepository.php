<?php

// Define the namespace for this class.
namespace App\Repositories;


use App\Models\Product;

// Import the ProductRepositoryInterface.
use App\Repositories\Interfaces\ProductRepositoryInterface;

// Import Laravel's Collection class.
use Illuminate\Support\Collection;

class ProductRepository implements ProductRepositoryInterface
{

    public function create(array $attributes): Product
    {
        return Product::create($attributes);
    }

    public function getAll(): Collection
    {
        return Product::all()->load('images');
    }
}
