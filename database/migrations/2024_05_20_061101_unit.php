<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Unit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('unit', function (Blueprint $table){
        $table->id();
        $table->text('idunit')->nullable();
        $table->text('unit')->nullable();
        $table->text('no_mulp')->nullable();
        $table->text('no_tlteknik')->nullable();
        $table->timestamps(true);
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
