<?php

namespace App\Models;

use App\Models\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Value extends Model
{
    use HasFactory;

    protected $fillable = [
        'attribute_id',
        'name'
    ];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
