<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function updatePhoto(Request $request): RedirectResponse
    {
        try {

            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $userName = strtolower(Auth::user()->name);
            $hashedName = md5(mb_strtolower($userName));
            $fileName = $hashedName;

            $path = $request->file('photo')->storeAs('profile-photos', $fileName, 'public');

            //full debug log about the file
            if (!Storage::disk('public')->exists($path)) {
                \Log::error('File not found after upload');
            }

            return Redirect::back()->with('status-profile-information', 'photo-updated');
        } catch (\Exception $e) {
            \Log::error('Photo upload failed: ' . $e->getMessage());
            return Redirect::back()->with('error-profile-information', 'Upload failed');
        }
    }

    public static function getProfilePicturePath($user): string
    {
        $userName = strtolower($user->name);
        $hashedName = md5(mb_strtolower($userName));
        $fileName = $hashedName;

        if (!Storage::disk('public')->exists('profile-photos/' . $fileName)) {
            return 'https://ui-avatars.com/api/?name=' . str_replace(' ', '+', $user->name);
        }

        return Storage::disk('public')->url('profile-photos/' . $fileName);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
