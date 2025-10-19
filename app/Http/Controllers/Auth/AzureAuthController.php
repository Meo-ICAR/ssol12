<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;
use GuzzleHttp\Exception\ClientException;

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
        try {
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

        } catch (InvalidStateException $e) {
            Log::error('Azure OAuth Invalid State Exception: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'Authentication failed due to invalid state. Please try again.');

        } catch (ClientException $e) {
            Log::error('Azure OAuth Client Exception: ' . $e->getMessage());
            Log::error('Azure OAuth Response Body: ' . $e->getResponse()->getBody());

            $responseBody = $e->getResponse()->getBody()->getContents();
            $errorData = json_decode($responseBody, true);

            if (isset($errorData['error_description'])) {
                $errorMessage = $errorData['error_description'];
            } else {
                $errorMessage = 'Authentication failed. Please check your Azure AD configuration.';
            }

            return redirect()->route('login')->with('error', $errorMessage);

        } catch (\Exception $e) {
            Log::error('Azure OAuth General Exception: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'An unexpected error occurred during authentication. Please try again.');
        }
    }
}
