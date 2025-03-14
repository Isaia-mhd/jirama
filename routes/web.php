<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompteurController;
use App\Http\Controllers\EauReleveController;
use App\Http\Controllers\ElecReleveController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RelevePdfController;
use App\Mail\SendMail;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    $status = "Non Payé";
    $mail_sent = false;
    $clients = User::whereHas("releve", function ($query) use ($status, $mail_sent){
        $query->where("status", $status)->where("email_sent", $mail_sent);
    })->get();

    foreach ($clients as $client) {
        foreach ($client->releve as $releve) {
            // dump($releve->date_limite);
            // dump($client->email);

            if($releve->date_limite == date("Y-m-d")){
                Mail::to($client->email)->send(new SendMail($client));
                $releve->update([
                    "email_sent" => true
                ]);
            }
        }
    }

    return view('Home');
})->name("home");


// CLIENT
Route::get("/clients", [ClientController::class, "listClient"])->name("clients");
Route::get("/clients/ajouter", [ClientController::class, "storeClientPage"])->name("clients.add");
Route::post("/clients/ajouter", [ClientController::class, "storeClient"])->name("clients.store");
Route::delete("/clients/delete/{client}", [ClientController::class, "destroy"])->name("clients.delete");
Route::get("/clients/edit/{client}", [ClientController::class, "updatePage"])->name("clients.edit");
Route::put("/clients/edit/{client}", [ClientController::class, "update"])->name("clients.update");
// rechercher client
Route::post("/client/search", [ClientController::class, "search"])->name("client.search");
Route::post("/client/search/quartier", [ClientController::class, "quartier"])->name("client.quartier");

// list qui n'ont pas payé
Route::get("/clients/releve/non-payer", [ClientController::class, "listNonPaye"])->name("list.client.nonpaye");
Route::post("/clients/releve/by-date-limite/non-payer", [ClientController::class, "listNonPayeByDate"])->name("list.client.nonpaye.byDate");


// Profil
Route::get("/client/{client}/profile", [ProfileController::class, "profile"])->name("client.profile");
Route::get("/client/releve/{client}/payer", [ProfileController::class, "payement"])->name("releve.payer");
Route::get("/client/releve/payer/{releve}", [ProfileController::class, "payer"])->name("releve.paiement");




// COMPTEUR
Route::get("/clients/{client}/compteurs", [CompteurController::class, "listCompteur"])->name("clients.compteurs");
Route::post("/clients/{client}/compteurs/new", [CompteurController::class, "newCompteur"])->name("clients.compteurs.new");
Route::delete("/clients/compteurs/delete/{compteur}", [CompteurController::class, "destroy"])->name("clients.compteurs.delete");
Route::put("/clients/compteurs/edit/{compteur}", [CompteurController::class, "update"])->name("clients.compteurs.update");



// RELEVE EAU
Route::get("/releves-eau", [EauReleveController::class, "listEauReleve"])->name("releve.list");
Route::get("/clients/compteurs/{compteur}/releve/new", [EauReleveController::class, "addRelevePage"])->name("releve.new");
Route::post("/clients/compteurs-eau/{compteur}/releve/new", [EauReleveController::class, "newReleve"])->name("releve.new.store");
Route::delete("/releve-eau/{eauReleve}", [EauReleveController::class, "destroy"])->name("releve.delete");
Route::get("/releve-eau/{eauReleve}/update", [EauReleveController::class, "edit"])->name("releve.edit");
Route::put("/releve-eau/{eauReleve}/update", [EauReleveController::class, "update"])->name("releve.update");


// RALEVE ELEC
Route::get("/relevelec", [ElecReleveController::class, "listElecReleve"])->name("relevelec.list");
Route::get("/clients/compteurs-elec/{compteur}/releve/new", [ElecReleveController::class, "addRelevePage"])->name("relevelec.new");
Route::post("/clients/compteurs-elec/{compteur}/releve/new", [ElecReleveController::class, "newReleve"])->name("relevelec.new.store");
Route::delete("/releve-electricite/{elecReleve}", [ElecReleveController::class, "destroy"])->name("relevelec.delete");
Route::get("/releve-electricite/{elecReleve}/update", [ElecReleveController::class, "edit"])->name("relevelec.edit");
Route::put("/releve-electricite/{elecReleve}/update", [ElecReleveController::class, "update"])->name("relevelec.update");

// GENERER PDF DE RELEVE
Route::post("clients/{client}/releves/pdf", [RelevePdfController::class, "showPdf"])->name("releve.pdf");


