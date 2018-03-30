<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provinzen extends Model
{
    protected $table="provinzens";

    protected $primaryKey="pnummer";

    protected $timestamps=true;

    public function staat(){
        $this->belongsTo("App\Staaten","snummer","snummer");
    }

    public function orte(){
        $this->hasMany("App\Orte", "pnumnmer","pnummer");
    }
}
