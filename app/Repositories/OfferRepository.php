<?php
namespace App\Repositories;

use App\Models\CategoriesOffers;
use App\Repositories\Interfaces\OfferRepositoryInterface;
use Illuminate\Support\Collection;

class OfferRepository implements OfferRepositoryInterface
{
    public function create(array $attributes): CategoriesOffers
    {
        return CategoriesOffers::create($attributes);
    }

    public function getAll(): Collection
    {
        return CategoriesOffers::all();
    }

    public function delete()
    {
        return CategoriesOffers::query()->delete();
    }
}
