<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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
$request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',

        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:255',
        'dpi' => 'nullable|string|max:50',

        'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        'dpi_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $request->user()->fill($request->validated());

    if ($request->user()->isDirty('email')) {
        $request->user()->email_verified_at = null;
    }

    // Guardar datos nuevos
    $request->user()->phone = $request->phone;
    $request->user()->address = $request->address;
    $request->user()->dpi = $request->dpi;

    // Guardar foto perfil
    if ($request->hasFile('profile_photo')) {

        $profilePath = $request->file('profile_photo')
            ->store('profiles', 'public');

        $request->user()->profile_photo = $profilePath;
    }

    // Guardar foto DPI
    if ($request->hasFile('dpi_photo')) {

        $dpiPath = $request->file('dpi_photo')
            ->store('dpis', 'public');

        $request->user()->dpi_photo = $dpiPath;
    }

    if ($request->hasFile('profile_photo')) {

    $profilePath = $request->file('profile_photo')
        ->store('profiles', 'public');

    $request->user()->profile_photo = $profilePath;
}

if ($request->hasFile('dpi_photo')) {

    $dpiPath = $request->file('dpi_photo')
        ->store('dpis', 'public');

    $request->user()->dpi_photo = $dpiPath;
}

    $request->user()->phone = $request->phone;
    $request->user()->address = $request->address;
    $request->user()->dpi = $request->dpi;
    $request->user()->save();

    return Redirect::route('profile.edit')->with('status', 'profile-updated');
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
