<x-layouts.main title="Sign in">
    <div class="flex min-h-screen justify-center items-center">
        <div class="border p-[3rem] rounded-lg">
            <p class="py-[1rem] font-semibold text-2xl">Sign in our account</p>
            <form action="{{ route('auth.signin.store') }}" method="post">
                @csrf
                <div class="flex flex-col gap-2 justify-center items-start w-full">
                    <div class="flex flex-col justify-start items-start w-full">
                        <label for="email">Email</label>
                        <input class="w-full border-gray-300 bg-gray-200/60 rounded-lg" placeholder="Your Email" type="text" name="email" id="email">
                        <x-error :messages="$errors->get('email')"/>
                    </div>
                    <div class="flex flex-col justify-start items-start w-full">
                        <label for="password">Password</label>
                        <input class="w-full border-gray-300 bg-gray-200/60 rounded-lg" placeholder="Your Password" type="password" name="password" id="password">
                        <x-error :messages="$errors->get('password')"/>
                    </div>
                    <div class="flex flex-col justify-start items-start w-full gap-[1rem]">
                        <button class="border rounded-lg w-full py-2 bg-yellow-600 hover:bg-yellow-500 font-semibold text-white" type="submit">Sign in</button>
                        <span class="text-center">Create an account? continue on <a href="{{ route('auth.signup') }}" class="hover:text-yellow-600 underline transition-all">Signup</a>.</span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts.main>
