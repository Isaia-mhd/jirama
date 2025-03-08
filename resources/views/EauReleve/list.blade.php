@extends("layout.layout")
@section("title")
Liste de Releve
@endsection

@section("content")
    <div class="w-full">
        <h1 class="text-white text-2xl text-center mb-3">Liste de Releves d'Eau</h1>

        <div class="text-white mt-6">
            <p>
                @include('notify.success')
            </p>
            <table class="w-full  rounded-tr-xl rounded-tl-xl table-auto border-collapse">
                <thead>
                    <tr class="text-sm text-gray-500 ">
                        <th>Client</th>
                        <th>N° Compteur</th>
                        <th>Net à Payer</th>
                        <th>Date de Releve</th>
                        <th>Date de Presentation</th>
                        <th>Date Limite de Paiement</th>
                        <th>Editing</th>
                        <th>Deleting</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($releves as $releve)
                        <tr class="text-center text-sm shadow-lg">
                            <td class="border py-2 border-y-4 border-x-0  border-y-slate-900"> {{ $releve->compteur->client->nom }} </td>
                            <td class="border py-2 border-y-4 border-x-0  border-y-slate-900"> {{ $releve->compteur->code_compteur }} </td>
                            <td class="border py-2 border-y-4 border-x-0  border-y-slate-900"> {{ $releve->valeur }} m<sup>3</sup></td>
                            <td class="border py-2 border-y-4 border-x-0  border-y-slate-900"> {{ $releve->date_releve }} </td>
                            <td class="border py-2 border-y-4 border-x-0  border-y-slate-900">{{ $releve->date_presentation }}</td>
                            <td class="border py-2 border-y-4 border-x-0  border-y-slate-900">{{ $releve->date_limite }}</td>

                            {{-- editing --}}
                            <td class="border py-2 border-y-4 border-x-0  border-y-slate-900">
                                <a href="{{ route("releve.edit", $releve->id) }}"><i
                                        class="fa-solid fa-pen text-green-500 text-md"></i></a>
                            </td>
                            {{-- deleting --}}
                            <td class="border py-2 border-y-4 border-x-0  border-y-slate-900">
                                <form action="{{ route("releve.delete", $releve->id) }}" method="post">
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
            @if (count($releves) == 0)
                    <p class="text-gray-400 text-center mt-6">Aucun Client</p>
            @endif
            {{-- <div class="w-full max-w-[90%] mx-auto mt-3">{{ $baskets->links('pagination::tailwind') }}</div> --}}


        </div>

    </div>
@endsection

