<?php
namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{

    public function toResponse($request)
    {

        $redirectRoute = $request->redirect;


        if($redirectRoute === 'checkout'){

            return redirect()->route('checkout');
        }
        else {
            return redirect()->route('cart');
        }

    }

}