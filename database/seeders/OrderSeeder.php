<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = 
        [
            [
                'kasir_id' => 2,
                'tanggal_pesan' => Carbon::yesterday('GMT+7')->format('Y-m-d'),
                'nama_pemesan' => 'Nabilah',
                'telepon' => '081234567890',
                'tanggal_kirim' => Carbon::now('GMT+7')->format('Y-m-d'),              
                'jam_kirim' => Carbon::now('GMT+7')->format('H:i:s'),
                'status_pembayaran' => 'Belum Lunas',
                'status_pengiriman' => 'Belum Dikirim',
                'metode_pengiriman' => 'Diantar',
                'status_pemesanan' => 'Diproses',
                'alamat' => 'Malang',
                'keterangan' => 'Taruh di depan rumah aja',
                'total_harga_pesanan' => 15000,
                'created_at' => Carbon::now('GMT+7'),
                'updated_at' => Carbon::now('GMT+7'),
            ],
            [
                'kasir_id' => 2,
                'tanggal_pesan' => Carbon::yesterday('GMT+7')->add(4, 'day')->format('Y-m-d'),
                'nama_pemesan' => 'Widiareta',
                'telepon' => '081222333444',
                'tanggal_kirim' => Carbon::now('GMT+7')->add(10, 'day')->format('Y-m-d'),              
                'jam_kirim' => Carbon::now('GMT+7')->add(10, 'day')->format('H:i:s'),
                'status_pembayaran' => 'Lunas',
                'status_pengiriman' => 'Terkirim',
                'metode_pengiriman' => 'Diambil',
                'status_pemesanan' => 'Selesai',
                'alamat' => 'Kepanjen',
                'keterangan' => '-',
                'total_harga_pesanan' => 12000,
                'created_at' => Carbon::now('GMT+7'),
                'updated_at' => Carbon::now('GMT+7'),
            ],
            [
                'kasir_id' => 2,
                'tanggal_pesan' => Carbon::yesterday('GMT+7')->add(14, 'day')->format('Y-m-d'),
                'nama_pemesan' => 'Yukafi',
                'telepon' => '081888555444',
                'tanggal_kirim' => Carbon::now('GMT+7')->add(19, 'day')->format('Y-m-d'),              
                'jam_kirim' => Carbon::now('GMT+7')->add(10, 'day')->format('H:i:s'),
                'status_pembayaran' => 'Belum Lunas',
                'status_pengiriman' => 'Belum Dikirim',
                'metode_pengiriman' => 'Diantar',
                'status_pemesanan' => 'Dibatalkan',
                'alamat' => 'Lumajang',
                'keterangan' => '-',
                'total_harga_pesanan' => 190000,
                'created_at' => Carbon::now('GMT+7'),
                'updated_at' => Carbon::now('GMT+7'),
            ],
        ];

        $order_details = [
            [
                'order_id' => 1,
                'product_id' => 15,
                'kuantitas' => 12,
                'harga_total' => 12000,
                'keterangan' => 'Kejunya tambahin',
                'created_at' => Carbon::now('GMT+7'),
                'updated_at' => Carbon::now('GMT+7'),  
            ],
            [
                'order_id' => 1,
                'product_id' => 24,
                'kuantitas' => 11,
                'harga_total' => 100921,
                'keterangan' => '-',
                'created_at' => Carbon::now('GMT+7'),
                'updated_at' => Carbon::now('GMT+7'),  
            ],
            [
                'order_id' => 1,
                'product_id' => 92,
                'kuantitas' => 1,
                'harga_total' => 5000,
                'keterangan' => '-',
                'created_at' => Carbon::now('GMT+7'),
                'updated_at' => Carbon::now('GMT+7'),  
            ],
            [
                'order_id' => 2,
                'product_id' => 37,
                'kuantitas' => 19,
                'harga_total' => 10921,
                'keterangan' => '-',
                'created_at' => Carbon::now('GMT+7'),
                'updated_at' => Carbon::now('GMT+7'),  
            ],
            [
                'order_id' => 2,
                'product_id' => 83,
                'kuantitas' => 10,
                'harga_total' => 82912,
                'keterangan' => '-',
                'created_at' => Carbon::now('GMT+7'),
                'updated_at' => Carbon::now('GMT+7'),  
            ],
            [
                'order_id' => 3,
                'product_id' => 71,
                'kuantitas' => 11,
                'harga_total' => 12222,
                'keterangan' => '-',
                'created_at' => Carbon::now('GMT+7'),
                'updated_at' => Carbon::now('GMT+7'),  
            ],
            [
                'order_id' => 3,
                'product_id' => 64,
                'kuantitas' => 12,
                'harga_total' => 88888,
                'keterangan' => '-',
                'created_at' => Carbon::now('GMT+7'),
                'updated_at' => Carbon::now('GMT+7'),  
            ],
            [
                'order_id' => 3,
                'product_id' => 92,
                'kuantitas' => 1,
                'harga_total' => 5000,
                'keterangan' => '-',
                'created_at' => Carbon::now('GMT+7'),
                'updated_at' => Carbon::now('GMT+7'),  
            ],
        ];
                
        DB::table('orders')->insert($orders);
        DB::table('order_details')->insert($order_details);        
    }
}
