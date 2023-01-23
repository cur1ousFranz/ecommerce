<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id'];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('size', 'quantity');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
