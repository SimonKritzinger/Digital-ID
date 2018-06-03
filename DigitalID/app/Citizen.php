<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Citizen extends Model
{
    protected $table="citizen";

    protected $primaryKey="c_id";

    public $timestamps=true;

    public function citizenCard(){
        return $this->hasOne("App\Citizencard","citizen","c_id");
    }

    public function birthplace(){
        return $this->belongsTo("App\Place","birthPlace","pl_id");
    }

    public function place(){
        return $this->belongsTo("App\Place","place","pl_id");
    }
}
