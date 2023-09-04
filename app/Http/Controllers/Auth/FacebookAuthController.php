<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookAuthController extends Controller
{
    const AUTH_TYPE_FACEBOOK = 'facebook';

    public function facebookAuthRedirect()
    {
        return Socialite::driver(static::AUTH_TYPE_FACEBOOK)->redirect();
    }


    public function facebookAuthCallback()
    {
        try {

            $facebookUser = Socialite::driver(static::AUTH_TYPE_FACEBOOK)->user();

            $user = $this->updateOrCreateUser($facebookUser);

            Auth::login($user);
 
            return back();

        }catch(\Exception $e){

        }
    }


    private function updateOrCreateUser($facebookUser)
    {
        $user = User::updateOrCreate([
            'auth_provider_id' => $facebookUser->getId(),
            'auth_provider_type' => static::AUTH_TYPE_FACEBOOK,
        ], [
            'name' => $facebookUser->getName(),
            'email' => $facebookUser->getEmail(),
            'password' => Hash::make($facebookUser->getId()),
            'auth_provider_avatar_url' => $facebookUser->getAvatar()
        ]);

        if($user->getRoleNames()->isEmpty()){
            $user->assignRole('user');
        }

        return $user;
    }

}
