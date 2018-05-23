<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actionuser extends Model
{
    protected  $table="actionuser";

    protected $primaryKey="au_id";

    public $timestamps=true;
}
