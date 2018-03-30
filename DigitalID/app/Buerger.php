<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buerger extends Model
{
    protected $table="buerger";

    protected $primaryKey="bnummer";

    public $timestamps=true;

    public function buergerkarte(){
        return $this->hasOne("App\Buergerkarten","bnummer","bnummer");
    }

    public function bgeburtsort(){
        return $this->belongsTo("App\Orte","bgeburtsort","onummer");
    }

    public function bwohnort(){
        return $this->belongsTo("App\Orte","bwohnort","onummer");
    }
}
