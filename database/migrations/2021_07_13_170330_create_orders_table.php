<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kasir_id');
            $table->foreign('kasir_id')->references('id')->on('users')->onDelete('cascade');
            $table->date('tanggal_pesan');
            $table->string('nama_pemesan');
            $table->string('telepon');
            $table->date('tanggal_kirim');
            $table->time('jam_kirim');
            $table->enum('status_pembayaran', ['Lunas', 'Belum Lunas'])->default('Belum Lunas');
            $table->enum('status_pengiriman', ['Belum Dikirim', 'Terkirim'])->default('Belum Dikirim');
            $table->enum('metode_pengiriman', ['Diantar', 'Diambil'])->nullable();
            $table->enum('status_pemesanan', ['Dibatalkan', 'Diproses', 'Selesai'])->default('Diproses');
            $table->string('alamat');
            $table->string('keterangan')->nullable()->default('-');
            $table->integer('total_harga_pesanan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
