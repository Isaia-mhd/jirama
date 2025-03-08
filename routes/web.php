<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompteurController;
use App\Http\Controllers\EauReleveController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('Home');
})->name("home");


// CLIENT
Route::get("/clients", [ClientController::class, "listClient"])->name("clients");
Route::get("/clients/ajouter", [ClientController::class, "storeClientPage"])->name("clients.add");
Route::post("/clients/ajouter", [ClientController::class, "storeClient"])->name("clients.store");
Route::delete("/clients/delete/{client}", [ClientController::class, "destroy"])->name("clients.delete");
Route::get("/clients/edit/{client}", [ClientController::class, "updatePage"])->name("clients.edit");
Route::put("/clients/edit/{client}", [ClientController::class, "update"])->name("clients.update");


// COMPTEUR
Route::get("/clients/{client}/compteurs", [CompteurController::class, "listCompteur"])->name("clients.compteurs");
Route::post("/clients/{client}/compteurs/new", [CompteurController::class, "newCompteur"])->name("clients.compteurs.new");
Route::delete("/clients/compteurs/delete/{compteur}", [CompteurController::class, "destroy"])->name("clients.compteurs.delete");
Route::put("/clients/compteurs/edit/{compteur}", [CompteurController::class, "update"])->name("clients.compteurs.update");



// RELEVE EAU
Route::get("/releves", [EauReleveController::class, "listEauReleve"])->name("releve.list");
Route::get("/clients/compteurs/{compteur}/releve/new", [EauReleveController::class, "addRelevePage"])->name("releve.new");
Route::post("/clients/compteurs/{compteur}/releve/new", [EauReleveController::class, "newReleve"])->name("releve.new.store");
Route::delete("/releve/{eauReleve}", [EauReleveController::class, "destroy"])->name("releve.delete");
Route::get("/releve/{eauReleve}/update", [EauReleveController::class, "edit"])->name("releve.edit");
Route::put("/releve/{eauReleve}/update", [EauReleveController::class, "update"])->name("releve.update");




