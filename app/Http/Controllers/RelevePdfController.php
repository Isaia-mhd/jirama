<?php

namespace App\Http\Controllers;

use App\Models\Compteur;
use App\Models\EauReleve;
use App\Models\ElecReleve;
use App\Models\Releve;
use App\Models\User;
use Barryvdh\DomPDF\Facade\PDF;

class RelevePdfController extends Controller
{
    public function showPdf($client)
    {
        // date de relevé donné
        $date_releve = request()->get("date_rel");

        $client = User::find($client);

        // eau_relevé de ce date donné si existe
        $EAU = EauReleve::whereHas('compteur', function ($query) use ($client, $date_releve) {
            $query->where('user_id', $client->id)->where("date_releve", $date_releve);
        })->first();

        // elec_relevé de ce date donné si existe
        $ELEC = ElecReleve::whereHas('compteur', function ($query) use ($client, $date_releve) {
            $query->where('user_id', $client->id)->where("date_releve", $date_releve);
        })->first();

        // releve de ce date donné si existe deja
        $releve = Releve::where("date_releve", $date_releve)->where("user_id", $client->id)->first();

        // Telechager le relevé si deja existe
        if($releve != null){
            
            return view("Facture.pdf", compact("releve"));

        } else{
           
            // Si la date de relevé donné n'existe pas, Creer le d'abord
            if($EAU == null && $ELEC == null ){
                
                return redirect()->back()->with("success", "Créer Le Relevé De Ce Mois d'Abord");

            } else{
                
                $releve = Releve::create([
                    "date_releve" => $date_releve,
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

                return view("Facture.pdf", compact("releve"));
                
            }

        }

    }

    

}