<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Buergerkarten extends Resource
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
        $ret["bnummer"] = $this->Buerger()->first();
        return $ret;
    }
}
