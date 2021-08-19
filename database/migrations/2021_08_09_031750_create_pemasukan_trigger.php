<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemasukanTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER tr_Pengeluaran_Rekap AFTER INSERT ON `pengeluaran` FOR EACH ROW
            BEGIN
                INSERT INTO rekap_data (`id_pengeluaran`, `tanggal_pengeluaran`, `nominal_pengeluaran`) 
                VALUES (NEW.id, NEW.tanggal_pengeluaran, NEW.nominal);
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
        DB::unprepared('DROP TRIGGER `tr_Pengeluaran_Rekap`');
    }
}
