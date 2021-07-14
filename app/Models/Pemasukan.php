<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Pemasukan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'pemasukan';
    protected $fillable = [        
        'order_id',
        'tanggal_bayar',
        'nominal',
        'metode_transaksi',
        'foto_bukti'

    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }

}
