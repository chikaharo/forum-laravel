<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Topic extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = ['title', 'desc', 'user_id', 'forum_id', 'slug', 'image', 'notify'];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function forum(): BelongsTo {
        return $this->belongsTo(Forum::class);
    }
    
    public function posts(): HasMany {
        return $this->hasMany(Topic::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter(Builder $query, array $filters): Builder {
        return $query->when($filters['title'] ?? false, function(Builder $query, string $value) {
            $query->where('title', 'like', '%'. $value .'%' );
        })->when($filters['filterBy']  ?? false , function(Builder $query, string $filterBy) use ($filters) {
            if($filterBy === 'posts') {
                $query->withCount('posts')->orderBy('posts_count', $filters['filterType'] ?? 'desc');
            } else {
                $query->orderBy($filterBy, $filters['filterType'] ?? 'desc');
            }
        });
    }
}
