<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'referenced_id',
        'available',
        'url',
        'price',
        'old_price',
        'currency_id',
        'category_id',
        'picture',
        'name',
        'vendor'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
