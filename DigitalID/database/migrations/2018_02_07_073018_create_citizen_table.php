<?php

use Illuminate\Support\Facades\Schema;
use \Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitizenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citizen', function (Blueprint $table) {
            $table->increments('c_id');
            $table->string("name",50);
            $table->string("lastname",50);
            $table->string("taxId",50)->unique();
            $table->string("hash",60)->unique();
            $table->date("birthDate");
            $table->integer("birthPlace")->unsigned();
            $table->string("street",50);
            $table->string("houseNumber",20);
            $table->integer("place")->unsigned();
            $table->enum("maritalStatus",['ledig','verheiratet','verwitwet','geschieden',
                'Ehe aufgehoben','eingetragene Lebenspartnerschaft','durch Tod aufgeloeste Lebenspartnerschaft',
                'aufgehobene Lebenspartnerschaft','durch Todeserklaerung aufgeloeste Lebenspartnerschaft'])->nullable();
            $table->string("occupation",50)->nullable();
            $table->tinyInteger("height")->unsigned();
            $table->string("hair",30);
            $table->string("eyes",30);
            $table->string("specialMarks",150)->nullable();
            $table->enum("state",['lebendig','verschwunden',
                'gesucht','verstorben'])->nullable();
            $table->boolean("gender");
            $table->boolean("deleted")->default(false);
            $table->dateTime("deleteDate")->nullable();
            $table->timestamps();
        });
        DB::statement("ALTER TABLE citizen ADD picture MEDIUMBLOB NOT NULL AFTER specialMarks");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('citizen');
    }
}
