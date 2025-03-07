@extends('layout.layout')
@section('content')

    {{-- Little Title --}}
    <h1 class="text-center text-2xl font-semibold text-white">Register</h1>

    {{-- Field --}}
    <form action="{{route("clients.store")}}" method="post" class="w-full mt-6 py-7 rounded-lg shadow-md max-w-[80%] sm:max-w-[70%] md:max-w-[50%] lg:max-w-[40%] xl:max-w-[30%] mx-auto flex flex-col gap-5 items-center justify-center">
        @csrf

        {{-- Name --}}
        <div class="flex flex-col gap-1 w-full max-w-[90%]">
            <label for="nom" class="text-sm text-white font-semibold">Nom Prenom</label>
            <input class="bg-slate-900 text-white rounded py-2 px-2 outline-2 focus:outline focus:outline-blue-400" type="text" name="nom" id="nom" placeholder="Nom Complet">
            @error("nom")
                <span class="text-red-500 text-sm"> {{ $message }} </span>
            @enderror
        </div>

        {{-- Email --}}
        <div class="flex flex-col gap-1 w-full max-w-[90%]">
            <label for="email" class="text-sm text-white font-semibold">Email</label>
            <input class="bg-slate-900 text-white rounded py-2 px-2 outline-2 focus:outline focus:outline-blue-400" type="email" name="email" id="email" placeholder="E-mail">
            @error("email")
                <span class="text-red-500 text-sm"> {{ $message }} </span>
            @enderror
        </div>

        {{-- Sexe --}}
        <div class="flex flex-col gap-1 w-full max-w-[90%]">
            <label for="sexe" class="text-sm text-white font-semibold">Sexe</label>
            <select name="sexe" id="sexe" class="bg-slate-900 text-white">
                @foreach ($sexes as $sexe)
                    <option value="{{ $sexe->sexe }}">{{ $sexe->sexe }}</option>
                @endforeach
            </select>

            @error("sexe")
                <span class="text-red-500 text-sm"> {{ $message }} </span>
            @enderror
        </div>

        {{-- Quartier --}}
        <div class="flex flex-col gap-1 w-full max-w-[90%]">
            <label for="quartier" class="text-sm text-white font-semibold">Quartier</label>
            <select name="quartier" id="quartier" class="bg-slate-900 text-white">
                @foreach ($quartiers as $quartier)
                    <option value="{{ $quartier->quartier }}">{{ $quartier->quartier }}</option>
                @endforeach

            </select>

            @error("quartier")
                <span class="text-red-500 text-sm"> {{ $message }} </span>
            @enderror
        </div>

        {{-- Niveau --}}
        <div class="flex flex-col gap-1 w-full max-w-[90%]">
            <label for="niveau" class="text-sm text-white font-semibold">Niveau</label>
            <select name="niveau" id="niveau" class="bg-slate-900 text-white">
                @foreach ($niveaux as $niveau)
                    <option value="{{ $niveau->niveau }}">{{ $niveau->niveau }}</option>
                @endforeach

            </select>

            @error("niveau")
                <span class="text-red-500 text-sm"> {{ $message }} </span>
            @enderror
        </div>

        {{-- Register Button --}}
        <div class="w-full max-w-[90%] mx-auto">
            <button class="bg-indigo-800 hover:bg-indigo-900 transition duration-150 ease-in-out py-2 px-7 rounded-md text-sm  text-white uppercase" type="submit">Ajouter</button>
        </div>



    </form>

@endsection
