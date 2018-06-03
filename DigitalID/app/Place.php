<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $table="places";

    protected $primaryKey="pl_id";

    public $timestamps=true;

    public function citizenBornIn(){
        return $this->hasMany("App\Citizen","birthPlace","pl_id");
    }

    public function citizenLivingIn(){
        return $this->hasMany("App\Citizen","place","pl_id");
    }

    public function province(){
        return $this->belongsTo("App\Province","province","pr_id");
    }
}
