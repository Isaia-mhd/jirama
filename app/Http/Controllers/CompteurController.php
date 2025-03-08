<?php

namespace App\Http\Controllers;

use App\Models\Compteur;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CompteurController extends Controller
{
    public function listCompteur(User $client ){

        $types = Type::all();
        $eaux = Compteur::where("type", "Eau")->where("user_id", $client->id)->get();
        $electricites = Compteur::where("type", "Electricite")->where("user_id", $client->id)->get();
        return view("Compteur.list", compact("client", "types", "eaux", "electricites"));
    }

    public function newCompteur($client){
        $validated = request()->validate([
            "type" => "required|string",
            "pu" => "required|numeric"
        ]);

        $carbon = Carbon::now()->year.Carbon::now()->month.Carbon::now()->day.Carbon::now()->hour.Carbon::now()->minute.Carbon::now()->second;
        if($validated["type"] == "Eau"){
            $code_compteur = "E". $carbon;

        } else{
            $code_compteur = "C". $carbon;
        }


        Compteur::create([
            "code_compteur" => $code_compteur,
            "type" => $validated["type"],
            "pu" => $validated["pu"],
            "user_id" => $client
        ]);

        return redirect()->back()->with("success", "Nouveau Compteur Crée avec succès !");
    }

    public function destroy(Compteur $compteur){
        $compteur->delete();
        return redirect()->back()->with("success", "Compteur Supprimé avec succès !");
    }

    public function edit(Compteur $compteur)
    {
        return view("Compteur.edit", compact("compteur"));
    }
    // public function update(Compteur $compteur)
    // {
    //     $validated = request()->validate([
    //         "pu" => "required|integer"
    //     ]);

    //     $compteur->update([
    //         "pu" => $validated["pu"]
    //     ]);
    //     return redirect()->route("clients.compteurs")->with("success", "Compteur modifié avec succès !");
    // }
}
