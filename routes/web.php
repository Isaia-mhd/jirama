<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('Home');
})->name("home");

Route::get("/clients", [ClientController::class, "listClient"])->name("clients");
Route::get("/clients/ajouter", [ClientController::class, "storeClientPage"])->name("clients.add");
Route::post("/clients/ajouter", [ClientController::class, "storeClient"])->name("clients.store");
Route::delete("/clients/delete/{client}", [ClientController::class, "destroy"])->name("clients.delete");
Route::get("/clients/edit/{client}", [ClientController::class, "updatePage"])->name("clients.edit");
Route::put("/clients/edit/{client}", [ClientController::class, "update"])->name("clients.update");




