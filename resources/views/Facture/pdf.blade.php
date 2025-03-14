<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        h1{text-align: center;font-size: 30px;text-transform: uppercase;}
        .date_releve{text-align: center;text-transform: capitalize;margin-top: 20px;padding-bottom: 16px;}
        .info{width: 90%;display: flex;justify-content: space-around;}
        .details{text-align: center; text-transform: capitalize; padding-bottom: 10px;}
        .table{width: 500px;margin: auto;border: 1px gray;text-align: center;}
        .tabInfo{width: 100%; margin: auto;}
       
    </style>
</head>
<body>
    <div>

        <h1>jiro sy rano malagasy</h1>
        <p class="date_releve">votre facture du mois de : {{ \Carbon\Carbon::parse($releve->date_releve )->format("F") }} </p>
        <div class="info">
            <table class="tabInfo">
                <tr>
                   <th></th>
                   <th></th>
                </tr>
                <tr>
                    <td>
                        <div>
                            <p>Titulaire de compte: {{ $releve->titulaire }} </p>
                            <p>Reference Client: {{ $releve->ref_client }} </p>
                            <p>Adresse installation: {{ $releve->adresse }} </p>
                            <p>N° compteur Elec: {{ $releve->compteur_elec }} </p>
                            <p>N° compteur Eau: {{ $releve->compteur_eau }} </p>
                        </div>
                    </td>
                    <td>
                        <div>
                            <p style="position: relative; left: 150px;">Date de Presentation: {{ $releve->date_presentation }}</p>
                            <p style="padding-bottom: 110px; position: relative; left: 150px;">Date limite de paiement: {{ $releve->date_limite }} </p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div>
            <p class="details">Votre facture en Détail</p>

            <table border="2" class="table">
                <tr class="border">
                    <th class="border px-2"></th>
                    <th class="border px-2">Electricite</th>
                    <th class="border px-2">Eau</th>
                </tr>
                <tr class="border">
                    <td class="border px-2 text-left">PU (Ar)</td>
                    <td class="border px-2"> {{ $releve->pu_compteur_elec }} </td>
                    <td class="border px-2">{{ $releve->pu_compteur_eau }}</td>
                </tr>
                <tr class="border">
                    <td class="border px-2 text-left">Valeur</td>
                    <td class="border px-2">{{ $releve->valeur_releve_elec }}</td>
                    <td class="border px-2">{{ $releve->valeur_releve_eau }}</td>
                </tr>
                <tr class="border">
                    <td class="border px-2 text-left">Total (Ar)</td>
                    <td class="border px-2">{{ number_format($releve->total_elec, 0, ',', '.') }}</td>
                    <td class="border px-2">{{ number_format($releve->total_eau, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>
        <div >
            <p>NET A PAYER : {{ number_format($releve->net_payer, 0, ",", ".") }} Ariary</p>
        </div>
    </div>
</body>
</html>


  
    

