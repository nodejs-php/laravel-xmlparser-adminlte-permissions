<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoriesOffers extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'parent_id',
        'name',
        'category_id',
        'referenced_id',
        'available',
        'url',
        'price',
        'old_price',
        'currency_id',
        'offer_id',
        'picture',
        'category_name',
        'offer_name',
        'vendor'
    ];
}
