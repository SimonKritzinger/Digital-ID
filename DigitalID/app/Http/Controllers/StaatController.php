<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staaten;
use App\Http\Resources\Staaten as StaatenResource;
use Illuminate\Support\Facades\Validator;

class StaatController extends Controller
{

    public function storeState(Request $request){
        $state = $request->isMethod("put") ? Staaten::findOrFail($request->input("snummer")) : new Staaten;
        $validator = Validator::make($request->all(),[
            "sname" => "required | max: 50"
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

    public function deleteState($snummer){

            $state = Staaten::findOrFail($snummer);
            if($state->delete())
                return "deleted state successfully";
            else
                return "error deleting state";

    }

    public function showStateById($snummer){
            $staat = Staaten::findOrFail($snummer);
            return new StaatenResource($staat);
    }

    public function showStateByName($sname){
        $staat = Staaten::where("sname","=",$sname)->first();
        if(!empty($staat)){
            return new StaatenResource($staat);
        }
        else
            return "State doesn't exist";
    }

    public function index(){
        $staaten = Staaten::all();
        return StaatenResource::collection($staaten);

    }

}
