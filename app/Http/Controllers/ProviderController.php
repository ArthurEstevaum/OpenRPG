<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller
{
    public function redirect(string $provider): RedirectResponse
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider): RedirectResponse
    {
        $providerUser = Socialite::driver($provider)->user();

        $user = User::updateOrCreate([
            'email' => $providerUser->email,
        ], [
            'provider_id' => $providerUser->id,
            'name' => $providerUser->name,
            'email' => $providerUser->email,
            'provider_avatar' => $providerUser->avatar,
            'provider_name' => $provider,
        ]);

        Auth::login($user);

        if (! $user->password) {
            return redirect()->route('define-password');
        }

        return redirect('/');
    }
}
