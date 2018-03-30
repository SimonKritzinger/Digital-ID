<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKeysUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("users",function(Blueprint $table){
            $table->foreign("bnummer")
                ->references("bnummer")->on("buerger")
                ->onUpdate("cascade")
                ->onDelete("restrict");
            $table->unique(['bnummer','urolle']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("users",function(Blueprint $table){
            $table->dropForeign("users_bnummer_foreign");
            $table->dropUnique("users_bnummer_urolle_unique");
        });
    }
}
