<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaporanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->bigIncrements('id_laporan');
            $table->enum('tahap', ['perencanaan','pelaksanaan','evaluasi','publikasi']);
            $table->date('tanggal_pelaksanaan');
            $table->text('deskripsi');
            $table->string('file_lapor');
            $table->timestamps();
            $table->unsignedBigInteger('id_progja');
            $table->foreign('id_progja')->references('id_progja')->on('progja');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan');
    }
}
