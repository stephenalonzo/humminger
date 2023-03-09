<x-header></x-header>
<x-nav></x-nav>
<x-layout>
    <!-- Main -->
    <x-wrapper>
        @foreach ($hums as $hum)
            <!-- Hums on your feed -->
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
                                <span class="font-semibold">{{ $hum->name }}</span>
                                <a href="/users/{{ $hum->user_id }}"
                                    class="text-blue-600">{{ '@' . $hum->username }}</a>
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
                        <span>
                            {{ $hum->hum }}
                        </span>
                    </div>
                    <div class="flex flex-row items-center space-x-8 w-full text-gray-400">
                        <div class="flex flex-row items-center space-x-2">
                            <a href="/reply/{{ $hum->id }}">
                                <i class="fa-regular fa-comment"></i>
                            </a>
                            <span>{{ $hum->replies }}</span>
                        </div>
                        <div class="flex flex-row items-center space-x-2">
                            <form action="/rehum/hum/{{ $hum->id }}" method="POST">
                                @csrf
                                <button type="submit">
                                    <i class="fa-solid fa-retweet"></i>
                                </button>
                            </form>
                            <span>{{ $hum->rehums }}</span>
                        </div>
                        <div class="flex flex-row items-center space-x-2">
                            <form action="/like/hum/{{ $hum->id }}" method="POST">
                                @csrf
                                <button type="submit">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                            </form>
                            <span>{{ $hum->likes }}</span>
                        </div>
                    </div>
                    <form action="/reply/{{ $hum->id }}/send" method="POST" class="w-full">
                        @csrf
                        <div class="flex flex-row items-center space-x-2">
                            <textarea name="reply" cols="30" rows="10"
                                class="resize-none border border-gray-300 w-full h-10 rounded-md px-4 py-1.5"
                                placeholder="Reply to {{ '@' . $hum->username }}"></textarea>
                            <button type="submit"
                                class="px-4 py-2 border bg-blue-600 text-white font-medium rounded-md hover:bg-transparent hover:border-blue-600 hover:text-blue-600 duration-200">Reply</button>
                        </div>
                    </form>
        @endforeach
        @foreach ($replies as $reply)
            <div class="flex flex-row items-start space-x-4 p-4 w-full">
                <a href="#" class="flex items-center">
                    <img alt="Man"
                        src="https://images.unsplash.com/photo-1600486913747-55e5470d6f40?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80"
                        class="h-10 w-10 rounded-full object-cover" />
                </a>
                <div class="flex flex-col items-start space-y-4 w-full">
                    <div class="flex flex-col items-start space-y-1 w-full">
                        <div class="flex flex-col items-start w-full xs:flex-row xs:items-center xs:justify-between">
                            <div class="flex flex-row items-center space-x-2">
                                <span class="font-semibold">{{ $reply->name }}</span>
                                <a href="/users/{{ $reply->username }}"
                                    class="text-blue-600">{{ '@' . $reply->username }}</a>
                            </div>
                            <span class="text-gray-300 text-sm">
                                @php
                                    $time_summary = time() - strtotime($reply->created_at);
                                    
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
                        <span>
                            {{ $reply->reply }}
                        </span>
                    </div>
                    <div class="flex flex-row items-center justify-between w-full">
                        <div class="flex flex-row items-center space-x-8 w-full text-gray-400">
                            <div class="flex flex-row items-center space-x-2">
                                <form action="/rehum/reply/{{ $reply->id }}" method="POST">
                                    @csrf
                                    <button type="submit">
                                        <i class="fa-solid fa-retweet"></i>
                                    </button>
                                </form>
                                <span>{{ $reply->rehums }}</span>
                            </div>
                            <div class="flex flex-row items-center space-x-2">
                                <form action="/like/reply/{{ $reply->id }}" method="POST">
                                    @csrf
                                    <button type="submit">
                                        <i class="fa-regular fa-heart"></i>
                                    </button>
                                </form>
                                <span>{{ $reply->likes }}</span>
                            </div>
                        </div>
                        <div class="flex flex-row items-center justify-end space-x-8 w-full text-gray-400">
                            <i class="fa-regular fa-trash"></i>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="w-full border-inherit text-gray-400">
        @endforeach
        </div>
        </div>
    </x-wrapper>
</x-layout>
<x-footer></x-footer>
