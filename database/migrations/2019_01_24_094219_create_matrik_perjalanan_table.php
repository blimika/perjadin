<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatrikPerjalananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matrik', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_trx', 6)->nullable();
            $table->year('tahun_matrik');
            $table->date('tgl_awal');
            $table->date('tgl_akhir');
            $table->string('kodekab_tujuan', 4);
            $table->string('namakabkota_tujuan', 254)->nullable();
            $table->string('kepala_tujuan', 200)->nullable();
            $table->tinyInteger('lamanya');
            $table->integer('mak_id')->unsigned()->nullable();
            $table->integer('dana_tid')->unsigned()->nullable();
            $table->string('dana_mak', 30);
            $table->string('dana_pagu', 20);
            $table->string('dana_unitkerja', 4);
            $table->tinyInteger('lama_harian');
            $table->string('dana_harian', 20)->nullable();
            $table->string('total_harian', 20)->nullable();
            $table->string('dana_transport', 20)->nullable();
            $table->tinyInteger('lama_hotel');
            $table->string('dana_hotel', 20)->nullable();
            $table->string('total_hotel', 20)->nullable();
            $table->string('pengeluaran_rill', 20)->nullable();
            $table->string('total_biaya', 20)->nullable();
            $table->string('unit_pelaksana', 4)->nullable();
            $table->tinyInteger('flag_matrik')->nullable()->default(0);
            $table->tinyInteger('jenis_perjadin')->nullable()->default(1);
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
        Schema::dropIfExists('matrik');
    }
}
