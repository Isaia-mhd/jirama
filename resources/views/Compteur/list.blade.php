@extends('layout.layout')
@section('title')
    Compteur {{ $client->nom }}
@endsection
@section('content')
    <div class="w-full max-w-[90%]  mx-auto">

        <div class="w-full">
            <h1 class="text-center text-white text-2xl font-semibold mb-6">Compteurs de client</h1>
            <p class="text-white text-md">Client Ref: {{ $client->reference }} </p>
            <p class="text-white text-md">Nom du Client: {{ $client->sexe == 'Homme' ? 'Mr' : 'Mme' }} <span class="uppercase">{{ $client->nom }}</span>
            </p>
            <p class="text-white text-md">Quartier: {{ $client->quartier }} </p>
        </div>


        <div class="text-white">
            <div class="w-full flex justify-end">
                {{-- Relevé --}}
                {{-- <a href="" class="bg-slate-800 px-4 py-1 rounded-sm text-white"><i class="fa-solid fa-download text-green-700"></i> Releve PDF</a> --}}

            </div>
            <p>
                @include('notify.success')
            </p>

            {{-- COMPTEUR D'ELECTRICITE --}}
            <div class="w-full mt-12 mb-12">
                <p class="text-blue-200 uppercase font-bold text-center mb-4">Compteurs d'Electricite</p>
                <table class="w-full  rounded-tr-xl rounded-tl-xl table-auto border-collapse">
                    <thead>
                        <tr class="text-sm text-gray-500 ">
                            <th>N° Compteur</th>
                            <th>PU</th>
                            <th>Date de creation</th>
                            <th>Suppression</th>
                            <th>Releve</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($electricites as $elec)
                            <tr class="text-center text-sm shadow-lg">
                                <td class="border py-2 border-y-4 border-x-0  border-y-slate-900">
                                    {{ $elec->code_compteur }}
                                </td>

                                <td class="border py-2 border-y-4 border-x-0  border-y-slate-900">
                                    <form action="{{ route('clients.compteurs.update', $elec->id) }}" method="post"
                                        class="flex justify-center items-center gap-4">
                                        @csrf
                                        @method('put')
                                        <input type="number" name="pu" value="{{ $elec->pu }}"
                                            class="bg-slate-900 w-[100px]">
                                        <button type="submit"><i
                                                class="fa-solid fa-save text-green-500 text-md"></i></button>
                                    </form>
                                </td>

                                <td class="border py-2 border-y-4 border-x-0  border-y-slate-900"> {{ $elec->created_at }}
                                </td>


                                {{-- deleting --}}
                                <td class="border py-2 border-y-4 border-x-0  border-y-slate-900">
                                    <form action="{{ route('clients.compteurs.delete', $elec->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"
                                            class=" py-1 px-3 rounded text-sm text-white transition duration-150 ease-in-out">
                                            <i class="fa-solid fa-trash text-red-500 text-md"></i></button>
                                    </form>
                                </td>

                                {{-- new releve --}}
                                <td class="border py-2 border-y-4 border-x-0  border-y-slate-900"><a
                                        href="{{ route('relevelec.new', $elec->code_compteur) }}"
                                        class="bg-blue-500 py-1 px-2 rounded-sm text-white">Nouveau Releve</a></td>


                            </tr>
                        @endforeach

                    </tbody>
                </table>
                @if (count($electricites) == 0)
                    <p class="text-amber-400 text-center mt-6 text-sm">Ce Client n'a pas de Compteur d'Electricite</p>
                @endif
            </div>

            {{-- COMPTEUR D'EAU --}}
            <div class="w-full mt-12 mb-6">
                <p class="text-blue-200 uppercase font-bold text-center mb-4">Compteurs d'Eau</p>
                <table class="w-full  rounded-tr-xl rounded-tl-xl table-auto border-collapse">
                    <thead>
                        <tr class="text-sm text-gray-500 ">
                            <th>N° Compteur</th>
                            <th>PU</th>
                            <th>Date de creation</th>
                            <th>Suppression</th>
                            <th>Releve</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($eaux as $eau)
                            <tr class="text-center text-sm shadow-lg">
                                <td class="border py-2 border-y-4 border-x-0  border-y-slate-900">
                                    {{ $eau->code_compteur }} </td>
                                <td
                                    class="border py-2 border-y-4 border-x-0  border-y-slate-900">
                                    <form action="{{ route('clients.compteurs.update', $eau->id) }}" method="post"
                                        class="flex justify-center items-center gap-4">
                                        @csrf
                                        @method('put')
                                        <input type="number" name="pu" value="{{ $eau->pu }}"
                                            class="bg-slate-900 w-[100px]">
                                        <button type="submit"><i
                                                class="fa-solid fa-save text-green-500 text-md"></i></button>
                                    </form>
                                </td>
                                <td class="border py-2 border-y-4 border-x-0  border-y-slate-900">{{ $eau->created_at }}
                                </td>

                                {{-- deleting --}}
                                <td class="border py-2 border-y-4 border-x-0  border-y-slate-900">
                                    <form action="{{ route('clients.compteurs.delete', $eau->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"
                                            class=" py-1 px-3 rounded text-sm text-white transition duration-150 ease-in-out">
                                            <i class="fa-solid fa-trash text-red-500 text-md"></i></button>
                                    </form>
                                </td>

                                {{-- new releve --}}
                                <td class="border py-2 border-y-4 border-x-0  border-y-slate-900">
                                    <a href="{{ route('releve.new', $eau->code_compteur) }}"
                                        class="bg-blue-500 py-1 px-2 rounded-sm text-white">Nouveau Releve</a></td>


                            </tr>
                        @endforeach

                    </tbody>
                </table>
                @if (count($eaux) == 0)
                    <p class="text-amber-400 text-center mt-6 text-sm">Ce Client n'a pas de Compteur d'Eau</p>
                @endif
            </div>

        </div>

        {{-- Nouveau Compteur --}}
        <div class="w-full">
            <p class="text-xl text-white font-semibold mt-12 mb-6">Creer Nouveau Compteur</p>
            <form action="{{ route('clients.compteurs.new', $client->id) }}" method="post"
                class="flex flex-col gap-6 mb-4">
                @csrf
                <div class="w-[400px] flex flex-col gap-1">
                    <label for="type" class="text-slate-400 font-semibold text-md">Type de Compteur</label>
                    <select name="type" id="type" class="bg-slate-900 text-white uppercase">
                        @foreach ($types as $type)
                            <option value="{{ $type->type }}"> {{ $type->type }} </option>
                        @endforeach
                    </select>
                </div>

                <div class="w-[400px] flex flex-col gap-1">
                    <label for="pu" class="text-slate-400 font-semibold text-md">PU</label>
                    <input type="number" name="pu" id="pu" min="1" class="bg-slate-900 text-white uppercase">
                </div>

                <button type="submit"
                    class="w-[100px] bg-green-500 text-white font-bold hover:bg-green-600  rounded-sm py-1 px-2 transition duration-150">Creer</button>
            </form>
        </div>


    </div>
@endsection
