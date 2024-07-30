<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'desc', 'image', 'user_id'];

    public function created_by(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function forums(): HasMany {
        return $this->hasMany(Forum::class);
    }

    public function scopeLatest(Builder $query): Builder {
        return $query->orderBy('created_at', 'desc');
    }

}
