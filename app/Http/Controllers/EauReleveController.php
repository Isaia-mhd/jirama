<?php

namespace App\Http\Controllers;

use App\Models\Compteur;
use App\Models\EauReleve;

class EauReleveController extends Controller
{
    public function listEauReleve()
    {
        $releves = EauReleve::orderBy("created_at", "DESC")->get();

        return view("EauReleve.list", compact("releves"));
    }
    public function addRelevePage($compteur)
    {
        $compteur = Compteur::where("code_compteur", $compteur)->first();

        return view("EauReleve.new", compact("compteur"));
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

        EauReleve::create([
            "compteur_id" => $compteur,
            "valeur" => $validated["valeur"],
            "date_releve" => $validated["date_releve"],
            "date_presentation" => $validated["date_presentation"],
            "date_limite" => $validated["date_limite"]
        ]);

        return redirect()->route("releve.list")->with("success", "Nouveau Releve Crée !");
    }

    public function destroy(EauReleve $eauReleve){
        $eauReleve->delete();
        return redirect()->back()->with("success", "Relevé Supprimé avec succès !");
    }

    // Updating Page
    public function edit($eauReleve)
    {
        $eauReleve = EauReleve::find($eauReleve);

        return view("EauReleve.edit", compact("eauReleve"));
    }

    public function update(EauReleve $eauReleve){
        $validated = request()->validate([
            "valeur" => "required",
            "date_releve" => "required|date",
            "date_presentation" => "required|date",
            "date_limite" => "required|date",
        ]);

        $eauReleve->update([
            "valeur" => $validated["valeur"],
            "date_releve" => $validated["date_releve"],
            "date_presentation" => $validated["date_presentation"],
            "date_limite" => $validated["date_limite"],
        ]);

        return redirect()->route("releve.list")->with("success", "Relevé Mis à Jour avec succès !");
    }
}
