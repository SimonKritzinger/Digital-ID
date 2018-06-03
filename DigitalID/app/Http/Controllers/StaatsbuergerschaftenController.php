<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Citizenship;
use App\Http\Resources\Citizenship as CitizenshipResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class StaatsbuergerschaftenController extends Controller
{
    public function store(Request $request){
        if(Gate::allows("isOfficial")) {
            $citizenship = new Citizenship();
            $validator = Validator::make($request->all(), [
                "state.s_id" => "required | max: 50 | exists:states,s_id| unique-with:citizenships,citizen",
                "citizen.c_id" => "required | max: 50 | exists:citizen,c_id"
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            } else {
                $citizenship->state = $request->input("state.s_id");
                $citizenship->citizen = $request->input("citizen.c_id");
                if ($citizenship->save()) {
                    return new CitizenshipResource($citizenship);
                }
                /*DB::table("citizenships")->insert([
                    "citizen" => $request->input("citizen"),
                    "state" => $request->input("state"),
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ]);
                    return new CitizenshipResource(DB::table("citizenships")->where([
                        ["citizen","=",$request->input("citizen")],
                        ["state","=",$request->input("state")]
                    ])->first());
                */

            }
        }
        else{
            return response()->json(["message" => "Unauthorized!"], 401);
        }
    }

    public function delete($citizen, $state){
        if(Gate::allows("isOfficial")) {
            $staatsbuergerschaft = Citizenship::where([
                ["citizen", "=", $citizen],
                ["state", "=", $state]
            ])->first();
            if ($staatsbuergerschaft->isEmpty()) {
                return response()->json([
                    'message' => "No citizenship found"
                ], 404);
            }
            if (Citizenship::where([
                ["citizen", "=", $citizen],
                ["state", "=", $state]
            ])->delete()) {
                return "Deleted successfully";
            } else {
                return "Error while deleting";
            }
        }
        else{
            return response()->json(["message" => "Unauthorized!"], 401);
        }
    }

    public function getStaatsbuergerschaften($citizen){
        if(Gate::allows("isOfficial")) {
            $staatsbuergerschaften = Citizenship::where("citizen", $citizen)->get();
            return CitizenshipResource::collection($staatsbuergerschaften);
        }
        else{
            return response()->json(["message" => "Unauthorized!"], 401);
        }
    }

    public function getStaatsbuerger($s_id){
        if(Gate::allows("isUser")) {
            $staatsbuergschaften = Citizenship::where("state", $s_id)->get();
            return CitizenshipResource::collection($staatsbuergschaften);
        }
        else{
            return response()->json(["message" => "Unauthorized!"], 401);
        }
    }
}
