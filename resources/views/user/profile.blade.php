<x-header></x-header>
<x-nav></x-nav>
<x-layout>
    <!-- Main -->
    <x-wrapper>
        <div class="flex flex-col items-center space-y-4 p-4">
            <div class="flex flex-col items-center space-y-4 w-full">
                <img src="" alt="" class="w-36 h-36 rounded-full object-cover object-top-center">
                <div class="flex flex-col items-center space-y-2">
                    <div class="flex flex-col items-center">
                        <span class="font-semibold text-2xl">{{ $user->name }}</span>
                        <span class="text-gray-400">{{ '@' . $user->username }}</span>
                    </div>
                    @auth
                        @if (auth()->user()->username == $user->username)
                            <a href="#"
                                class="px-4 py-2 border border-blue-600 text-blue-600 font-medium rounded-full hover:bg-blue-600 hover:border-blue-600 hover:text-white duration-200">Edit
                                Profile</a>
                        @else
                            <div class="flex flex-row items-center space-x-2">
                                <a href="#"
                                    class="px-4 py-2 border bg-blue-600 text-white font-medium rounded-full hover:bg-transparent hover:border-blue-600 hover:text-blue-600 duration-200">Follow</a>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
            @if ($user->bio)
                {{ $user->bio }}
            @else
                <p class="text-center">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsam tempora
                    at expedita quisquam excepturi possimus.
                </p>
            @endif
            <div class="flex flex-row items-center space-x-4">
                <span><span class="font-bold">200</span> Followers</span>
                <span><span class="font-bold">100</span> Following</span>
            </div>
        </div>
        <!-- Tabs -->
        <div class="border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab"
                data-tabs-toggle="#myTabContent" role="tablist">
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="hum-tab"
                        data-tabs-target="#hum" type="button" role="tab" aria-controls="hum"
                        aria-selected="false">Hums</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab"
                        aria-controls="dashboard" aria-selected="false">Rehums</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="settings-tab" data-tabs-target="#settings" type="button" role="tab"
                        aria-controls="settings" aria-selected="false">Likes</button>
                </li>
            </ul>
        </div>
        <div id="myTabContent">
            <div class="hidden" id="hum" role="tabpanel" aria-labelledby="hum-tab">
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
                                        <span class="font-semibold">
                                            {{ $hum->name }}
                                        </span>
                                        <a href="/users/{{ $hum->user_id }}" class="text-blue-600">
                                            {{ '@' . $hum->username }}
                                        </a>
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
                                    <form action="/rehum/{{ $hum->id }}" method="POST">
                                        @csrf
                                        <button type="submit">
                                            <i class="fa-solid fa-retweet"></i>
                                        </button>
                                    </form>
                                    <span>{{ $hum->rehums }}</span>
                                </div>
                                <div class="flex flex-row items-center space-x-2">
                                    <form action="/like/{{ $hum->id }}" method="POST">
                                        @csrf
                                        <button type="submit">
                                            <i class="fa-regular fa-heart"></i>
                                        </button>
                                    </form>
                                    <span>{{ $hum->likes }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
            <div class="hidden" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
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
                                    <span class="font-semibold">John Cena</span>
                                    <span class="text-blue-600">@johncena</span>
                                </div>
                                <span class="text-gray-300 text-sm">A minute ago</span>
                            </div>
                            <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum, dolorum?
                                Corrupti enim quidem impedit! Enim labore laboriosam ipsum totam tenetur
                                quos
                                soluta excepturi aliquam obcaecati magni, sapiente repellendus, nam pariatur
                                porro numquam voluptatum rerum quas repudiandae! Accusamus vel voluptatibus
                                odio.</span>
                        </div>
                        <div class="flex flex-row items-center space-x-8 w-full text-gray-400">
                            <div class="flex flex-row items-center space-x-2">
                                <i class="fa-regular fa-comment"></i>
                                <span>69</span>
                            </div>
                            <div class="flex flex-row items-center space-x-2">
                                <i class="fa-solid fa-retweet"></i>
                                <span>69</span>
                            </div>
                            <div class="flex flex-row items-center space-x-2">
                                <i class="fa-regular fa-heart"></i>
                                <span>69</span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
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
                                    <span class="font-semibold">John Cena</span>
                                    <span class="text-blue-600">@johncena</span>
                                </div>
                                <span class="text-gray-300 text-sm">A minute ago</span>
                            </div>
                            <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum, dolorum?
                                Corrupti enim quidem impedit! Enim labore laboriosam ipsum totam tenetur
                                quos
                                soluta excepturi aliquam obcaecati magni, sapiente repellendus, nam pariatur
                                porro numquam voluptatum rerum quas repudiandae! Accusamus vel voluptatibus
                                odio.</span>
                        </div>
                        <div class="flex flex-row items-center space-x-8 w-full text-gray-400">
                            <div class="flex flex-row items-center space-x-2">
                                <i class="fa-regular fa-comment"></i>
                                <span>69</span>
                            </div>
                            <div class="flex flex-row items-center space-x-2">
                                <i class="fa-solid fa-retweet"></i>
                                <span>69</span>
                            </div>
                            <div class="flex flex-row items-center space-x-2">
                                <i class="fa-regular fa-heart"></i>
                                <span>69</span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
            <div class="hidden" id="settings" role="tabpanel" aria-labelledby="settings-tab">
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
                                    <span class="font-semibold">John Cena</span>
                                    <span class="text-blue-600">@johncena</span>
                                </div>
                                <span class="text-gray-300 text-sm">A minute ago</span>
                            </div>
                            <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum, dolorum?
                                Corrupti enim quidem impedit! Enim labore laboriosam ipsum totam tenetur
                                quos
                                soluta excepturi aliquam obcaecati magni, sapiente repellendus, nam pariatur
                                porro numquam voluptatum rerum quas repudiandae! Accusamus vel voluptatibus
                                odio.</span>
                        </div>
                        <div class="flex flex-row items-center space-x-8 w-full text-gray-400">
                            <div class="flex flex-row items-center space-x-2">
                                <i class="fa-regular fa-comment"></i>
                                <span>69</span>
                            </div>
                            <div class="flex flex-row items-center space-x-2">
                                <i class="fa-solid fa-retweet"></i>
                                <span>69</span>
                            </div>
                            <div class="flex flex-row items-center space-x-2">
                                <i class="fa-regular fa-heart"></i>
                                <span>69</span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
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
                                    <span class="font-semibold">John Cena</span>
                                    <span class="text-blue-600">@johncena</span>
                                </div>
                                <span class="text-gray-300 text-sm">A minute ago</span>
                            </div>
                            <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum, dolorum?
                                Corrupti enim quidem impedit! Enim labore laboriosam ipsum totam tenetur
                                quos
                                soluta excepturi aliquam obcaecati magni, sapiente repellendus, nam pariatur
                                porro numquam voluptatum rerum quas repudiandae! Accusamus vel voluptatibus
                                odio.</span>
                        </div>
                        <div class="flex flex-row items-center space-x-8 w-full text-gray-400">
                            <div class="flex flex-row items-center space-x-2">
                                <i class="fa-regular fa-comment"></i>
                                <span>69</span>
                            </div>
                            <div class="flex flex-row items-center space-x-2">
                                <i class="fa-solid fa-retweet"></i>
                                <span>69</span>
                            </div>
                            <div class="flex flex-row items-center space-x-2">
                                <i class="fa-regular fa-heart"></i>
                                <span>69</span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </x-wrapper>
</x-layout>
<x-footer></x-footer>
