<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Buerger extends Resource
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
        unset($ret["bbild"]);
        $ret["bgeburtsort"] = $this->bgeburtsort()->first();
        $ret["bwohnort"] = $this->bwohnort()->first();
        return $ret;
    }
}
