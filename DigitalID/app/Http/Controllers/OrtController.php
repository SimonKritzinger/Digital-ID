<?php

namespace App\Http\Controllers;

use App\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Place as PlaceResource;

class OrtController extends Controller
{
    public function storePlace(Request $request){
        if(Gate::allows("isOfficial")) {
            $orte = $request->isMethod("put") ? Place::findOrFail($request->input("pl_id")) : new Place();
            $validator = "";
            if ($request->isMethod("put")) {
                $validator = Validator::make($request->all(), [
                    "name" => "required | max: 50 ",
                    "province.pr_id" => "required | max: 50 | exists:provinces,pr_id"
                ]);
            } else {
                $validator = Validator::make($request->all(), [
                    "name" => "required | max: 50 | unique:places",
                    "province.pr_id" => "required | max: 50 | exists:provinces,pr_id"
                ]);
            }

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            } else {
                $orte->name = $request->input("name");
                $orte->province = $request->input("province.pr_id");
                if ($orte->save()) {
                    return new PlaceResource($orte);
                } else {
                    return "error saving data";
                }
            }
        }
        else{
            return response()->json(["message" => "Unauthorized!"], 401);
        }
    }

    public function deletePlace($id){
        if(Gate::allows("isOfficial")) {
            $ort = Place::findOrFail($id);
            if ($ort->delete())
                return "deleted place successfully";
            else
                return "error deleting place";
        }
        else{
            return response()->json(["message" => "Unauthorized!"], 401);
        }

    }

    public function showPlaceById($id){
        if(Gate::allows("isOfficial")) {
            $ort = Place::findOrFail($id);
            return new PlaceResource($ort);
        }
        else{
            return response()->json(["message" => "Unauthorized!"], 401);
        }
    }

    public function showPlaceByName($name){
        if(Gate::allows("isOfficial")) {
            $ort = Place::where("name", "=", $name)->first();
            if (!$ort->isEmpty()) {
                return new PlaceResource($ort);
            } else
                return "Place doesn't exist";
        }
        else{
            return response()->json(["message" => "Unauthorized!"], 401);
        }
    }

    public function placeByProvinz($pr_id){
        if(Gate::allows("isOfficial")) {
            $orte = Place::where("province", "=", $pr_id)->get();
            return PlaceResource::collection($orte);
        }
        else{
            return response()->json(["message" => "Unauthorized!"], 401);
        }
    }
}
