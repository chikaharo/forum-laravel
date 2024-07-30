<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Forum extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = ['title', 'desc', 'category_id', 'user_id'];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function scopeLatest(Builder $query): Builder {
        return $query->orderBy('created_at', 'desc');
    }

    public function created_by(): BelongsTo {
        return $this->belongsTo(User::class);
    }   

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function topics(): HasMany {
        return $this->hasMany(Topic::class);
    }

    // public function posts(): HasMany {
    //     return $this->hasMany(Post::class);
    // }
}
