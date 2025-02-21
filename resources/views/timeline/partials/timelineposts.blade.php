@php
    $posts = \App\Models\Post::with('user')->orderBy('created_at', 'desc')->get();
    $feelingsMap = [
        'happy' => ['😊', 'Happy'],
        'sad' => ['😢', 'Sad'],
        'angry' => ['😠', 'Angry'],
        'surprised' => ['😲', 'Surprised'],
        'disgusted' => ['🤢', 'Disgusted'],
        'fearful' => ['😨', 'Fearful'],
    ];
@endphp

<div class="space-y-6">
    @foreach($posts as $post)
        <div
            class="bg-white dark:bg-gray-900 shadow-lg mt-6 rounded-lg overflow-hidden">
            <!-- User Info -->
            <div class="flex items-center p-4 border-b border-gray-200 dark:border-gray-700">
                <img class="h-12 w-12 rounded-full border border-gray-300 dark:border-gray-600"
                     src="{{ $post->user->profile_photo_url ?? 'https://i.pravatar.cc/40' }}" alt="Profile Photo">
                <div class="ml-4">
                    <div class="text-gray-900 dark:text-gray-100 font-semibold text-lg">
                        {{ $post->user->name ?? 'Unknown User' }}
                    </div>
                    @php
                        \Carbon\Carbon::setLocale('de');
                    @endphp
                    <div class="text-gray-500 dark:text-gray-400 text-sm" title="{{ $post->created_at->translatedFormat('d. F Y, H:i') }}">
                        {{ $post->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>

            <!-- Post Content -->
            <div class="p-4">
                <!-- Feelings Display -->
                @if($post->feelings && isset($feelingsMap[$post->feelings]))
                    @php
                        [$emoji, $feelingText] = $feelingsMap[$post->feelings];
                    @endphp
                    <div class="inline-flex items-center space-x-2 bg-blue-100 dark:bg-blue-800 px-3 py-1 rounded-full text-sm text-blue-800 dark:text-blue-200 mb-2">
                        <span class="text-lg">{{ $emoji }}</span>
                        <span>Feeling {{ $feelingText }}</span>
                    </div>
                @endif

                <p class="text-gray-800 dark:text-gray-200 text-base leading-relaxed">
                    {{ $post->content }}
                </p>

                <!-- Reaction Buttons and Comment Button -->
                <div class="mt-2 flex items-center justify-between">
                    <div class="flex space-x-1">
                        <!-- Like Button -->
                        <button class="flex items-center space-x-1 text-blue-500 hover:text-blue-600 transition-colors">
                            <span class="hover:scale-150">👍</span>
                        </button>

                        <!-- Love Button -->
                        <button class="flex items-center space-x-1 text-red-500 hover:text-red-600 transition-colors">
                            <span class="hover:scale-150">❤️</span>
                        </button>

                        <!-- Haha Button -->
                        <button class="flex items-center space-x-1 text-yellow-500 hover:text-yellow-600 transition-colors">
                            <span class="hover:scale-150">😂</span>
                        </button>

                        <!-- Wow Button -->
                        <button class="flex items-center space-x-1 text-orange-500 hover:text-orange-600 transition-colors">
                            <span class="hover:scale-150">😮</span>
                        </button>

                        <!-- Sad Button -->
                        <button class="flex items-center space-x-1 text-blue-300 hover:text-blue-400 transition-colors">
                            <span class="hover:scale-150">😢</span>
                        </button>

                        <!-- Angry Button -->
                        <button class="flex items-center space-x-1 text-red-700 hover:text-red-800 transition-colors">
                            <span class="hover:scale-150">😡</span>
                        </button>
                    </div>

                    <!-- Comment Button -->
                    <button class="flex items-center space-x-1 text-gray-500 hover:text-gray-600 transition-colors">
                        <span>💬</span>
                        <span>Comment</span>
                    </button>
                </div>
            </div>
        </div>
    @endforeach
</div>
