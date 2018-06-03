<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Citizen extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $ret = parent::toArray($request);
        unset($ret["picture"]);
        $ret["birthPlace"] = $this->birthplace()->first();
        $ret["birthPlace"]["province"] = $this->birthplace()->first()->province()->first();
        $ret["birthPlace"]["province"]["state"] = $this->birthplace()->first()->province()->first()->state()->first();

        $ret["place"] = $this->place()->first();
        $ret["place"]["province"] = $this->place()->first()->province()->first();
        $ret["place"]["province"]["state"] = $this->place()->first()->province()->first()->state()->first();
        return $ret; 
    }
}
