<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buergerkarten extends Model
{
    protected $table="buergerkartens";

    protected $primaryKey="bkkartennummer";

    public $incrementing=false;

    public $timestamps=true;

    protected $keyType="string";

    public function Buerger(){
        return $this->belongsTo("App\Buerger","bnummmer","bnummer");
    }
}
