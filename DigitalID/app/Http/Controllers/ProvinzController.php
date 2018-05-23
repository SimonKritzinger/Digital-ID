<?php

namespace App\Http\Controllers;

use App\Province;
use App\Http\Resources\Province as ProvinceResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class ProvinzController extends Controller
{
    public function storeProvinz(Request $request){
        if(Gate::allows("isOfficial")) {
            $provinzen = $request->isMethod("put") ? Province::findOrFail($request->input("pr_id")) : new Province();
            $validator = "";
            if ($request->isMethod("put")) {
                $validator = Validator::make($request->all(), [
                    "name" => "required | max: 50",
                    "state.s_id" => "required | max: 50 | exists:states,s_id"
                ]);
            } else {
                $validator = Validator::make($request->all(), [
                    "name" => "required | max: 50 | unique:provinces",
                    "state.s_id" => "required | max: 50 | exists:states,s_id"
                ]);
            }
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            } else {
                $provinzen->name = $request->input("name");
                $provinzen->state = $request->input("state.s_id");
                if ($provinzen->save()) {
                    return new ProvinceResource($provinzen);
                } else {
                    return responce()->json([
                        "errors" => "error saving data"
                    ]);
                }
            }
        }
        else{
            return response()->json(["message" => "Unauthorized!"], 401);
        }
    }

    public function deleteProvinz($id){
        if(Gate::allows("isOfficial")) {
            $provinz = Province::findOrFail($id);
            if ($provinz->delete())
                return "deleted province successfully";
            else
                return "error deleting province";
        }
        else{
            return response()->json(["message" => "Unauthorized!"], 401);
        }
    }

    public function showProvinzById($id){
        if(Gate::allows("isOfficial")) {
            $provinzen = Province::findOrFail($id);
            return new ProvinceResource($provinzen);
        }
        else{
            return response()->json(["message" => "Unauthorized!"], 401);
        }
    }

    public function showProvinzByName($name){
        if(Gate::allows("isOfficial")) {
            $provinz = Province::where("name", "=", $name)->first();
            if (!$provinz->isEmpty()) {
                return new ProvinceResource($provinz);
            } else
                return response()->json([
                    "errors" => "Province doesn't exist"]);
        }
        else{
            return response()->json(["message" => "Unauthorized!"], 401);
        }
    }

    public function provinzenByState($s_id){
        if(Gate::allows("isOfficial")) {
            $provinzen = Province::where("state", "=", $s_id)->get();
            return ProvinceResource::collection($provinzen);
        }
        else{
            return response()->json(["message" => "Unauthorized!"], 401);
        }
    }
}
