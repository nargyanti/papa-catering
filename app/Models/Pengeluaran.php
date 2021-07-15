<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Pengeluaran extends Model
{
    use HasFactory;
    protected $table = 'pengeluaran';

    protected $fillable = [        
        'tanggal_pengeluaran',
        'jenis_beban',               
        'jenis_pengeluaran',
        'metode_transaksi',
        'foto_bukti',
        'nominal',
        'keterangan',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    } 
}
