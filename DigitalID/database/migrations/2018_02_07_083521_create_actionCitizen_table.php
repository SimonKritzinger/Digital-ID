<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionCitizenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actionCitizen', function (Blueprint $table) {
            $table->increments('ac_id');
            $table->integer("official")->unsigned();
            $table->integer("citizen")->unsigned();
            $table->enum("actionType",['add','update','delete']);
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
        Schema::dropIfExists('actionCitizen');
    }
}
