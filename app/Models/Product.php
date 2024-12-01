<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'cost_price',
        'selling_price',
        'quantity',
        'description',
        'image1',
        'image2',
        'image3',
        'status'
    ];
}
