<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    const AUTH_TYPE_GOOGLE = 'google';

    public function googleAuthRedirect()
    {
        return Socialite::driver(static::AUTH_TYPE_GOOGLE)->redirect();
    }


    public function googleAuthCallback()
    {
        try {

            $googleUser = Socialite::driver(static::AUTH_TYPE_GOOGLE)->user();

            $user = $this->updateOrCreateUser($googleUser);

            Auth::login($user);
 
            return back();

        }catch(\Exception $e){

        }
    }


    private function updateOrCreateUser($googleUser)
    {
        $user = User::updateOrCreate([
            'auth_provider_id' => $googleUser->getId(),
            'auth_provider_type' => static::AUTH_TYPE_GOOGLE,
        ], [
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'password' => Hash::make($googleUser->getId()),
            'auth_provider_avatar_url' => $googleUser->getAvatar()
        ]);

        if($user->getRoleNames()->isEmpty()){
            $user->assignRole('user');
        }

        return $user;
    }
}
