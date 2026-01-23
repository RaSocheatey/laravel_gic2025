<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Audience extends Model
{
    // 1. Allow mass assignment for these fields
    protected $fillable = ['name', 'article_id', 'user_id'];

    // 2. An audience has one user
    public function user(): BelongsTo 
    { 
        return $this->belongsTo(User::class); 
    }

    // 4. Inverse: An audience belongs to an article
    public function article(): BelongsTo 
    { 
        return $this->belongsTo(Article::class); 
    }

    // 5. An audience have many comments (Polymorphic)
    public function comments(): MorphMany 
    { 
        return $this->morphMany(Comment::class, 'commentable'); 
    }
}
