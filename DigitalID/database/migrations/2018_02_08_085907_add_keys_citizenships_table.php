<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKeysCitizenshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("citizenships",function(Blueprint $table){
            $table->primary(["citizen","state"]);

            $table->foreign("citizen")
                ->references("c_id")->on("citizen")
                ->onUpdate("cascade")
                ->onDelete("cascade");
            $table->foreign("state")
                ->references("s_id")->on("states")
                ->onUpdate("cascade")
                ->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("citizenships",function(Blueprint $table){
            $table->dropForeign("citizenships_citizen_foreign");
            $table->dropForeign("citizenships_state_foreign");

        });
    }
}
