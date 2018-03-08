<?php

namespace App\Http\Controllers;

use App\Provinzen;
use App\Http\Resources\Provinzen as ProvinzenRessourcen;
use Illuminate\Http\Request;

class ProvinzController extends Controller
{
    public function storeProvinz(Request $request){
        $state = $request->isMethod("put") ? Staaten::findOrFail($request->input("pnummer")) : new Provinzen();
        $validator = Validator::make($request->all(),[
            "pname" => "required | max: 50",
            "sname" => "required | max: 50 | exists:"
        ]);
        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
        }
        else {
            $state->sname = $request->input("sname");
            if($state->save()){
                return new StaatenResource($state);
            }
            else{
                return "error saving data";
            }
        }
    }
}
