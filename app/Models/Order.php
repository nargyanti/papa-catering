<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDetail;
use App\Models\User;
use App\Models\Pemasukan;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [        
        'tanggal_pesan',
        'nama_pemesan',               
        'telepon',
        'tanggal_kirim',
        'jam_kirim',
        'status_pembayaran',
        'status_pengiriman',
        'metode_pengiriman',
        'alamat',
        'keterangan',
    ];

    public function order_detail()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'kasir_id', 'id');
    } 

    
    public function pemasukan()
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function setCurrency($uang){
        return number_format($angka,0, ',' , '.'); 
    }
}
