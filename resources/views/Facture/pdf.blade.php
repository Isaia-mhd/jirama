@extends("layout.layout")
@section("title")
    Facture PDF
@endsection

@section("content")

    <div class="text-white w-full max-w-[70%] mx-auto pb-[70px]">

    <div class="text-white w-full max-w-[70%] mx-auto">

        <h1 class="text-center text-3xl uppercase">jiro sy rano malagasy</h1>
        <p class="text-center capitalize mt-4 pb-8">votre facture du mois de : {{ \Carbon\Carbon::parse($releve->date_releve )->format("F") }} </p>
        <div class="w-full flex justify-between">
            <div class="">
                <p>Tituleaire de compte: {{ $releve->titulaire }} </p>
                <p>Reference Client: {{ $releve->ref_client }} </p>
                <p>Adresse installation: {{ $releve->adresse }} </p>
                <p>N° compteur Elec: {{ $releve->compteur_elec }} </p>
                <p>N° compteur Eau: {{ $releve->compteur_eau }} </p>
            </div>
            <div class="">
                <p>Date de Presentation: {{ $releve->date_presentation }}</p>
                <p>Date limite de paiement: {{ $releve->date_limite }} </p>
            </div>
        </div>
        <div class="">
            <p class="text-center capitalize mt-4 pb-4">Votre facture en détail</p>

            <table border="2" class="w-[500px] mx-auto border text-center">
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
        <div class="mt-4">
            <p class="">NET A PAYER : {{ number_format($releve->net_payer) }} Ariary</p>
        </div>
    </div>
@endsection
