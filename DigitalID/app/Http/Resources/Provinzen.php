<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Provinzen extends Resource
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
        $ret["snummer"] = $this->staat()->first();
        return $ret;
    }
}
