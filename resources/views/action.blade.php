<x-layouts.main title="Action">
    <div class="flex min-h-screen justify-center items-center">
        <div class="flex flex-col justify-center items-center text-center gap-[4rem]">
            <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Hai.. buat sesuatu untuk di -- <span class="text-yellow-600 dark:text-blue-500">Lihat</span> semua orang.</h1>
            <div class="flex flex-col md:flex-row justify-center items-center w-full gap-3">
                <a href="{{ route('product.create') }}" class="w-full md:w-auto justify-center transition-all inline-flex gap-2 items-center hover:text-yellow-600 text-lg font-normal border rounded-lg px-[2rem] py-[1rem] whitespace-normal">
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4 1 8l4 4m10-8 4 4-4 4M11 1 9 15"/>
                    </svg>
                    Products
                </a>
                <a href="{{ route('category.create') }}" class="w-full md:w-auto justify-center transition-all inline-flex gap-2 items-center hover:text-yellow-600 text-lg font-normal border rounded-lg px-[2rem] py-[1rem] whitespace-normal">
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4 1 8l4 4m10-8 4 4-4 4M11 1 9 15"/>
                    </svg>
                    Categories
                </a>
            </div>
        </div>
    </div>
</x-layouts.main>
