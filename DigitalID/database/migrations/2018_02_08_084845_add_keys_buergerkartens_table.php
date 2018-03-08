<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKeysBuergerkartensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("buergerkartens",function(Blueprint $table){
            $table->foreign("bnummer")
                ->references("bnummer")->on("buerger")
                ->onUpdate("cascade")
                ->onDelete("cascade");
            $table->primary("bkkartennummer");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("buergerkartens",function(Blueprint $table){
            $table->dropForeign("buergerkartens_bnummer_foreign");
            $table->dropPrimary("buergerkartens_bnummer_unique");
        });
    }
}
