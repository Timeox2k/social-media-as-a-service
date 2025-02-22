<nav x-data="{ mobileOpen: false, dropdownOpen: false }" class="bg-white dark:bg-gray-800 shadow-sm border-b dark:border-gray-700">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Left: Logo & Search -->
            <div class="flex items-center space-x-4">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="{{ route('dashboard') }}">
                        <p class="text-4xl font-bold text-gray-800 dark:text-gray-100">
                            {{ config('app.name', 'Laravel') }}
                        </p>
                    </a>
                </div>
                <div class="relative text-gray-600 dark:text-gray-400">
                    <input
                        type="text"
                        placeholder="Search"
                        class="bg-gray-100 dark:bg-gray-800 rounded-full pl-10 pr-4 py-2 focus:outline-none focus:shadow-outline w-full"
                    />
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400 dark:text-gray-500"></i>
                    </div>
                </div>
            </div>

            <!-- Right: Navigation Icons & User Menu -->
            <div class="flex items-center">
                <div class="md:flex items-center ml-4 space-x-3">
                    <button class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none">
                        <i class="fas fa-bell text-gray-800 dark:text-gray-100 text-lg"></i>
                    </button>
                </div>

                <!-- User Dropdown -->
                <div class="ml-4 relative">
                    <button @click="dropdownOpen = !dropdownOpen"
                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-800 dark:focus:border-gray-100">
                        <img class="h-8 w-8 rounded-full" src="{{
    \App\Http\Controllers\ProfileController::getProfilePicturePath(auth()->user())
}}" alt="Profile Picture">
                    </button>
                    <div
                        x-show="dropdownOpen"
                        @click.away="dropdownOpen = false"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 z-50"
                        style="display: none;"
                    >
                        <a href="{{ route('profile.edit') }}"
                           class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); this.closest('form').submit();"
                               class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                Log Out
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
