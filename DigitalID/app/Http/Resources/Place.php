<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Place extends Resource
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
        $ret["province"] = $this->province()->first();
        $ret["province"]["state"] = $this->province()->first()->state()->first();
        return $ret;
    }
}
