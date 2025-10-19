<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AzureAuthController extends Controller
{
    public function redirectToAzure(): RedirectResponse
    {
        return Socialite::driver('azure')->redirect();
    }

    public function redirectToAzureAd(): RedirectResponse
    {
        return Socialite::driver('azure')->with(['tenant' => 'organizations'])->redirect();
    }

    public function handleAzureCallback(): RedirectResponse
    {
        $azureUser = Socialite::driver('azure')->stateless()->user();

        $existingByAzureId = User::where('azure_id', $azureUser->getId())->first();
        if ($existingByAzureId) {
            Auth::login($existingByAzureId, remember: true);
            return redirect()->intended('/');
        }

        $existingByEmail = $azureUser->getEmail()
            ? User::where('email', $azureUser->getEmail())->first()
            : null;

        if ($existingByEmail) {
            $existingByEmail->update([
                'azure_id' => $azureUser->getId(),
                'name' => $existingByEmail->name ?: ($azureUser->getName() ?: $existingByEmail->email),
                'avatar' => method_exists($azureUser, 'getAvatar') ? $azureUser->getAvatar() : null,
            ]);

            Auth::login($existingByEmail, remember: true);
            return redirect()->intended('/');
        }

        $newUser = User::create([
            'name' => $azureUser->getName() ?: ($azureUser->getEmail() ?: 'Microsoft User'),
            'email' => $azureUser->getEmail(),
            'password' => Str::password(32),
            'azure_id' => $azureUser->getId(),
            'avatar' => method_exists($azureUser, 'getAvatar') ? $azureUser->getAvatar() : null,
        ]);

        Auth::login($newUser, remember: true);
        return redirect()->intended('/');
    }
}
