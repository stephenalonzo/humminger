<x-header></x-header>
<x-layout>
    <!-- Main -->
    <x-wrapper class="relative h-screen">
        <!-- Login -->
        <div
            class="p-4 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col items-center space-y-6 w-full">
            <span class="font-semibold text-3xl">Log In</span>
            <form action="/authenticate" method="post" class="w-full space-y-4">
                @csrf
                <input type="text" name="username" class="px-4 py-2 rounded-md border w-full" placeholder="Username">
                @error('username')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
                <input type="password" name="password" class="px-4 py-2 rounded-md border w-full"
                    placeholder="Password">
                <div class="flex flex-row items-center justify-between w-full">
                    <span>No account yet? <a href="/register" class="font-semibold text-blue-600">Sign up</a></span>
                    <button type="submit"
                        class="px-4 py-2 border bg-blue-600 text-white rounded-md hover:bg-transparent hover:border-blue-600 hover:text-blue-600 duration-200">Log
                        in</button>
                </div>
            </form>
        </div>
    </x-wrapper>
</x-layout>
<x-footer></x-footer>