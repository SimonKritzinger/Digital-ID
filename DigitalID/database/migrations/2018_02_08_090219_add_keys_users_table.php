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
            $table->foreign("citizen")
                ->references("c_id")->on("citizen")
                ->onUpdate("cascade")
                ->onDelete("restrict");
            $table->unique(['citizen','role']);
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
            $table->dropForeign("users_citizen_foreign");

        });
    }
}
