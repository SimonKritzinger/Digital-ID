<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAktionusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aktionusers', function (Blueprint $table) {
            $table->increments('aunummer');
            $table->integer("unummer")->unsigned();
            $table->integer("aubearbeiter")->unsigned();
            $table->enum("auaktion",['hinzufuegen','bearbeiten','loeschen']);
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
        Schema::dropIfExists('aktionusers');
    }
}
