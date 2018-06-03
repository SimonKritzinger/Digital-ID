<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Citizenship extends Model
{
    protected $table="citizenships";

    public $timestamps=true;

    public function state(){
        return $this->belongsTo("App\State","state","s_id");
    }

    public function citizen(){
        return $this->belongsTo("App\Citizen","citizen","c_id");
    }

    
}
