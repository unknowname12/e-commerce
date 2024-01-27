<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'user_id'
    ];

    protected static function boot(): void
    {
        parent::boot();
        self::creating(function ($category){
            $category->slug = Str::slug($category->title . '-slug-' . Str::random(10));
        });
        self::updating(function ($category){
            $category->slug = Str::slug($category->title . '-slug-' . Str::random(10));
        });
    }

    public function products(): HasMany {return $this->hasMany(Product::class);}
    public function user(): BelongsTo {return $this->belongsTo(User::class);}
}
