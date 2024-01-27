<x-layouts.main title="Home">
    <div class="flex min-h-screen justify-center items-center">
        <div>
            <h1 class="mb-4 text-center text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Berbelanja hanya disini sudah terjamin -- <span class="text-yellow-600 dark:text-blue-500">terbaik no #1</span> Indonesia.</h1>
            <p class="text-lg font-normal text-center text-gray-500 lg:text-xl dark:text-gray-400">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae debitis, deleniti doloremque, eligendi hic impedit maiores molestiae omnis provident quam recusandae tempora unde, ut! Corporis delectus laudantium molestias nobis soluta.</p>
        </div>
    </div>
    <hr class="my-[1rem]">
    <div class="flex flex-col gap-3 justify-center items-center md:justify-start md:items-start w-full">
        <x-_products :products="$products"/>
    </div>
    <hr class="my-[1rem]">
    <div class="my-[5rem]">
        <hr class="my-[1rem]">
        <p class="text-lg text-center font-normal text-gray-500 lg:text-xl dark:text-gray-400">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae debitis, deleniti doloremque, eligendi hic impedit maiores molestiae omnis provident quam recusandae tempora unde, ut! Corporis delectus laudantium molestias nobis soluta.</p>
        <hr class="my-[1rem]">
        <div class="flex flex-row justify-start items-center overflow-x-auto">
            <x-_categories :categories="$categories" :active="null"/>
        </div>
        <hr class="my-[1rem]">
    </div>
</x-layouts.main>
