<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductDetail;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [        
        'nama',
        'kategori',               
        'varian',
        'harga_satuan',
    ];
}
