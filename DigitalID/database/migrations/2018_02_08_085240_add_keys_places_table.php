<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKeysPlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("places",function(Blueprint $table){
            $table->foreign("province")
                ->references("pr_id")->on("provinces")
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
        Schema::table("places",function(Blueprint $table){
            $table->dropForeign("places_province_foreign");
        });
    }
}
