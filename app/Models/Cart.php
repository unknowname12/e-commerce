<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'product_id',
        'status',
        'price',
        'slug',
        'qyt'
    ];

    public function getFormat($amount): string
    {
        return 'IDR. ' . number_format(($amount), 0, ',', '.');
    }



    public function getTotalPriceQyt(): string
    {
        $price = $this->qyt * $this->price;
        return $this->getFormat($price);
    }

    public function getPriceByFormat(): string
    {
        return $this->getFormat($this->price);
    }

    protected static function boot(): void
    {
        parent::boot();
        self::creating(function ($cart){
            $cart->slug = Str::slug($cart->name . '-slug-' . Str::random(10));
        });
        self::updating(function ($cart){
            $cart->slug = Str::slug($cart->name . '-slug-' . Str::random(10));
        });
    }

    public function product(): BelongsTo { return $this->belongsTo(Product::class); }
    public function user(): BelongsTo { return $this->belongsTo(User::class); }
}
