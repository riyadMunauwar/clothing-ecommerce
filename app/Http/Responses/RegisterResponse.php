<?php
namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{

    public function toResponse($request)
    {

        $redirectRoute = $request->redirect;

        dd($redirectRoute === 'checkout');

        if($redirectRoute === 'checkout'){

            return redirect()->route('checkout');
        }

        return redirect()->route('cart');
    }

}