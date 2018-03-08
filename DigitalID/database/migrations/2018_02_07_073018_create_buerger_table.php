<?php

use Illuminate\Support\Facades\Schema;
use \Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuergerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buerger', function (Blueprint $table) {
            $table->increments('bnummer');
            $table->string("bvorname",50);
            $table->string("bnachname",50);
            $table->string("bsteuernummer",50)->unique();
            $table->string("bhash",60)->unique();
            $table->date("bgeburtsdatum");
            $table->integer("bgeburtsort")->unsigned();
            $table->string("bstrasse",50);
            $table->string("bstrassennummmer",20);
            $table->integer("bwohnort")->unsigned();
            $table->enum("bfamilienstand",['ledig','verheiratet','verwitwet','geschieden',
                'Ehe aufgehoben','eingetragene Lebenspartnerschaft','durch Tod aufgeloeste Lebenspartnerschaft',
                'aufgehobene Lebenspartnerschaft','durch Todeserklaerung aufgeloeste Lebenspartnerschaft'])->nullable();
            $table->string("bberuf",50)->nullable();
            $table->tinyInteger("bgroesse")->unsigned();
            $table->string("bhaare",30);
            $table->string("baugen",30);
            $table->string("bbeskennzeichen",150)->nullable();
            $table->enum("bstatus",['lebendig','verschwunden',
                'gesucht','verstorben'])->nullable();
            $table->boolean("bgeschlecht");
            $table->boolean("geloescht")->default(false);
            $table->dateTime("bloeschdatum")->nullable();
            $table->timestamps();
        });
        DB::statement("ALTER TABLE buerger ADD bbild MEDIUMBLOB NOT NULL AFTER bbeskennzeichen");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buerger');
    }
}
