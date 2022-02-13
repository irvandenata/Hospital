<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRencanaAsuhansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rencana_asuhans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('diagnosa_id');
            $table->unsignedBigInteger('luaran_id');
            $table->string('nama_ruangan');
            $table->string('tanggal');
            $table->string('jam');
            $table->string('ppja');
            $table->text('tambahan_diagnosa_subjektif')->nullable();
            $table->text('tambahan_diagnosa_objektif')->nullable();
            $table->text('tambahan_diagnosa_penyebab')->nullable();
            $table->string('hasil_diagnosa');
            $table->string('hasil_luaran');
            $table->string('penanggung_jawab');
            $table->integer('jumlah_intervensi');

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
        Schema::dropIfExists('rencana_asuhans');
    }
}
