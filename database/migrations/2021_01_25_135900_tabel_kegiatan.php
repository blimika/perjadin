<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TabelKegiatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_kegiatan', function (Blueprint $table) {
            $table->increments('id_keg');
            $table->year('tahun_keg');
            $table->string('kode_prog',10);
            $table->string('kode_keg',4);
            $table->string('nama_keg',254);
            $table->string('singkatan_keg',10)->nullable();
            $table->string('pagu_keg',20)->nullable();
            $table->boolean('flag_kro')->default(0);
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
        Schema::dropIfExists('tbl_kegiatan');
    }
}
