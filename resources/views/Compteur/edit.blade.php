@extends("layout.layout")

@section("title")
    MAJ Compteur
@endsection

@section('content')

    {{-- Little Title --}}
    <h1 class="text-center text-2xl font-semibold text-white">Mis à jour de Compteur</h1>

    {{-- Field --}}
    <form action="{{route("clients.compteurs.update", $compteur->id)}}" method="post" class="w-full mt-6 py-7 rounded-lg shadow-md max-w-[80%] sm:max-w-[70%] md:max-w-[50%] lg:max-w-[40%] xl:max-w-[30%] mx-auto flex flex-col gap-5 items-center justify-center">
        @csrf
        @method("put")
        {{-- Pu --}}
        <div class="flex flex-col gap-1 w-full max-w-[90%]">
            <label for="pu" class="text-sm text-white font-semibold">Pu</label>
            <input value="{{ $compteur->pu }}" class="bg-slate-900 text-white rounded py-2 px-2 outline-2 focus:outline focus:outline-blue-400" type="text" name="pu" id="pu" placeholder="PU">
            @error("pu")
                <span class="text-red-500 text-sm"> {{ $message }} </span>
            @enderror
        </div>

        {{-- MAJ Button --}}
        <div class="w-full max-w-[90%] mx-auto">
            <button class="bg-indigo-800 hover:bg-indigo-900 transition duration-150 ease-in-out py-2 px-7 rounded-md text-sm  text-white uppercase" type="submit">Mettre a jour</button>
        </div>

    </form>

@endsection

