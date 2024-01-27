<header>
    <div class="flex justify-around items-center w-full min-h-[54px]">
        <div class="flex justify-between items-center gap-[1rem]">
            <span class="font-semibold text-[1.5rem] underline">{{ Config::get('app.name') }}</span>
        </div>
        <div class="justify-between items-center gap-[1rem] hidden md:flex">
            <a href="{{ route('view.home') }}" class="{{ Route::is('view.home') ? 'text-yellow-600' : ''}} p-[1rem] hover:text-yellow-600 transition-all">Home</a>
            <a href="{{ route('product.index') }}" class="{{ Route::is(['product.*', 'category.*']) ? 'text-yellow-600' : ''}} p-[1rem] hover:text-yellow-600 transition-all">Product</a>
        </div>
        <form action="{{ route('auth.signout') }}" class="hidden" method="post" id="logout">@csrf @method('DELETE')</form>
        <div class="flex justify-between items-center gap-[1rem]">
            <div class="flex flex-row justify-center items-center gap-3">
                <a title="Carts" href="{{ Auth::check() ? route('cart.index', Auth::user()->slug) : route('auth.signin') }}" class="p-[.5rem] rounded-full bg-gray-200/50 border hover:text-yellow-600 transition-all">
                    <svg class="w-[20px] h-[20px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1"/>
                    </svg>
                </a>
                @if(Auth::check())
                    <a title="Added Data" href="{{ route('view.action') }}" class="p-[.5rem] rounded-full bg-gray-200/50 border hover:text-yellow-600 transition-all">
                        <svg class="w-[20px] h-[20px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 1v16M1 9h16"/>
                        </svg>
                    </a>
                @endif
            </div>
            @if(Auth::check())
                <button type="submit" class="hidden md:block p-[1rem] hover:text-yellow-600 transition-all"  form="logout">Sign out</button>
            @else
                <a href="{{ route('auth.signin') }}" class="hidden md:block p-[1rem] hover:text-yellow-600 transition-all">Sign in/Sign up</a>
            @endif
            <button title="Menu" type="button" class="md:hidden border p-[.5rem] rounded-lg bg-gray-200/50 hover:text-yellow-600 transition-all"  data-drawer-target="drawer-right-example" data-drawer-show="drawer-right-example" data-drawer-placement="right" aria-controls="drawer-right-example">
                <svg class="w-[20px] h-[20px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>
            <div aria-modal="true" id="drawer-right-example" class="fixed top-0 right-0 z-40 h-screen overflow-y-auto transition-transform translate-x-full bg-white w-full md:w-80 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-right-label">
                <div class="flex justify-between items-center gap-[1rem] px-[1rem] border-b min-h-[54px]">
                    <span id="drawer-right-label" class="font-semibold text-[1.5rem] underline">{{ Config::get('app.name') }}</span>
                    <button type="button" data-drawer-hide="drawer-right-example" aria-controls="drawer-right-example" class="border p-[.5rem] rounded-lg bg-gray-200/50 hover:text-yellow-600" >
                        <svg class="w-[20px] h-[20px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
                <div class="p-[1rem] pt-[3rem]">
                    <div class="grid grid-cols-1 gap-4">
                        <a href="{{ route('view.home') }}" class="px-4 py-2 text-sm font-medium text-center bg-white border border-gray-200 rounded-lg hover:text-yellow-600">Home</a>
                        <a href="{{ route('product.index') }}" class="px-4 py-2 text-sm font-medium text-center bg-white border border-gray-200 rounded-lg hover:text-yellow-600">Products</a>
                        <hr>
                        @if(Auth::check())
                            <button type="submit" class="px-4 py-2 text-sm font-medium text-center bg-white border border-gray-200 rounded-lg hover:text-yellow-600" form="logout">Sign out</button>
                        @else
                            <a href="{{ route('auth.signin') }}" class="{{ Route::is('auth.*') ? 'text-yellow-600' : ''}} px-4 py-2 text-sm font-medium text-center bg-white border border-gray-200 rounded-lg hover:text-yellow-600">Sign in/Sign up</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
