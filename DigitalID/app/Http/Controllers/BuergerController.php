<?php

namespace App\Http\Controllers;

use App\Citizencard;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Citizen;
use App\Http\Resources\Citizen as CitizenResource;
use App\Http\Resources\Citizencard as CitizencardResource;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BuergerController extends Controller
{


    public function storeCitizen(Request $request)
    {
        if(Gate::allows("isOfficial")) {
            $buerger = $request->isMethod("put") ? Citizen::findOrFail($request->input("c_id")) : new Citizen();
            $validator = "";
            if ($request->isMethod("put")) {
                $validator = Validator::make($request->all(), [
                    "name" => "required | max: 50",
                    "lastname" => "required | max: 50",
                    "taxId" => "required | max: 50",
                    "hash" => "required",
                    "birthDate" => "required | date",
                    "birthPlace.pl_id" => "required| exists:places,pl_id",
                    "street" => "required | max: 50",
                    "houseNumber" => "required | max: 20",
                    "place.pl_id" => "required| exists:places,pl_id",
                    "martialStatus" => ["nullable", Rule::in(['ledig', 'verheiratet', 'verwitwet', 'geschieden', 'Ehe aufgehoben', 'eingetragene Lebenspartnerschaft',
                        'durch Tod aufgeloeste Lebenspartnerschaft', 'aufgehobene Lebenspartnerschaft'
                        , 'durch Todeserklaerung aufgeloeste Lebenspartnerschaft']),
                    ],
                    "occupation" => "nullable | max: 50",
                    "height" => "required | integer | max: 255 min: 1",
                    "hair" => "required| max: 30",
                    "eyes" => "required| max: 30",
                    "specialMarks" => "nullable| max: 150",
                    "state" => ["nullable",
                        Rule::in(['lebendig', 'verschwunden', 'gesucht', 'verstorben'])
                    ],
                    "gender" => "required | boolean"
                ]);
            } else {
                $validator = Validator::make($request->all(), [
                    "name" => "required | max: 50",
                    "lastname" => "required | max: 50",
                    "taxId" => "required | max: 50| unique:citizen",
                    "hash" => "required| unique:citizen",
                    "birthDate" => "required | date",
                    "birthPlace.pl_id" => "required| exists:places,pl_id",
                    "street" => "required | max: 50",
                    "houseNumber" => "required | max: 20",
                    "place.pl_id" => "required| exists:places,pl_id",
                    "maritalStatus" => ["nullable", Rule::in(['ledig', 'verheiratet', 'verwitwet', 'geschieden', 'Ehe aufgehoben', 'eingetragene Lebenspartnerschaft',
                        'durch Tod aufgeloeste Lebenspartnerschaft', 'aufgehobene Lebenspartnerschaft'
                        , 'durch Todeserklaerung aufgeloeste Lebenspartnerschaft']),
                    ],
                    "occupation" => "nullable | max: 50",
                    "height" => "required | integer | max: 255 min: 1",
                    "hair" => "required| max: 30",
                    "eyes" => "required| max: 30",
                    "specialMarks" => "nullable| max: 150",
                    "state" => ["nullable",
                        Rule::in(['lebendig', 'verschwunden', 'gesucht', 'verstorben'])
                    ],
                    "gender" => "required | boolean"
                ]);
            }
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            } else {
                $buerger->name = $request->input("name");
                $buerger->lastname = $request->input("lastname");
                $buerger->taxId = $request->input("taxId");
                $buerger->hash = $request->input("hash");
                $buerger->birthDate = $request->input("birthDate");
                $buerger->birthPlace = $request->input("birthPlace.pl_id");
                $buerger->street = $request->input("street");
                $buerger->houseNumber = $request->input("houseNumber");
                $buerger->place = $request->input("place.pl_id");
                $buerger->maritalStatus = $request->input("maritalStatus");
                $buerger->occupation = $request->input("occupation");
                $buerger->height = $request->input("height");
                $buerger->hair = $request->input("hair");
                $buerger->eyes = $request->input("eyes");
                $buerger->specialMarks = $request->input("specialMarks");
                $buerger->state = $request->input("state");
                $buerger->gender = $request->input("gender");
                if ($buerger->save()) {
                    return new CitizenResource($buerger);
                } else {
                    return respose()->json(["message" => "Fehler beim speichern!"], 400);
                }
            }
        }
        else{
            return response()->json(["message" => "Unauthorized!"], 401);
        }
    }

    /**
     * Display the specified resource by name.
     *
     * @param  string  $vornam
     * @param  string $nachname
     * @return
     */
    public function showWithName($name,$lastname)
    {
        if(Gate::allows("isUser")) {
            $buerger = Citizen::where([["name", "=", $name], ["lastname", "=", $lastname]])->get();
            if (!$buerger->isEmpty())
                return CitizenResource::collection($buerger);
            else
                return response()->json(["message" => "Citizen doesn't exist"], 404);
        }
        else{
            return response()->json(["message" => "Unauthorized!"], 401);
        }
    }

    /**
    * Display the specified resource by steuernummer
    *
    * @param  string  $vorname
    * @param  string $nachname
    */
    public function showWithSteuernummer($taxId)
    {
        if(Gate::allows("isUser")) {
            $buerger = Citizen::where("taxId", "=", $taxId)->first();
            if (!$buerger->isEmpty())
                return new CitizenResource($buerger);
            else
                return response()->json(["message" => "Citizen doesn't exist"], 404);

        }
        else{
            return response()->json(["message" => "Unauthorized!"], 401);
        }
    }

    public function showWithCard(Request $request)
    {
        if(Gate::allows("isUser")) {
            $hash = $request->input("hash");
            $kartenid = $request->input("cc_id");
            $buerger = Citizen::where("hash", "=", $hash)->first();
            if (!$buerger->isEmpty()) {
                $buergerkarte = $buerger->citizenCard()->first();
                if ($buergerkarte->isEmpty()) {
                    //TODO Search for nearest Admin and send him a mail about this case
                    return response()->json([
                        'message' => "Der Bürger besitzt keine Karte. Der Vorfall wird an den nächsten Mitarbeiter gemeldet"
                    ], 404);
                } else if ($kartenid == $buergerkarte->cc_id) {
                    if ($buergerkarte->bkablaufdatum < now())
                        return response()->json([
                            "message" => "Error : Card is expired"
                        ], 404);
                    else
                        return new CitizenResource($buerger);

                } else {
                    //TODO Search for nearest Admin and send him a mail about this case
                    return response()->json([
                        'message' => "Kartennummer und Hash stimmen nicht überein. Der Vorfall wird an den nächsten Mitarbeiter gemeldet"
                    ], 404);
                }
            } else {
                return response()->json([
                    'message' => "Keine Übereinstimmung gefunden"
                ], 404);
            }
        }
        else{
            return response()->json(["message" => "Unauthorized!"], 401);
        }
    }

    public function addCardtoBuerger(Request $request){
        if(Gate::allows("isOfficial")) {
            $buerger = Citizen::findOrFail($request->input("citizen"));
            $validator = Validator::make($request->all(),[
                "cc_id" => "required | unique:citizencards| max:7",
                "citizen.c_id" => "required | unique:citizencards"
            ]);

            if($validator->fails()){
                return response()->json(['errors'=>$validator->errors()]);
            }
            else{
                $buergerkarte = new Citizencard();
                $buergerkarte->cc_id = $request->input("cc_id");
                $buergerkarte->citizen = $request->input("citizen.c_id");
                $date = Carbon::now();
                $date->addYears(10);
                $buergerkarte->expirationDate = $date;
                if($buergerkarte->save()){
                    return new CitizencardResource($buergerkarte);
                }
                else{
                    return response()->json(["errors" => "Error while generating Card"]);
                }
            }
        }
        else{
            return response()->json(["message" => "Unauthorized!"], 401);
        }

    }

    public function removeCardFromBuerger($citizen){
            if(Gate::allows("isOfficial")) {
                $buerger = Citizen::findOrFail($citizen);
                $buergerkarten = $buerger->citizenCard();
                if (!$buergerkarten->isEmpty()) {
                    //$buergerkarte = $buergerkarten->first();
                    if ($buergerkarten->delete())
                        return "Card successfully deleted";
                    else {
                        return "error";
                    }

                } else {
                    return "Citizen doesn't have a card";
                }
            }
            else{
                return response()->json(["message" => "Unauthorized!"], 401);
            }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getImage($id){
        if(Gate::allows("isUser")) {
            $buerger = Citizen::findOrFail($id);
            return base64_encode($buerger->picture);
        }
        else{
            return response()->json(["message" => "Unauthorized!"], 401);
        }
    }
}
