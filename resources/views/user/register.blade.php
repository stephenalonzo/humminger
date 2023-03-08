<x-header></x-header>
<x-layout>
    <!-- Main -->
    <div class="relative w-full h-screen">
        <!-- Register -->
        <div
            class="p-4 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col items-center space-y-6 w-full">
            <span class="font-semibold text-3xl">Register</span>
            <form action="/register" method="POST" class="w-full space-y-4">
                @csrf
                <input type="text" name="name" class="px-4 py-2 rounded-md border w-full"
                    placeholder="Enter your full name">
                <input type="email" name="email" class="px-4 py-2 rounded-md border w-full"
                    placeholder="Enter your email">
                <div class="relative">
                    <span
                        class="pointer-events-none absolute inset-y-0 left-0 grid w-10 place-content-center text-gray-500">@</span>
                    <input type="text" name="username"
                        class="w-full rounded-md border-gray-200 pl-10 pr-4 py-2 border"
                        placeholder="Enter your username" />
                </div>
                <input type="password" name="password" class="px-4 py-2 rounded-md border w-full"
                    placeholder="Enter your password">
                <input type="password" name="password_confirmation" class="px-4 py-2 rounded-md border w-full"
                    placeholder="Confirm your password">
                <div class="flex flex-row items-center justify-between w-full">
                    <span>Already have an account? <a href="#" class="font-semibold text-blue-600">Log
                            in</a></span>
                    <button type="submit"
                        class="px-4 py-2 border bg-blue-600 text-white rounded-md hover:bg-transparent hover:border-blue-600 hover:text-blue-600 duration-200">Sign
                        up</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
<x-footer></x-footer>