<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MailClientController extends Controller
{
    // envoyer email le client qui n'a pas payé son facture
    public function sendMail()
    {
        // $status = "Non Payé";
       
        // $clients = User::whereHas("releve", function ($query) use ($status){
        //     $query->where("status", $status);
        // })->get();

        // $date = $clients->releve->date_limite;
        // dd($date);
    }
}
