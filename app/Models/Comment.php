<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    // Allows data entry for comments
    protected $fillable = ['body', 'commentable_id', 'commentable_type'];

    /**
     * Get the parent commentable model (Article or Audience).
     */
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }
}
