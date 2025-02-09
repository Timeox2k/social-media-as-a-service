@php
    // Create placeholder friends collection with dummy data
    $friends = collect([
        (object)[
            'name' => 'Sarah Schmidt',
            'profile_photo_url' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=Sarah',
            'online' => true
        ],
        (object)[
            'name' => 'Max Weber',
            'profile_photo_url' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=Max',
            'online' => true
        ],
        (object)[
            'name' => 'Lisa Müller',
            'profile_photo_url' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=Lisa',
            'online' => false
        ],
        (object)[
            'name' => 'Thomas Klein',
            'profile_photo_url' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=Thomas',
            'online' => false
        ],
        (object)[
            'name' => 'Julia Wagner',
            'profile_photo_url' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=Julia',
            'online' => true
        ],
        // Duplicate some entries to simulate a longer list
        (object)[
            'name' => 'Sarah Schmidt',
            'profile_photo_url' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=Sarah',
            'online' => true
        ],
        (object)[
            'name' => 'Max Weber',
            'profile_photo_url' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=Max',
            'online' => true
        ],
        (object)[
            'name' => 'Lisa Müller',
            'profile_photo_url' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=Lisa',
            'online' => false
        ],
        (object)[
            'name' => 'Thomas Klein',
            'profile_photo_url' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=Thomas',
            'online' => false
        ],
        (object)[
            'name' => 'Julia Wagner',
            'profile_photo_url' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=Julia',
            'online' => true
        ],
    ]);
@endphp

<x-app-layout>
    <!-- Main container with relative positioning -->
    <div class="relative pt-16">
        <!-- Fixed width container for the main content -->
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">            <!-- Main Content Area -->
            <div class="bg-white dark:bg-gray-900 shadow-sm sm:rounded-lg p-4 mt-6">
                <div class="flex items-center space-x-4">
                    <img class="h-10 w-10 rounded-full border border-gray-200 dark:border-gray-700"
                         src="https://i.pravatar.cc/40" alt="Profile Photo">
                    <textarea
                        class="bg-gray-50 dark:bg-gray-800 rounded-xl pl-4 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400">What's on your mind, {{ auth()->user()->first_name }}?</textarea>
                </div>
                <div
                    class="flex justify-start items-center mt-4 border-t border-gray-200 dark:border-gray-700 pt-4 space-x-2">
                    <button
                        class="flex items-center space-x-2 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg px-3 py-2 transition-colors">
                        <i class="fas fa-images text-green-500"></i>
                        <span class="text-sm font-medium">Photo/Video</span>
                    </button>
                    <button
                        class="flex items-center space-x-2 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg px-3 py-2 transition-colors">
                        <i class="fas fa-smile text-yellow-500"></i>
                        <span class="text-sm font-medium">Feeling/Activity</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Right Friends Sidebar - Fixed positioning -->
        <aside
            class="hidden lg:block fixed right-0 top-16 w-full lg:w-80 h-[calc(100vh-4rem)] bg-white dark:bg-gray-800 border-l border-gray-200 dark:border-gray-700 p-4 overflow-y-auto border-t">
            <!-- Sidebar Header -->
            <div class="mb-4">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                    Friends ({{ $friends->count() }})
                </h2>
            </div>

            <!-- Friends List -->
            @if($friends->isEmpty())
                <div
                    class="flex flex-col items-center justify-center text-center text-gray-500 dark:text-gray-400 space-y-2">
                    <i class="fas fa-user-friends fa-2x"></i>
                    <p class="text-lg font-semibold">No friends yet</p>
                    <p class="text-sm">Start exploring and connect with people!</p>
                </div>
            @else
                <ul class="space-y-2">
                    @foreach($friends as $friend)
                        <li class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition cursor-pointer">
                            <!-- Avatar with online indicator -->
                            <div class="relative">
                                <img class="h-10 w-10 rounded-full border border-gray-300 dark:border-gray-600"
                                     src="{{ $friend->profile_photo_url }}" alt="{{ $friend->name }}">
                                @if($friend->online)
                                    <span
                                        class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full bg-green-400 ring-2 ring-white dark:ring-gray-800"></span>
                                @endif
                            </div>
                            <!-- Friend Name -->
                            <div>
                                <span class="text-gray-800 dark:text-gray-100 font-medium">{{ $friend->name }}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </aside>

        <!-- Mobile Friends Button -->
        <div class="fixed bottom-4 right-4 lg:hidden">
            <button
                class="bg-blue-500 text-white p-3 rounded-full shadow-lg focus:outline-none"
                onclick="document.getElementById('mobile-friends-list').classList.toggle('hidden')">
                <i class="fas fa-user-friends"></i>
            </button>
        </div>

        <!-- Mobile Friends List -->
        <div id="mobile-friends-list" class="hidden fixed inset-0 bg-white dark:bg-gray-800 p-4 overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                    Friends ({{ $friends->count() }})
                </h2>
                <button
                    class="text-gray-600 dark:text-gray-400"
                    onclick="document.getElementById('mobile-friends-list').classList.toggle('hidden')">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Friends List -->
            @if($friends->isEmpty())
                <div
                    class="flex flex-col items-center justify-center text-center text-gray-500 dark:text-gray-400 space-y-2">
                    <i class="fas fa-user-friends fa-2x"></i>
                    <p class="text-lg font-semibold">No friends yet</p>
                    <p class="text-sm">Start exploring and connect with people!</p>
                </div>
            @else
                <ul class="space-y-2">
                    @foreach($friends as $friend)
                        <li class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition cursor-pointer">
                            <!-- Avatar with online indicator -->
                            <div class="relative">
                                <img class="h-10 w-10 rounded-full border border-gray-300 dark:border-gray-600"
                                     src="{{ $friend->profile_photo_url }}" alt="{{ $friend->name }}">
                                @if($friend->online)
                                    <span
                                        class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full bg-green-400 ring-2 ring-white dark:ring-gray-800"></span>
                                @endif
                            </div>
                            <!-- Friend Name -->
                            <div>
                                <span class="text-gray-800 dark:text-gray-100 font-medium">{{ $friend->name }}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</x-app-layout>
