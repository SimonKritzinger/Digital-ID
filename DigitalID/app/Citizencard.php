<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Citizencard extends Model
{
    protected $table="citizencards";

    protected $primaryKey="cc_Id";

    public $incrementing=false;

    public $timestamps=true;

    protected $keyType="string";

    public function citizen(){
        return $this->belongsTo("App\Citizen","citizen","c_id");
    }
}
