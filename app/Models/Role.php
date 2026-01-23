<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    //
    // A role can be assigned to many users
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    // A role can have many permissions
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }
}
