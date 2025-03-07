
<div class="w-full max-w-[50%] rounded-md h-[100px] py-6 mx-auto ">
    <form action="{{route("article.search")}}" method="post" class="w-full mx-auto text-center">
        @csrf
        <input type="search" name="search" id="search" placeholder="I'm looking for..." class="w-[50%] h-12 py-1 px-7 text-slate-500 text-sm  outline-none shadow-lg bg-slate-300 rounded-full">
        <button type="submit" class="rounded-tl-full rounded-br-full bg-blue-500 py-1 h-12 px-5 text-sm hover:bg-blue-600 transition duration-150 ease-in-out focus:bg-blue-700 text-white shadow-lg">Search</button>
    </form>
</div>

