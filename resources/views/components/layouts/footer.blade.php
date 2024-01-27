<footer>
    <div class="border-t flex justify-center items-center w-full flex-col md:flex-row p-[1rem] gap-1">
        <span class="whitespace-nowrap">&copy; Copyright {{ now()->isoFormat('Y') }}</span>
        <span class="whitespace-nowrap">| {{  Config::get('app.author') }} |</span>
    </div>
</footer>
