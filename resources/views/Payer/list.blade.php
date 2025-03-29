@extends("layout.layout")
@section("title")
Payés
@endsection

@section("content")
     {{-- PAID --}}
     <div class="w-full max-w-[90%]  mx-auto">

        <div class="w-full">
            <h1 class="text-center text-white text-2xl font-semibold mb-6">Relevé  Payé</h1>
        </div>

        <div class="text-white">
            <p>
                @include('notify.success')
            </p>
            <table class="w-full  rounded-tr-xl rounded-tl-xl table-auto border-collapse">
                <thead>
                    <tr class="text-sm text-gray-500 ">
                        <th>Ref</th>
                        <th>Client</th>
                        <th>Date de Paiement</th>
                        <th>Montant</th>
                        <th>Suppression</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($paiements as $pay)
                        <tr class="text-center text-sm shadow-lg">
                            <td class="border py-2 border-y-4 border-x-0  border-y-slate-900"> {{ $pay->ref }}
                            </td>
                            <td class="border py-2 border-y-4 border-x-0  border-y-slate-900">{{ $pay->client }} </td>
                            <td class="border py-2 border-y-4 border-x-0  border-y-slate-900">{{ $pay->date_payment }}</td>
                            <td class="border py-2 border-y-4 border-x-0  border-y-slate-900">
                                {{ number_format($pay->montant, 0, ",", ".") }} Ariary
                            </td>


                            {{-- delete --}}
                            <td class="border py-2 border-y-4 border-x-0  border-y-slate-800">

                                <form action="{{ route("paiement.destroy", $pay->id) }}" method="post">
                                    @csrf
                                    @method("delete")
                                    <button type="submit" class="text-red-500">Supprimer</button>
                                </form>
                            </td>


                        </tr>
                    @endforeach

                </tbody>
            </table>
            @if (count($paiements) == 0)
                    <p class="text-gray-400 text-center mt-6">Aucun Relevé Payé</p>
            @endif
            {{-- <div class="w-full max-w-[90%] mx-auto mt-3">{{ $baskets->links('pagination::tailwind') }}</div> --}}


        </div>
    </div>
@endsection
