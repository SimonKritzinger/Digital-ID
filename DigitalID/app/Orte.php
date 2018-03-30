<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orte extends Model
{
    protected $table="ortes";

    protected $primaryKey="onummer";

    public $timestamps=true;

    public function buergerGeborenIn(){
        return $this->hasMany("App\Buerger","bgeburtsort","onummer");
    }

    public function buergerWohnhaftIn(){
        return $this->hasMany("App\Buerger","bwohnort","onummer");
    }

    public function provinz(){
        return $this->belongsTo("App\Provinzen","pnummer","pnummer");
    }
}
