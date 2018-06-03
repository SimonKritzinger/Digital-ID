<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\User as UserResource;

class UserController extends Controller
{




    public function getUserById($id){
        if(Gate::allows("isOfficial")) {
            $user = User::findOrFail($id);
            return new UserResource($user);
        }
        else{
                return response()->json(["message" => "Unauthorized!"], 401);
            }
    }

    public function getUserAccountsByUser($c_id){
        if(Gate::allows("isOfficial")) {
            $users = User::where($c_id,"c_id")->get();
            if($users->isEmpty){
                return response()->json(["message" => "No user found"],404);
            }
            else{
                return UserResource::collection($users);
            }
        }
        else{
            return response()->json(["message" => "Unauthorized!"], 401);
        }
    }

}
