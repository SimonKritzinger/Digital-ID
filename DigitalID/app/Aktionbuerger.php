<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aktionbuerger extends Model
{
    protected $table = "aktionbueger";

    protected $primaryKey = "abnummer";

    public $timestamps = true;
}
