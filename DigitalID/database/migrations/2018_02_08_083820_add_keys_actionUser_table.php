<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKeysActionUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("actionUser",function(Blueprint $table){
            $table->foreign("user")
                ->references("u_id")->on("users")
                ->onUpdate("cascade")
                ->onDelete("restrict");
            $table->foreign("official")
                ->references("u_id")->on("users")
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
        Schema::table("actionUser",function(Blueprint $table){
            $table->dropForeign("actionUser_user_foreign");
            $table->dropForeign("actionUser_official_foreign");
        });
    }
}
