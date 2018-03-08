<?php

namespace App\Http\Controllers;

use App\Buergerkarten;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Buerger;
use App\Http\Resources\Buerger as BuergerResource;
use App\Http\Resources\Buergerkarten as BuergerkartenResource;
use Illuminate\Support\Facades\Validator;

class BuergerController extends Controller
{


    public function addNewBuerger(Request $request)
    {

    }

   public function updateBuerger(Request $request){

   }

    /**
     * Display the specified resource by name.
     *
     * @param  string  $vornam
     * @param  string $nachname
     * @return
     */
    public function showWithName($vorname,$nachname)
    {
        $buerger = Buerger::where([["bvorname","=",$vorname],["bnachname","=",$nachname]])->get();
        if(!empty($buerger))
            return BuergerResource::collection($buerger);
        else
            return "Buerger doesn't exist";
    }

    /**
    * Display the specified resource by steuernummer
    *
    * @param  string  $vorname
    * @param  string $nachname
    * @return \Illuminate\Http\Response
    */
    public function showWithSteuernummer($steuernummmer)
    {
        $buerger = Buerger::where("bsteuernummer","=",$steuernummmer)->first();
        if(!empty($buerger))
            return new BuergerResource($buerger);
        else
            return "Buerger doesn't exist";
    }

    public function showWithCard(Request $request)
    {
        $hash = $request->input("hash");
        $kartenid = $request->input("kartenid");
        $buerger = Buerger::where("bhash", "=", $hash)->first();
        if (!empty($buerger)) {
            $buergerkarte = $buerger->buergerkarte()->first();
            if (empty($buergerkarte)) {
                //TODO Search for nearest Admin and send him a mail about this case
                return "Der Bürger besitzt keine Karte. Der Vorfall wird an den nächsten Mitarbeiter gemeldet";
            }
            else if ($kartenid == $buergerkarte->bkkartennummer){
                if($buergerkarte->bkablaufdatum < now())
                    return "Error : Card is expired";
                else
                    return new BuergerResource($buerger);

            }
        }
        else{
            return "Keine Übereinstimmung gefunden";
        }
    }

    public function addCardtoBuerger(Request $request){
            $buerger = Buerger::findOrFail($request->input("bnummer"));
            $validator = Validator::make($request->all(),[
                "bkkartennummer" => "required | unique:buergerkartens| max:7",
                "bnummer" => "required | unique:buergerkartens"
            ]);

            if($validator->fails()){
                return response()->json(['errors'=>$validator->errors()]);
            }
            else{
                $buergerkarte = new Buergerkarten();
                $buergerkarte->bkkartennummer = $request->input("bkkartennummer");
                $buergerkarte->bnummer = $request->input("bnummer");
                $date = Carbon::now();
                $date->addYears(10);
                $buergerkarte->bkablaufdatum = $date;
                if($buergerkarte->save()){
                    return new BuergerkartenResource($buergerkarte);
                }
                else{
                    return "Error while generating Card";
                }
            }

    }

    public function removeCardFromBuerger($bnummer){

            $buerger = Buerger::findOrFail($bnummer);
            $buergerkarten = $buerger->buergerkarte;
            if(!empty($buergerkarten)){
                $buergerkarte = $buergerkarten->first();
                $buergerkarte->delete();
                return "deleted successfully";
            }
            else{
                return "Buerger doesn't have a card";
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
}
