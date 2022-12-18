<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'sku', 'description'
    ];


    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-F-Y');
    }

    public function product_variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function product_variant_prices()
    {
        return $this->hasMany(ProductVariantPrice::class, 'product_id', 'id');
    }
}