<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKeysProvinzensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("provinzens",function(Blueprint $table){
            $table->foreign("snummer")
                ->references("snummer")->on("staatens")
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
        Schema::table("provinzens",function(Blueprint $table){
            $table->dropForeign("provinzens_snummer_foreign");
        });
    }
}
