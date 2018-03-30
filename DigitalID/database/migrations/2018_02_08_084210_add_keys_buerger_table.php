<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKeysBuergerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("buerger",function(Blueprint $table){
            $table->foreign("bgeburtsort")
                ->references("onummer")->on("ortes")
                ->onUpdate("cascade")
                ->onDelete("restrict");
            $table->foreign("bwohnort")
                ->references("onummer")->on("ortes")
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
        Schema::table("buerger",function(Blueprint $table){
            $table->dropForeign("buerger_bgeburtsort_foreign");
            $table->dropForeign("buerger_bwohnort_foreign");

        });
    }
}
