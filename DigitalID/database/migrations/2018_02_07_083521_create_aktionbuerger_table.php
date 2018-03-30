<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAktionbuergerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aktionbuerger', function (Blueprint $table) {
            $table->increments('abnummer');
            $table->integer("enummer")->unsigned();
            $table->integer("bnummer")->unsigned();
            $table->enum("abaktion",['hinzufuegen','bearbeiten','loeschen']);
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
        Schema::dropIfExists('aktionbuerger');
    }
}
