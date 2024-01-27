<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'images',
        'title',
        'slug',
        'price',
        'category_id',
        'user_id'
    ];

    protected static function boot(): void
    {
        parent::boot();
        self::creating(function ($product){
            $product->slug = Str::slug($product->title . '-slug-' . Str::random(10));
        });
        self::updating(function ($product){
            $product->slug = Str::slug($product->title . '-slug-' . Str::random(10));
        });
    }

    public function getPriceByFormat(): string
    {
        return 'IDR. ' . number_format(($this->price), 0, ',', '.');
    }

    public function category(): BelongsTo { return $this->belongsTo(Category::class); }
    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function carts(): HasMany { return $this->hasMany(Cart::class); }
}
