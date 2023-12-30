<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug'];

    public function roles(): BelongsToMany
    {
        return $this->belongsTomany(Role::class,'roles_permissions');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsTomany(User::class,'users_permissions');
    }
}
