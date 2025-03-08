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
                            class="hover:text-amber-400 text-white transition duration-150 ease-in-out">Home</a>
                    </li>
                    <li><a href="{{ route("clients") }}"
                            class="hover:text-amber-400 text-white transition duration-150 ease-in-out">Clients</a>
                    </li>

                    <li><a href=""
                            class=" text-white transition duration-150 ease-in-out bg-blue-500 py-[5px] px-4 !rounded-md hover:bg-blue-700">Connexion</a>
                    </li>

                </ul>
            </nav>


        </div>
    </header>

    {{-- CONTENT --}}
    <section>
        @yield('content')
    </section>

    {{-- FOOTER --}}
    <footer class="w-full h-[50px] bg-blue-950 flex justify-center items-center mt-6">
        <p class="text-white font-light text-sm ">copyright&copy; {{ date('Y') }} Developped by Isaia Mohamed
        </p>
    </footer>

</body>

</html>
