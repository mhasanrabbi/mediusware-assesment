<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    public function variants()
    {
        return $this->belongsTo(Variant::class, 'variant_id', 'id');
    }
}