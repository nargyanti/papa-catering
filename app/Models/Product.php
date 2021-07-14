<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDetail;

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

    public function order_detail()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
