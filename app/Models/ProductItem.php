<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'sku',
        'qty_stock',
        'product_image',
        'price',
        'sale_price',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
