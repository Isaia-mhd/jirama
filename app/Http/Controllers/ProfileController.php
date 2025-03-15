<?php

namespace App\Http\Controllers;

use App\Models\Compteur;
use App\Models\EauReleve;
use App\Models\ElecReleve;
use App\Models\Releve;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile(USer $client){
        $compteurEau = Compteur::where("user_id", $client->id)
        ->where("type", "Eau")
        ->first();

        $compteurElec = Compteur::where("user_id", $client->id)
        ->where("type", "Electricite")
        ->first();


        $releves = Releve::where("ref_client", $client->reference)->orderBy("created_at", "DESC")->paginate(3);
        return view("Client.profile", compact("client", "compteurEau", "compteurElec", "releves"));
    }

    public function payement(User $client){

        $releves = Releve::orderBy("created_at", "DESC")->where("ref_client", $client->reference)->paginate("10");
        return view("Releve.payment", compact("releves", "client"));
    }

    public function payer(Releve $releve){
        $releve->update([
            "status" => "Payé"
        ]);

        return redirect()->back()->with("success", "Relevé Payé avec succès !");
    }

}
