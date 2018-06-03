<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table="users";

    protected $primaryKey="u_id";

    public $timestamps=true;

    use HasApiTokens, Notifiable;

    public function Citizen(){
        return $this->$this->belongsTo("App\Citizen","citizen","c_id");
    }

}
