<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasSlug;
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'quantity',
        'description',
        'published',
        'inStock',
        'price',
        'category_id',
        'brand_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function product_images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function scopeFiltered(Builder $query)
    {
        $query->when(request('brands'), function (Builder $q) {
            $q->whereIn('brand_id', request('brands'));
        })
        ->when(request('categories'), function (Builder $q) {
            $q->whereIn('category_id', request('categories'));
        })
        ->when(request('prices'), function (Builder $q) {
            $q->whereBetween('prices', [
                request('prices.from', 0),
                request('princes.to', 100000),
            ]);
        });
    }
}
