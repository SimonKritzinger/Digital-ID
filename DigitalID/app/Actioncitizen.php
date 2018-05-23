<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actioncitizen extends Model
{
    protected $table = "actioncitizen";

    protected $primaryKey = "ac_id";

    public $timestamps = true;
}
