<?php

// Define the namespace for this class.
namespace App\Repositories;


use App\Models\Offer;

// Import the OfferRepositoryInterface.
use App\Repositories\Interfaces\OfferRepositoryInterface;

// Import Laravel's Collection class.
use Illuminate\Support\Collection;

class OfferRepository implements OfferRepositoryInterface
{

    public function create(array $attributes): Offer
    {
        return Offer::create($attributes);
    }

    public function getAll(): Collection
    {
        return Offer::all()->load('images');
    }
}
