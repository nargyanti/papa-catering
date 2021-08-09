<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER tr_Pemasukan_Rekap AFTER INSERT ON `pemasukan` FOR EACH ROW
            BEGIN
                INSERT INTO rekap_data (`id_pemasukan`, `tanggal_pemasukan`, `nominal_pemasukan`) 
                VALUES (NEW.id, NEW.tanggal_bayar, NEW.nominal);
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `tr_Pemasukan_Rekap`');
    }
}
