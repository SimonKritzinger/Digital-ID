<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKeysOrtesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("ortes",function(Blueprint $table){
            $table->foreign("pnummer")
                ->references("pnummer")->on("provinzens")
                ->onUpdate("cascade")
                ->onDelete("restrict");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("ortes",function(Blueprint $table){
            $table->dropForeign("ortes_pnummer_foreign");
        });
    }
}
