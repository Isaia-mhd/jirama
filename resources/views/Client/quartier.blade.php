@extends('layout.layout')
@section('title')
    Clients
@endsection
@section('content')
    <div class="w-full max-w-[90%]  mx-auto">

        <div class="w-full">
            <h1 class="text-center text-white text-2xl font-semibold mb-6">Liste de client à {{ request()->get("catQuartier") }}</h1>
        </div>

        <div class="w-full flex justify-end mb-6 gap-3">
            <a href="{{ route('clients.add') }}" class="bg-blue-500 py-1 px-2 text-white rounded-sm">Ajouter Nouveau</a>
            <a href="{{ route('list.client.nonpaye') }}" class="bg-red-500 py-1 px-2 text-white rounded-sm">Les Relevés Non Payé</a>
        </div>
        <div class="text-white">
            <p>
                @include('notify.success')
            </p>
            <table class="w-full  rounded-tr-xl rounded-tl-xl table-auto border-collapse">
                <thead>
                    <tr class="text-sm text-gray-500 ">
                        <th>Ref</th>
                        <th>Nom</th>
                        <th>Sex</th>
                        <th>Quartier</th>
                        <th>Niveau</th>
                        <th>Email</th>
                        <th>Editing</th>
                        <th>Deleting</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                        <tr class="text-center text-sm shadow-lg">
                            <td class="border py-2 border-y-4 border-x-0  border-y-slate-900"> {{ $client->reference }}
                            </td>
                            <td class="border py-2 border-y-4 border-x-0  border-y-slate-900"><a href="{{ route("client.profile", $client->id) }}">{{ $client->nom }}</a></td>
                            <td class="border py-2 border-y-4 border-x-0  border-y-slate-900">{{ $client->sexe }}</td>
                            <td class="border py-2 border-y-4 border-x-0  border-y-slate-900">{{ $client->quartier }}</td>
                            <td class="border py-2 border-y-4 border-x-0  border-y-slate-900">{{ $client->niveau }}</td>
                            <td class="border py-2 border-y-4 border-x-0  border-y-slate-900">{{ $client->email }}</td>

                            {{-- editing --}}
                            <td class="border py-2 border-y-4 border-x-0  border-y-slate-900">
                                <a href="{{ route('clients.edit', $client->id) }}"><i
                                        class="fa-solid fa-pen text-green-500 text-md"></i></a>
                            </td>
                            {{-- deleting --}}
                            <td class="border py-2 border-y-4 border-x-0  border-y-slate-900">
                                <form action="{{ route('clients.delete', $client->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"
                                        class=" py-1 px-3 rounded text-sm text-white transition duration-150 ease-in-out">
                                        <i class="fa-solid fa-trash text-red-500 text-md"></i></button>
                                </form>
                            </td>

                           

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
