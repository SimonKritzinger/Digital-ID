<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staaten extends Model
{
    protected $table="staatens";

    protected $primaryKey="snummer";

    public $timestamps=true;

    public function provinzen(){
        $this->hasMany("App\Provinzen","snummer","snummer");
    }
}
