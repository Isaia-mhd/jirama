@extends('layout.layout')
@section('title')
    New Releve
@endsection

@section('content')
    <div class="w-full mb-[100px]">
        <h1 class="text-white text-2xl text-center">Releve d'Electricite</h1>

        {{-- Field --}}
        <form action="{{ route("relevelec.new.store", $compteur->id) }}" method="post"
            class="w-full mt-6 py-7 rounded-lg shadow-md max-w-[50%]  mx-auto flex flex-col gap-5 items-center justify-center">
            @csrf

            {{-- Compteur --}}
            <div class="flex flex-col gap-1 w-full">
                <label for="ncompteur" class="text-sm text-white font-semibold">N° Compteur</label>
                <input class="bg-slate-900 text-white rounded py-2 px-2 outline-2 focus:outline focus:outline-blue-400"
                    type="text" id="ncompteur" value="{{ $compteur->code_compteur }}" disabled>


                @error('code_compteur')
                    <span class="text-red-500 text-sm"> {{ $message }} </span>
                @enderror
            </div>

            <div class="w-full flex gap-4">
                {{-- Valeur --}}
                <div class="flex flex-col gap-1 w-full">
                    <label for="val" class="text-sm text-white font-semibold">Valeur(m<sup>3</sup>)</label>
                    <input class="bg-slate-900 text-white border-[1px] border-gray-500 py-2 px-2 outline-2 focus:outline focus:outline-blue-700"
                        type="int" min="1" name="valeur" id="val" placeholder="Valeur en m3">
                    @error('valeur')
                        <span class="text-red-500 text-sm"> {{ $message }} </span>
                    @enderror
                </div>

                {{-- Date de releve --}}
                <div class="flex flex-col gap-1 w-full">
                    <label for="date_rel" class="text-sm text-white font-semibold">Date de Relevé</label>
                    <input type="date" name="date_releve" id="date_rel" class="bg-slate-900 text-white font-semibold">

                    @error('date_releve')
                        <span class="text-red-500 text-sm"> {{ $message }} </span>
                    @enderror
                </div>
            </div>

            <div class="w-full flex gap-4">
                {{-- Date de presentation --}}
                <div class="flex flex-col gap-1 w-full">
                    <label for="date_pre" class="text-sm text-white font-semibold">Date de Présentation</label>
                    <input type="date" name="date_presentation" id="date_pre"
                        class="bg-slate-900 text-white font-semibold">

                    @error('date_presentation')
                        <span class="text-red-500 text-sm"> {{ $message }} </span>
                    @enderror
                </div>

                {{-- Date de limite --}}
                <div class="flex flex-col gap-1 w-full">
                    <label for="date_lim" class="text-sm text-white font-semibold">Date De Limite</label>
                    <input type="date" name="date_limite" id="date_lim" class="bg-slate-900 text-white font-semibold">

                    @error('date_limite')
                        <span class="text-red-500 text-sm"> {{ $message }} </span>
                    @enderror
                </div>
            </div>


            {{-- Register Button --}}
            <div class="w-full">
                <button
                    class="bg-indigo-800 hover:bg-indigo-900 transition duration-150 ease-in-out py-2 px-7 rounded-md text-sm  text-white uppercase"
                    type="submit">Creer New Relevé</button>
            </div>



        </form>

    </div>
@endsection
