<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aktionuser extends Model
{
    protected  $table="aktionusers";

    protected $primaryKey="aunummer";

    public $timestamps=true;
}
