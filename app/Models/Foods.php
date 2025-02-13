<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Foods extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'price_afterdiscount',
        'percent',
        'is_promo',
        'categories_id'
    ];

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }
}
