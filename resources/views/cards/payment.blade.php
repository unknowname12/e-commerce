<x-layouts.main title="Payment">
    <hr class="my-[1rem]">
    <x-_carts :carts="$carts"/>
    <hr class="my-[1rem]">
    {{ $carts->onEachSide(1)->links() }}
</x-layouts.main>
