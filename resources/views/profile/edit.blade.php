<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Messy way for profile picture -->
            <!-- Should make a cleaner solution in the future -->

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Change Profile Picture</h2>

                    <div class="mt-4">
                        <img src="{{ \App\Http\Controllers\ProfileController::getProfilePicturePath(auth()->user()) }}"
                             alt="Profile Picture" class="w-24 h-24 rounded-full">
                    </div>

                    <form method="POST" action="{{ route('profile-photo.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <div class="mt-4">
                            <label for="photo" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                {{ __('Profile Picture') }}
                            </label>
                            <input type="file" name="photo" id="photo"
                                   class="mt-1 block w-full py-2 px-3 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-300">
                                Allowed file types: png, jpg, jpeg, gif. Max file size: 2MB.
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit"
                                    class="mt-2 inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                                {{ __('Upload') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-900 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-900 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-900 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
