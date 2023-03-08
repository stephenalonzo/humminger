<x-header></x-header>
<x-nav></x-nav>
<x-layout>
    <!-- Main -->
    <div class="w-full">
        <div class="space-y-3">
            <!-- Hum something -->
            <div class="flex flex-row items-start space-x-4 p-4 w-full">
                <a href="#" class="flex items-center">
                    <img alt="Man"
                        src="https://images.unsplash.com/photo-1600486913747-55e5470d6f40?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80"
                        class="h-10 w-10 rounded-full object-cover" />
                </a>
                <form action="/" method="post" class="w-full flex flex-col items-end space-y-2">
                    @csrf
                    <textarea name="hum" class="resize-none border w-full h-24 rounded-md px-4 py-2" placeholder="Hum something..."
                        required></textarea>
                    <button type="submit"
                        class="px-4 py-2 border bg-blue-600 text-white font-medium rounded-full hover:bg-transparent hover:border-blue-600 hover:text-blue-600 duration-200">Hum</button>
                </form>
            </div>
            <hr>
            <!-- Hums on your feed -->
            @unless(count($hums) == 0)
                @foreach ($hums as $hum)
                    @if (str_contains(auth()->user()->following, $hum->user->username) || auth()->user()->username == $hum->user->username)
                    <div class="flex flex-row items-start space-x-4 p-4 w-full">
                        <a href="#" class="flex items-center">
                            <img alt="Man"
                                src="https://images.unsplash.com/photo-1600486913747-55e5470d6f40?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80"
                                class="h-10 w-10 rounded-full object-cover" />
                        </a>
                        <div class="flex flex-col items-start space-y-4 w-full">
                            <div class="flex flex-col items-start space-y-1 w-full">
                                <div class="flex flex-row items-center justify-between w-full">
                                    <div class="flex flex-row items-center space-x-2">
                                        <span class="font-semibold">{{ $hum->user->name }}</span>
                                        <a href="/users/{{ $hum->user->id }}" class="text-blue-600">{{ '@' . $hum->user->username }}</a>
                                    </div>
                                    <span class="text-gray-300 text-sm">
                                        @php
                                            $time_summary = time() - strtotime($hum->created_at);
                                            
                                            if ($time_summary >= 31536000) {
                                                echo intval($time_summary / 31536000) . ' years ago';
                                            } elseif ($time_summary >= 2419200) {
                                                echo intval($time_summary / 2419200) . ' months ago';
                                            } elseif ($time_summary >= 86400) {
                                                echo intval($time_summary / 86400) . ' days ago';
                                            } elseif ($time_summary >= 3600) {
                                                echo intval($time_summary / 3600) . ' hours ago';
                                            } elseif ($time_summary >= 60) {
                                                echo intval($time_summary / 60) . ' minutes ago';
                                            } else {
                                                echo 'A few seconds ago';
                                            }
                                        @endphp
                                    </span>
                                </div>
                                <span>{{ $hum->hum }}</span>
                            </div>
                            <div class="flex flex-row items-center justify-between w-full">
                                <div class="flex flex-row items-center space-x-8 w-full text-gray-400">
                                    <div class="flex flex-row items-center space-x-2">
                                        <i class="fa-regular fa-comment"></i>
                                        <span>{{ $hum->replies }}</span>
                                    </div>
                                    <div class="flex flex-row items-center space-x-2">
                                        <i class="fa-solid fa-retweet"></i>
                                        <span>{{ $hum->rehums }}</span>
                                    </div>
                                    <div class="flex flex-row items-center space-x-2">
                                        <i class="fa-regular fa-heart"></i>
                                        <span>{{ $hum->likes }}</span>
                                    </div>
                                </div>
                                <div class="flex flex-row items-center justify-end space-x-8 w-full text-gray-400">
                                    <i class="fa-regular fa-trash"></i>
                                    <i class="fa-regular fa-bookmark"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @endif
                @endforeach
            @else
                <p>No hums found.</p>
            @endunless
        </div>
    </div>
</x-layout>
<x-footer></x-footer>
