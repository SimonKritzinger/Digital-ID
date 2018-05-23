<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKeysActionCitizenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("actionCitizen",function(Blueprint $table){
            $table->foreign("official")
                ->references("u_id")->on("users")
                ->onUpdate("cascade")
                ->onDelete("restrict");
            $table->foreign("citizen")
                ->references("c_id")->on("citizen")
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
        Schema::table("actionCitizen",function(Blueprint $table){
            $table->dropForeign("actionCitizen_official_foreign");
            $table->dropForeign("actionCitizen_citizen_foreign");
        });
    }
}
