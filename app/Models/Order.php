<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['by_user_id', 'beds', 'baths', 'city', 'code', 'street', 'street_nr', 'price'];
    
    public function owner(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function scopeLatest(Builder $query): Builder {
        return $query->orderBy('created_at', 'asc');
    }

    public function scopeFilter(Builder $query, array $filters): Builder {
        return $query->when($filters['priceFrom'] ?? false, function (Builder $query, string $value) {
            $query->where('price', '>=', $value);
        })->when($filters['priceTo'] ?? false, function (Builder $query, string $value) {
            $query->where('price', '<=', $value);
        })->when($filters['beds'] ?? false, function (Builder $query, string $value) {
            $query->where('beds', (int)$value > 5 ? '>=' : '=', $value);
        })->when($filters['baths'] ?? false, function (Builder $query, string $value) {
            $query->where('baths', (int)$value > 5 ? '>=' : '=', $value);
        });
    }
}
