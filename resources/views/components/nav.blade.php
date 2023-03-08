@auth
<header class="shadow-lg">
    <nav class="p-4 w-full">
        <div class="container mx-auto lg:max-w-screen-md">
            <div class="flex flex-row items-center justify-between w-full">
                <span class="flex flex-row items-center space-x-8">
                    <a href="#">
                        <i class="fa-solid fa-bird text-2xl text-blue-600"></i>
                    </a>
                    <ul class="flex flex-row items-center space-x-6">
                        <li>
                            <a href="/" class="font-semibold">Home</a>
                        </li>
                        <li>
                            <a href="/users/{{ auth()->user()->id }}" class="font-semibold">Profile</a>
                        </li>
                    </ul>
                </span>
                {{-- <button type="submit" class="px-4 py-2 border bg-blue-600 text-white font-medium rounded-full hover:bg-transparent hover:border-blue-600 hover:text-blue-600 duration-200">Logout</button> --}}
            </div>
        </div>
    </nav>
</header>                    
@endauth