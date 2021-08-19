<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekapDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekap_data', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pengeluaran')->nullable();
            $table->integer('id_pemasukan')->nullable();
            $table->date('tanggal_pengeluaran')->nullable();
            $table->date('tanggal_pemasukan')->nullable();
            $table->integer('nominal_pengeluaran')->nullable()->default('0');
            $table->integer('nominal_pemasukan')->nullable()->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rekap_data');
    }
}
