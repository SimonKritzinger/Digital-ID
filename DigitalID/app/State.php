<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table="states";

    protected $primaryKey="s_id";

    public $timestamps=true;

    public function provinces(){
        $this->hasMany("App\Province","state","s_id");
    }
}
