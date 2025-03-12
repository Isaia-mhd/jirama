<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    @vite('resources/css/app.css')

    <title> @yield('title') | {{ config('app.name') }} </title>
</head>

<body class="bg-slate-950">

    {{-- HEADER --}}
    <header class="w-full h-14 bg-slate-800 shadow-md rounded-br-xl rounded-bl-xl mb-6">
        <div class="flex items-center h-14 justify-between w-full max-w-[90%] mx-auto">
            <div class="">

                <h1 href="" class="text-2xl text-amber-400">{{ config('app.name') }}</h1>

            </div>

            <nav>
                <ul class="flex items-center justify-between gap-6 text-sm md:text-base font-normal">
                    <li><a href="{{ route('home') }}"
                            class="text-blue-700 transition duration-150 ease-in-out border-2 border-blue-800 py-[5px] px-4 !rounded-md hover:border-blue-700 hover:text-white">Home</a>
                    </li>
                    <li><a href="{{ route("clients") }}"
                            class="text-blue-700 transition duration-150 ease-in-out border-2 border-blue-800 py-[5px] px-4 !rounded-md hover:border-blue-700 hover:text-white">Clients</a>
                    </li>

                    <li><a href="{{ route("releve.list") }}"
                            class=" text-blue-700 transition duration-150 ease-in-out border-2 border-blue-800 py-[5px] px-4 !rounded-md hover:border-blue-700 hover:text-white">Relevés d'Eau</a>
                    </li>

                    <li><a href="{{ route("relevelec.list") }}"
                            class=" text-blue-700 transition duration-150 ease-in-out border-2 border-blue-800 py-[5px] px-4 !rounded-md hover:border-blue-700 hover:text-white">Relevés d'Electricité</a>
                    </li>

                </ul>
            </nav>

            <div class="">
                <form action="{{ route("client.quartier") }}" method="post" id="myForm">
                    @csrf
                    <select id="quartier" name="catQuartier" class="w-[150px] rounded-md py-1 px-3 bg-slate-800 text-white">
                        <option value="">Quartier</option>
                        @foreach ($clientQuartiers as $quartier)
                            <option value="{{ $quartier->quartier }}">{{ $quartier->quartier }}</option>
                        @endforeach
                        
                    </select>
                </form>
            </div>

            <div class="">
                <form action="{{ route("client.search") }}" method="post">
                    @csrf
                    <input type="search" name="search" placeholder="Rechercher client..." class="py-1 px-3 bg-slate-800 rounded-md text-white">
                    <button type="submit" class="bg-blue-700 text-white font-semibold py-1 px-3">Chercher</button>
                </form>
            </div>

        </div>
    </header>

    {{-- CONTENT --}}
    <section>
        @yield('content')
    </section>

    {{-- FOOTER --}}
    <footer class="w-full h-[50px] bg-blue-950 flex justify-center items-center mt-6">
        <p class="text-white font-light text-sm  ">copyright&copy; {{ date('Y') }} Colaborated by Mohamed and Mario 
        </p>
    </footer>



    <script>
        document.getElementById("quartier").addEventListener('change', function () {
            document.getElementById("myForm").submit();
        });
    </script>

</body>

</html>
