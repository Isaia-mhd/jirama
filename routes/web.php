<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompteurController;
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
Route::get("/clients/compteurs/edit/{compteur}", [CompteurController::class, "edit"])->name("clients.compteurs.edit");
// Route::put("/clients/compteurs/edit/{compteur}", [CompteurController::class, "update"])->name("clients.compteurs.update");




