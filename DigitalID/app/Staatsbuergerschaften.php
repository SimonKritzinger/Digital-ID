<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staatsbuergerschaften extends Model
{
    protected $table="buergerkartens";

    protected $primaryKey=["bnummer","snummer"];

    public $timestamps=true;


    
}
