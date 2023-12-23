<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPasientoTableIntervensi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable("rencana_asuhans")){
           if(!(Schema::hasColumn("rencana_asuhans","pasien"))){
                Schema::table('rencana_asuhans', function (Blueprint $table) {
                  $table->string('pasien')->nullable();
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
