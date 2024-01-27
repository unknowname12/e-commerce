<x-layouts.main title="Index">
    <div class="flex w-full justify-center items-center">
        <x-_search/>
    </div>
    <hr class="my-[1rem]">
    <div class="flex flex-row justify-between items-center w-full whitespace-nowrap overflow-x-auto">
        <x-_categories :categories="$categories" :active="null"/>
        <x-_action_categories/>
    </div>
    <hr class="my-[1rem]">
    <div class="flex justify-center items-center md:justify-start md:items-start w-full">
        <x-_products :products="$products"/>
    </div>
    <hr class="my-[1rem]">
    {{ $products->onEachSide(1)->links() }}
</x-layouts.main>
