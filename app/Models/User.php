<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'slug'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    protected static function boot(): void
    {
        parent::boot();
        self::creating(function ($user){
            $user->slug = Str::slug($user->name . '-slug-' . Str::random(10));
        });
        self::updating(function ($user){
            $user->slug = Str::slug($user->name . '-slug-' . Str::random(10));
        });
    }

    public function categories(): HasMany { return $this->hasMany(Category::class); }
    public function products(): HasMany { return $this->hasMany(Product::class); }
    public function carts(): HasMany { return $this->hasMany(Cart::class); }
}
