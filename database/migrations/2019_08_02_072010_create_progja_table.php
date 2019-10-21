<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progja', function (Blueprint $table) {
            $table->bigIncrements('id_progja');
            $table->string('nama_progja', 100);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->timestamps();
            $table->unsignedBigInteger('id_tahun_anggaran');
            $table->foreign('id_tahun_anggaran')->references('id_tahun_anggaran')->on('tahun_anggaran');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('progja');
    }
}
