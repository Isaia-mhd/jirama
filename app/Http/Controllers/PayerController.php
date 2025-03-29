<?php

namespace App\Http\Controllers;

use App\Models\Payer;
use App\Models\User;
use Illuminate\Http\Request;

class PayerController extends Controller
{
    public function listPaid()
    {
        $paiements = Payer::all();

        return view("Payer.list", compact("paiements",));
    }

    public function destroy(Payer $payment)
    {
        $payment->delete();
        return redirect()->route("paiement")->with("success", "Supprimé avec succès!");
    }
}
