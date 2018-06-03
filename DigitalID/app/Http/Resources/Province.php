<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Province extends Resource
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
        $ret["state"] = $this->state()->first();
        return $ret;
    }
}
