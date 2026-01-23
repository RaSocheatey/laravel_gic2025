<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; 
use Illuminate\Database\Eloquent\Relations\HasMany; 
use Illuminate\Database\Eloquent\Relations\HasManyThrough; 
use Illuminate\Database\Eloquent\Relations\MorphMany; 

class Author extends Model
{
    // Define which fields can be filled [cite: 41, 43]
    protected $fillable = ['name', 'user_id'];

    // 1. An author has one user [cite: 52]
    public function user(): BelongsTo 
    { 
        return $this->belongsTo(User::class); 
    }

    // 3. An author wrote multiple articles [cite: 54]
    public function articles(): HasMany 
    { 
        return $this->hasMany(Article::class); 
    }

    // 9. An author has many audience (via articles) [cite: 60]
    public function audiences(): HasManyThrough 
    { 
        return $this->hasManyThrough(Audience::class, Article::class); 
    }

    // 7. An author has many comments (Polymorphic) [cite: 58, 61]
    public function comments(): MorphMany 
    { 
        return $this->morphMany(Comment::class, 'commentable'); 
    }
}
