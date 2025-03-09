<?php

namespace App\Http\Controllers;

use App\Models\Niveau;
use App\Models\Quartier;
use App\Models\Sexe;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    // AFFICHAGE
    public function listClient()
    {
        $clients = User::orderBy("created_at", "DESC")->get();

        return view("Client.list", compact("clients"));
    }

    // AJOUT PAGE
    public function storeClientPage()
    {
        // get all quartier
        $quartiers = Quartier::all();

        // get sex
        $sexes = Sexe::all();

        // get all niveau
        $niveaux = Niveau::all();
        return view("Client.add", compact("quartiers", "sexes", "niveaux"));
    }

    // AJOUTER CLIENT
    public function storeClient()
    {
        $validated = request()->validate([
            "nom" => "required|string",
            "sexe" => "required",
            "quartier" => "required",
            "niveau" => "required",
            "email" => "required|email|unique:users"
        ]);


        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $day = Carbon::now()->day;
        $minute = Carbon::now()->minute;
        $sec = Carbon::now()->second;
        
        $ref = $year.$month.$day.$minute.$sec;

        User::create([
            "reference" => $ref,
            "nom" => $validated["nom"],
            "sexe" => $validated["sexe"],
            "quartier" => $validated["quartier"],
            "niveau" => $validated["niveau"],
            "email" => $validated["email"]
        ]); 

        return redirect()->route("clients")->with("success", "Nouveau Client Ajouté !");
    }

    // SUPPRIMER CLIENT
    public function destroy(User $client)
    {
        $client->delete();

        return redirect()->route("clients")->with("success", "Client Supprimé avec succès!");
    }


    // Updating Page
    public function updatePage($client)
    {
        $client = User::find($client);

        // get all quartier
        $quartiers = Quartier::all();

        // get sex
        $sexes = Sexe::all();

        // get all niveau
        $niveaux = Niveau::all();

        return view("Client.edit", compact("client", "quartiers", "sexes", "niveaux"));
    }

    // MODIFIER CLIENT
    public function update(User $client)
    {
        $validated = request()->validate([
            "nom" => "required|string",
            "sexe" => "required",
            "quartier" => "required",
            "niveau" => "required",
            "email" => "required|email"
        ]);

        $client->update([
            "nom" => $validated["nom"],
            "sexe" => $validated["sexe"],
            "quartier" => $validated["quartier"],
            "niveau" => $validated["niveau"],
            "email" => $validated["email"]
        ]);

        return redirect()->route("clients")->with("success", "Mis à jour avec succès !");
    }
}
