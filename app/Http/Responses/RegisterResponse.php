<?php
namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{

    public function toResponse($request)
    {

        $redirectRoute = $request->redirect;

        return redirect()->route('checkout');

        if($redirectRoute === 'checkout'){

            return redirect()->route('cart');
        }
        else {

            return redirect()->route('checkout');
        }

    }

}