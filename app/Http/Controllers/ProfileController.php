<?php

namespace App\Http\Controllers;

use App\Models\Compteur;
use App\Models\EauReleve;
use App\Models\ElecReleve;
use App\Models\Payer;
use App\Models\Releve;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Promise\Create;
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

        // dump($releve);
        $releve->update([
            "status" => "Payé"
        ]);


        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $day = Carbon::now()->day;
        $minute = Carbon::now()->minute;
        $sec = Carbon::now()->second;

        $ref = $minute.$sec.$year.$month.$day;

        Payer::create([
            "ref" => $ref,
            "client" => $releve->titulaire,
            "date_payment" => now(),
            "montant" => $releve->net_payer,

        ]);

        return redirect()->route("paiement")->with("success", "Relevé Payé avec succès !");
    }

}
