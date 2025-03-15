@extends('layout.layout')
@section('title')
    Clients
@endsection
@section('content')
    <div class="w-full max-w-[90%]  mx-auto">

        <div class="w-full">
            <h1 class="text-center text-white text-2xl font-semibold mb-6">Historique de Relevé  </h1>
        </div>

        <div class="w-full flex justify-end mb-6">
            <a href="{{ route('clients.add') }}" class="bg-blue-500 py-1 px-2 text-white rounded-sm">Ajouter Nouveau</a>
        </div>
        <div class="text-white">
            <p>
                @include('notify.success')
            </p>
            <table class="w-full  rounded-tr-xl rounded-tl-xl table-auto border-collapse">
                <thead>
                    <tr class="text-sm text-gray-500 ">
                        <th>Date de Releve</th>
                        <th>Date de Presentation</th>
                        <th>Date Limite</th>
                        <th>Compteur Eau</th>
                        <th>Total Eau</th>
                        <th>Compteur Elec</th>
                        <th>Total Elec</th>
                        <th>Net à Payer</th>
                        <th>Status</th>
                        <th>Paiement</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($releves as $releve)
                        <tr class="text-center text-sm shadow-lg">
                            <td class="border py-2 border-y-4 border-x-0  border-y-slate-900"> {{ $releve->date_releve }} ({{ \Carbon\Carbon::parse($releve->date_releve )->format("F") }})
                            </td>
                            <td class="border py-2 border-y-4 border-x-0  border-y-slate-900"> {{ $releve->date_presentation }} </td>
                            <td class="border py-2 border-y-4 border-x-0  border-y-slate-900">{{ $releve->date_limite }}</td>
                            <td class="border py-2 border-y-4 border-x-0  border-y-slate-900">{{ $releve->compteur_eau }}</td>
                            <td class="border py-2 border-y-4 border-x-0  border-y-slate-900">{{ $releve->total_eau }}</td>
                            <td class="border py-2 border-y-4 border-x-0  border-y-slate-900">{{ $releve->compteur_elec }}</td>
                            <td class="border py-2 border-y-4 border-x-0  border-y-slate-900">{{ $releve->total_elec }}</td>
                            <td class="border py-2 border-y-4 border-x-0  border-y-slate-900">{{ $releve->net_payer }}</td>


                            {{-- status --}}
                            <td class="{{ $releve->status == "Payé" ? "border py-2 border-y-4 border-x-0  border-y-slate-900 text-green-600": "text-red-600" }}">
                                {{ $releve->status }}
                            </td>

                            {{-- paiement btn --}}
                            <td class="border py-2 border-y-4 border-x-0  border-y-slate-800">
                                @if ($releve->status == "Payé")
                                    <button class="bg-slate-800 py-1 px-4 text-slate-500" disabled>Payer</button>
                                @else
                                    <a href="{{ route('releve.paiement', $releve->id) }}" class="bg-green-700 py-1 px-4 rounded-md"><i
                                    class="fa-solid fa-state text-green-500 text-md"></i>Payer</a>
                                @endif
                                
                            </td>
                           

                        </tr>
                    @endforeach

                </tbody>
            </table>
            @if (count($releves) == 0)
                    <p class="text-gray-400 text-center mt-6">Aucun Releve</p>
            @endif
            {{-- <div class="w-full max-w-[90%] mx-auto mt-3">{{ $baskets->links('pagination::tailwind') }}</div> --}}


        </div>

          {{-- Relevé --}}
          <form action="{{ route("releve.pdf", $client->id) }}" method="post" class="flex gap-2 mt-6">
            @csrf
            <input type="date" name="date_rel" value="{{ request()->get("date_rel", "") }}">
            <button type="submit" class="text-white py-1 px-3 bg-green-600">Telecharger Relevé</button>
        </form>


    </div>
@endsection
