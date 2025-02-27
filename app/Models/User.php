<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function orders(): HasMany {
        return $this->hasMany(Order::class, 'by_user_id');
    }

    public function categories(): HasMany {
        return $this->hasMany(Category::class);
    }

    public function forums(): HasMany {
        return $this->hasMany(Forum::class);
    }

    public function topics(): HasMany {
        return $this->hasMany(Topic::class);
    }

    public function tags(): HasMany {
        return $this->hasMany(Tag::class);
    }

    public function posts(): HasMany {
        return $this->hasMany(Post::class);
    }
}
