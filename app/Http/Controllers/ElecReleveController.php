<?php

namespace App\Http\Controllers;

use App\Models\Compteur;
use App\Models\ElecReleve;

class ElecReleveController extends Controller
{
    public function listElecReleve()
    {
        $releves = ElecReleve::orderBy("created_at", "DESC")->get();
        return view("ElecReleve.list", compact("releves"));
    }

    public function addRelevePage($compteur)
    {
        $compteur = Compteur::where("code_compteur", $compteur)->first();

        return view("ElecReleve.new", compact("compteur"));
    }

    public function newReleve($compteur)
    {
        $validated = request()->validate([
            "valeur" => "required|integer",
            "date_releve" => "required|date",
            "date_presentation" => "required|date",
            "date_limite" => "required|date",
        ]);

        // $compteurPU = Compteur::where("id", $compteur)->firstOrFail();

        ElecReleve::create([
            "compteur_id" => $compteur,
            "valeur" => $validated["valeur"],
            "date_releve" => $validated["date_releve"],
            "date_presentation" => $validated["date_presentation"],
            "date_limite" => $validated["date_limite"]
        ]);

        return redirect()->route("relevelec.list")->with("success", "Nouveau Relevé Crée !");
    } 

    public function destroy(ElecReleve $elecReleve){
        $elecReleve->delete();
        return redirect()->back()->with("success", "Relevé Supprimé avec succès !");
    }

      // Updating Page
      public function edit($elecReleve)
      {
          $elecReleve = ElecReleve::find($elecReleve);
  
          return view("ElecReleve.edit", compact("elecReleve"));
      }

      public function update(ElecReleve $elecReleve){
        $validated = request()->validate([
            "valeur" => "required",
            "date_releve" => "required|date",
            "date_presentation" => "required|date",
            "date_limite" => "required|date",
        ]);

        $elecReleve->update([
            "valeur" => $validated["valeur"],
            "date_releve" => $validated["date_releve"],
            "date_presentation" => $validated["date_presentation"],
            "date_limite" => $validated["date_limite"],
        ]);

        return redirect()->route("relevelec.list")->with("success", "Relevé Mis à Jour avec succès !");
    }
}
