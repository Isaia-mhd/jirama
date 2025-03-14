<?php

namespace App\Http\Controllers;

use App\Models\Compteur;
use App\Models\EauReleve;
use App\Models\ElecReleve;
use App\Models\Releve;
use App\Models\User;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Carbon;

class RelevePdfController extends Controller
{
    public function showPdf($client)
    {
        $EAU = EauReleve::whereHas('compteur', function ($query) use ($client) {
            $query->where('user_id', $client);
        })->latest()->first();

        $ELEC = ElecReleve::whereHas('compteur', function ($query) use ($client) {
            $query->where('user_id', $client);
        })->latest()->first();

        $client = User::find($client);

        $dateReleve =  $EAU != null ? $EAU->date_releve : ($ELEC != null ? $ELEC->date_releve : null);
        $date = request()->get("date_rel");

        $time = strtotime($date);

        $year = date("Y", $time);
        $month = date("m", $time);

        $dateRel = $year . "-" . $month;

        // dump($dateRel);

        
        

        //  2025-03-25

        $releve_existe = Releve::all();
        foreach ($releve_existe as $existe) {
            $date_existe = $existe->date_releve;
            // dump($date_existe);

            $time_existe = strtotime($date_existe);
            $year_existe = date("Y", $time_existe);
            $month_existe = date("m", $time_existe);

            $real_date_existe = $year_existe . "-" . $month_existe;
            // dump($real_date_existe);
            if($real_date_existe == $dateRel && $existe->user_id == $client->id ){
             

                $releves = Releve::where("date_releve", $existe->date_releve)->where("user_id", $client->id)->get();


                foreach ($releves as $releve) {
                    $pdf = PDF::loadView("Facture.pdf", compact("releve"));
                    return $pdf->download(str_replace(" ", "_", $releve->titulaire) . "_releve_" . $releve->date_releve);
                }
            }
        }

        $releve = Releve::create([
            "date_releve" => $dateReleve,
            "date_presentation" => $EAU != null ? $EAU->date_presentation : ($ELEC != null ? $ELEC->date_presentation : null),
            "date_limite" => $EAU != null ? $EAU->date_limite : ($ELEC != null ? $ELEC->date_limite : null),
            "user_id" => $client->id,
            "titulaire" => $client->nom,
            "ref_client" => $client->reference,
            "adresse" => $client->quartier,
            "compteur_eau" => $EAU->compteur->code_compteur ?? "",
            "pu_compteur_eau" => $EAU->compteur->pu ?? 0,
            "valeur_releve_eau" => $EAU->valeur ?? 0,
            "total_eau" => ($EAU->compteur->pu ?? 0) * ($EAU->valeur ?? 0),
            "compteur_elec" => $ELEC->compteur->code_compteur ?? "",
            "pu_compteur_elec" => $ELEC->compteur->pu ?? 0,
            "valeur_releve_elec" => $ELEC->valeur ?? 0,
            "total_elec" => ($ELEC->compteur->pu ?? 0) * ($ELEC->valeur ?? 0),
            "net_payer" => (($EAU->compteur->pu ?? 0) * ($EAU->valeur ?? 0)) +
                           (($ELEC->compteur->pu ?? 0) * ($ELEC->valeur ?? 0)),
                           "email_sent" => false
        ]);

        $pdf = PDF::loadView("Facture.pdf", compact("releve"));

        // return view("Facture.pdf", compact("releve"));
        return $pdf->download(str_replace(" ", "_", $releve->titulaire) . "_releve_" . $releve->date_releve);

    }

    

}