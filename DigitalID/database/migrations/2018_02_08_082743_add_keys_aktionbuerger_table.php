<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKeysAktionbuergerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("aktionbuerger",function(Blueprint $table){
            $table->foreign("enummer")
                ->references("unummer")->on("users")
                ->onUpdate("cascade")
                ->onDelete("restrict");
            $table->foreign("bnummer")
                ->references("bnummer")->on("buerger")
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
        Schema::table("aktionbuerger",function(Blueprint $table){
            $table->dropForeign("aktionbuerger_enummer_foreign");
            $table->dropForeign("aktionbuerger_bnummer_foreign");
        });
    }
}
