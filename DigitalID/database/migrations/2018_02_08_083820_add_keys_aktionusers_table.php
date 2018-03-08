<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKeysAktionusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("aktionusers",function(Blueprint $table){
            $table->foreign("unummer")
                ->references("unummer")->on("users")
                ->onUpdate("cascade")
                ->onDelete("restrict");
            $table->foreign("aubearbeiter")
                ->references("unummer")->on("users")
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
        Schema::table("aktionusers",function(Blueprint $table){
            $table->dropForeign("aktionusers_unummer_foreign");
            $table->dropForeign("aktionusers_aubearbeiter_foreign");
        });
    }
}
