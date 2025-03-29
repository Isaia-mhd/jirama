@extends('layout.layout')
@section('title')
    Clients
@endsection
@section('content')
    <div class="w-full max-w-[90%]  mx-auto">

        <div class="w-full">
            <h1 class="text-center text-white text-2xl font-semibold mb-6">Liste des clients Qui n'ont pas payé </h1>
        </div>


        <div class="text-white">
            {{-- notification --}}
            <p>
                @include('notify.success')
            </p>

            {{-- filter by date --}}
            <div class="">
                <form action="{{ route("list.client.nonpaye.byDate") }}" method="post" id="myForm">
                    @csrf
                    <input type="date" name="dateLimite" class="w-[170px] rounded-md py-1 px-3 bg-slate-800 text-white">
                    <button type="submit" class="bg-blue-500 text-white py-1 px-4">Filtrer</button>
                </form>
            </div>
            <table class="w-full  rounded-tr-xl rounded-tl-xl table-auto border-collapse">
                <thead>
                    <tr class="text-sm text-gray-500 ">
                        <th>Ref</th>
                        <th>Nom</th>
                        <th>Sex</th>
                        <th>Quartier</th>
                        <th>Niveau</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                        <tr class="text-center text-sm shadow-lg">
                            <td class="border py-2 border-y-4 border-x-0  border-y-slate-900"> {{ $client->reference }}
                            </td>
                            <td class="border py-2 border-y-4 border-x-0  border-y-slate-900"><a href="{{ route("client.profile", $client->id) }}" class="text-blue-500 underline">{{ $client->nom }}</a></td>
                            <td class="border py-2 border-y-4 border-x-0  border-y-slate-900">{{ $client->sexe }}</td>
                            <td class="border py-2 border-y-4 border-x-0  border-y-slate-900">{{ $client->quartier }}</td>
                            <td class="border py-2 border-y-4 border-x-0  border-y-slate-900">{{ $client->niveau }}</td>
                            <td class="border py-2 border-y-4 border-x-0  border-y-slate-900">{{ $client->email }}</td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
            @if (count($clients) == 0)
                    <p class="text-gray-400 text-center mt-6">Aucun Client</p>
            @endif
            {{-- <div class="w-full max-w-[90%] mx-auto mt-3">{{ $baskets->links('pagination::tailwind') }}</div> --}}


        </div>

    </div>
@endsection
