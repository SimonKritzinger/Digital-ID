<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table="provinces";

    protected $primaryKey="pr_id";

    public $timestamps=true;

    public function state(){
       return $this->belongsTo("App\State","state","s_id");
    }

    public function places(){
        return $this->hasMany("App\Place", "province","pr_id");
    }
}
