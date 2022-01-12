<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntervensiRencanaAsuhansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intervensi_rencana_asuhan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rencana_asuhan_id');
            $table->unsignedBigInteger('intervensi_id');
            $table->string('hasil_observasi');
            $table->string('hasil_kolaborasi');
            $table->string('hasil_edukasi');
            $table->string('hasil_terapeutik');

            $table->timestamps();
            $table->foreign('rencana_asuhan_id')->references('id')->on('rencana_asuhans')->onDelete('CASCADE')->onUpdate("CASCADE");
            $table->foreign('intervensi_id')->references('id')->on('intervensis')->onDelete('CASCADE')->onUpdate("CASCADE");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('intervensi__rencana__asuhans');
    }
}
