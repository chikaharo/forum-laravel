<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = ['title', 'image', 'topic_id', 'user_id', 'forum_id'];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function topic(): BelongsTo {
        return $this->belongsTo(Topic::class);
    }

    // public function forum(): BelongsTo {
    //     return $this->belongsTo(Forum::class);
    // }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

}
