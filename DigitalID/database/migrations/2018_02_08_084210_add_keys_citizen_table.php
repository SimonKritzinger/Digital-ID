<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKeysCitizenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("citizen",function(Blueprint $table){
            $table->foreign("birthPlace")
                ->references("pl_id")->on("places")
                ->onUpdate("cascade")
                ->onDelete("restrict");
            $table->foreign("place")
                ->references("pl_id")->on("places")
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
        Schema::table("citizen",function(Blueprint $table){
            $table->dropForeign("citizen_birthPlace_foreign");
            $table->dropForeign("citizen_place_foreign");

        });
    }
}
