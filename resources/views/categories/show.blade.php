<x-layouts.main title="Show">
    <div class="flex w-full justify-center items-center">
        <x-_search/>
    </div>
    <hr class="my-[1rem]">
    <div class="flex flex-row justify-between items-center w-full">
        <x-_categories :categories="$categories" :category="$category" active="link"/>
        <x-_action_categories/>
    </div>
    <hr class="my-[1rem]">
    <div class="flex min-h-screen justify-center items-center md:justify-start md:items-start w-full">
        <x-_products :products="$products"/>
    </div>
</x-layouts.main>
