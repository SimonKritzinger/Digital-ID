<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKeysStaatsbuergerschaftensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("staatsbuergerschaftens",function(Blueprint $table){
            $table->primary(["bnummer","snummer"]);

            $table->foreign("bnummer")
                ->references("bnummer")->on("buerger")
                ->onUpdate("cascade")
                ->onDelete("cascade");
            $table->foreign("snummer")
                ->references("snummer")->on("staatens")
                ->onUpdate("cascade")
                ->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("staatsbuergerschaftens",function(Blueprint $table){
            $table->dropForeign("staatsbuergerschaftens_bnummer_foreign");
            $table->dropForeign("staatsbuergerschaftens_snummer_foreign");

        });
    }
}
