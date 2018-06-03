<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Citizencard extends Resource
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
        $ret["citizen"] = $this->citizen()->first();
        unset($ret["citizen"]["picture"]);
        $ret["citizen"]["birthPlace"] = $this->citizen()->first()->birthplace()->first();
        $ret["citizen"]["birthPlace"]["province"] = $this->citizen()->first()->birthplace()->first()->province()->first();
        $ret["citizen"]["birthPlace"]["province"]["state"] = $this->citizen()->first()->birthplace()->first()->province()->first()->state()->first();

        $ret["citizen"]["place"] = $this->citizen()->first()->place()->first();
        $ret["citizen"]["place"]["province"] = $this->citizen()->first()->place()->first()->province()->first();
        $ret["citizen"]["place"]["province"]["state"] = $this->citizen()->first()->place()->first()->province()->first()->state()->first();
        return $ret;
    }
}
