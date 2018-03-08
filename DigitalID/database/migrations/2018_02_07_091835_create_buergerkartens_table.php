<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuergerkartensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buergerkartens', function (Blueprint $table) {
            $table->string('bkkartennummer',10);
            $table->integer("bnummer")->unique()->unsigned();
            $table->date("bkablaufdatum");
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
        Schema::dropIfExists('buergerkartens');
    }
}
