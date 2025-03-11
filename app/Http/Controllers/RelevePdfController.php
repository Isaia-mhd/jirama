<?php

namespace App\Http\Controllers;

use App\Models\Compteur;
use App\Models\EauReleve;
use App\Models\ElecReleve;
use App\Models\Releve;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

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

        $releve = Releve::create([
            "date_releve" => $EAU != null ? $EAU->date_releve : ($ELEC != null ? $ELEC->date_releve : null),
            "date_presentation" => $EAU != null ? $EAU->date_presentation : ($ELEC != null ? $ELEC->date_presentation : null),
            "date_limite" => $EAU != null ? $EAU->date_limite : ($ELEC != null ? $ELEC->date_limite : null),
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
                           (($ELEC->compteur->pu ?? 0) * ($ELEC->valeur ?? 0))
        ]);

      
        return view("Facture.pdf", compact("releve"));

    }

    // public function generePdf(){
    //     $pdf = Pdf::loadView("Facture.pdf");
    //     return $pdf;
    // }
}

