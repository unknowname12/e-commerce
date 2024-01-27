<x-layouts.main title="Create">
    <div class="min-h-screen w-full mx-auto">
        <div class="block p-6 bg-white border border-gray-200 rounded-lg bg-gray-300/20">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Create Category</h5>
            <hr class="my-[1rem]">
            <form method="post" action="{{ route('category.store')  }}">
                @csrf
                <div class="flex flex-col gap-3">
                    <div class="flex flex-col gap-1 justify-start items-start w-full">
                        <label for="title">Title:</label>
                        <input class="w-full border-gray-300 bg-gray-200/60 rounded-lg" placeholder="Category Title" type="text" name="title" id="title" value="{{ old('title') }}">
                        <x-error :messages="$errors->get('title')"/>
                    </div>
                    <div class="w-full md:w-auto">
                        <button type="submit" class="text-white bg-gray-700 hover:bg-gray-800 font-medium rounded-lg text-sm p-3">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts.main>
