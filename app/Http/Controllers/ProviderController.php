<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class ProviderController extends Controller
{
    public function redirect($provider) {
        return \Socialite::with($provider)->redirect();
    }

    public function handle($provider) {
        $providerUser = \Socialite::with($provider)->user();

        $nameParts = explode(' ', $providerUser->name);
        $first = "";
        $last = "";

        if(count($nameParts) == 2) {
            $first = $nameParts[0];
            $last = $nameParts[1];
        } else if(count($nameParts) == 3) {
            $first = $nameParts[0];
            $last = $nameParts[2];
        }

        $attributes = [
            'first_name' => $first,
            'last_name' => $last,
            $provider . '_id' => $providerUser->id,
            $provider . '_username' => ($providerUser->nickname === null) ? $providerUser->email : $providerUser->nickname,
        ];

        $user = User::firstOrCreate(['email' => $providerUser->email], $attributes);

        $user->update($attributes);

        auth()->login($user);

        return redirect()->route('dashboard');
    }

    public function unlink($provider) {
        auth()->user()->update([
            "{$provider}_id" => null,
            "{$provider}_username" => null
        ]);

        return redirect()->route('dashboard');
    }
}
