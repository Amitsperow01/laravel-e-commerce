<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class Product extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia ;
    protected $fillable = [
        'name',
        'status',
        'is_featured',
        'sku',
        'qty',
        'stock_status',
        'weight',
        'price',
        'special_price',
        'special_price_from',
        'special_price_to',
        'short_description',
        'description',
        'related_product',
        'url_key',
        'meta_tag',
        'meta_title',
        'meta_description'
    ];

    public function categories(){
        return $this->BelongsToMany(Category::class,'product_categories');
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }
}