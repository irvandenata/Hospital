<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKriteriaHasilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kriteria_hasils', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->unsignedBigInteger('luaran_id');
            $table->timestamps();
            $table->foreign('luaran_id')->references('id')->on('luarans')->onDelete('CASCADE')->onUpdate("CASCADE");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kriteria_hasils');
    }
}
