<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKeysCitizenCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("citizenCards",function(Blueprint $table){
            $table->foreign("citizen")
                ->references("c_id")->on("citizen")
                ->onUpdate("cascade")
                ->onDelete("cascade");
            $table->primary("cc_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("citizenCards",function(Blueprint $table){
            $table->dropForeign("citizenCards_citizen_foreign");
        });
    }
}
