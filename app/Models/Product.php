<?php

namespace App\Models;

use App\Models\Category;
use App\Models\ProductItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'name',
        'description',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function productItem()
    {
        return $this->hasOne(ProductItem::class);
    }
}
