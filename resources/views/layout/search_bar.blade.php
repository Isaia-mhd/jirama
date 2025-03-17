<div class="">
    <form action="{{ route("client.search") }}" method="post">
        @csrf
        <input type="search" name="search" placeholder="Rechercher client..." class="w-[150px] py-1 px-3 bg-slate-800 rounded-md text-white">
        <button type="submit" class="bg-blue-700 text-white font-semibold py-1 px-3 rounded-sm"><i class="fa-solid fa-search"></i></button>
    </form>
</div>

