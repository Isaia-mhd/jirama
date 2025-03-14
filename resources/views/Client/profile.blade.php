@extends("layout.layout")
@section("title")
    Profile
@endsection


@section("content")
    <section class="w-full max-w-[90%] mx-auto">
        <h1 class="text-white text-2xl text-center">Profile</h1>

        <div class="w-full flex justify-between mt-6 mb-6">
            {{-- client info --}}
            <div class="text-white">
                <h2 class="text-slate-500">Informations</h2>
                <div class="mb-4">
                    <hr class="text-white  ">
                </div>
                <p>Client:  {{ $client->nom }}</p>
                <p>E-mail:  {{ $client->email }}</p>
                <p>Ref: {{ $client->reference }}</p>
                <p>Adresse: {{ $client->quartier }}</p>
                <p>Niveau: {{ $client->niveau }}</p>
            </div>


            {{-- compteur info --}}
            <div class="text-white">
                <h2 class="text-slate-500">Compteur</h2>
                <div class="mb-4">
                    <hr class="text-white  ">
                </div>

                <p>N° Compteur d'eau: {{ $compteurEau->code_compteur ?? "" }}</p>
                <p>N° Compteur d'elec: {{ $compteurElec->code_compteur ?? ""}}</p>

                <div class="mt-6">
                    <td class="border py-2 border-y-4 border-x-0  border-y-slate-900"><a href="{{ route("clients.compteurs", $client->id) }}" class="w-full block bg-blue-600 hover:bg-blue-800 transition duration-200 py-1 px-2 rounded-sm text-white text-center">Voir plus</a></td>
                </div>
            </div>
        
            {{-- Historique de relevé --}}
            <div class="text-white">
                <p class="text-slate-500">Historiqu de relevé:</p>
                <div class="mb-4">
                    <hr class="text-white  ">
                </div>

                <div class="mb-6">
                    @foreach ($releves as $releve)
                        <p class="text-white">{{ number_format($releve->net_payer, 0, ",", ".") }} Ariary</p>
                    @endforeach
                </div>

                {{-- PAYER BTN --}}
                <a href="{{ route("releve.payer", $client->id) }}" class="bg-slate-800 py-1 px-2 rounded-sm text-white"><i class="fa-solid fa-download text-green-700"></i> Paiement De relevé</a>
          
            </div>
        </div>

        {{-- Relevé --}}
        <form action="{{ route("releve.pdf", $client->id) }}" method="post" class="flex gap-2">
            @csrf
            <input type="date" name="date_rel">
            <button type="submit" class="text-white py-1 px-3 bg-green-600">Telecharger Relevé</button>
        </form>
        {{-- <a href="{{ route("releve.pdf", $client->id) }}" class="bg-slate-800 py-1 px-2 rounded-sm text-white"><i class="fa-solid fa-download text-green-700"></i> Telecharger Relevé</a> --}}
                            
    </section>
@endsection