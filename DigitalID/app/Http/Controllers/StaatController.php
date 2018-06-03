<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use App\Http\Resources\State as StateResource;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class StaatController extends Controller
{

    public function storeState(Request $request){
        if(Gate::allows("isOfficial")) {
            $state = $request->isMethod("put") ? State::findOrFail($request->input("s_id")) : new State;
            if ($request->isMethod("put")) {
                $validator = Validator::make($request->all(), [
                    "name" => "required | max: 50"
                ]);
            } else {
                $validator = Validator::make($request->all(), [
                    "name" => "required | max: 50 | unique:states"
                ]);
            }
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            } else {
                $state->name = $request->input("name");
                if ($state->save()) {
                    return new StateResource($state);
                } else {
                    return "error saving data";
                }
            }
        }
        else{
            return response()->json(["message" => "Unauthorized!"], 401);
        }
    }

    public function deleteState($id){
        if(Gate::allows("isOfficial")) {
            $state = State::findOrFail($id);
            if ($state->delete())
                return "deleted state successfully";
            else
                return "error deleting state";
        }
        else{
            return response()->json(["message" => "Unauthorized!"], 401);
        }
    }

    public function showStateById($id){
        if(Gate::allows("isOfficial")) {
            $staat = State::findOrFail($id);
            return new StateResource($staat);
        }
        else{
            return response()->json(["message" => "Unauthorized!"], 401);
        }
    }

    public function showStateByName($name){
        if(Gate::allows("isOfficial")) {
            $staat = State::where("name", "=", $name)->first();
            if (!$staat->isEmpty()) {
                return new StateResource($staat);
            } else
                return "State doesn't exist";
        }
        else{
            return response()->json(["message" => "Unauthorized!"], 401);
        }
    }

    public function index(){
        if(Gate::allows("isOfficial")) {
            $staaten = State::all();
            return StateResource::collection($staaten);
        }
        else{
            return response()->json(["message" => "Unauthorized!"], 401);
        }

    }

}
