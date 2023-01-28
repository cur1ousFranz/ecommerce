<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'country',
        'province',
        'barangay',
        'city',
        'address_line1',
        'zipcode',
        'note',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
