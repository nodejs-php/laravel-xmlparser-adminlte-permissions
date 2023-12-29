<?php

namespace App\Repositories;

use App\Models\ProductImage;

// Import the ProductImagesRepositoryInterface.
use App\Repositories\Interfaces\ProductImagesRepositoryInterface;


class ProductImagesRepository implements ProductImagesRepositoryInterface
{
    public function create(array $data): ProductImage
    {
        return ProductImage::create($data);
    }
}
