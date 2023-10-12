<?php
namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{

    public function toResponse($request)
    {
        // if(Auth::user()->hasAnyRoles(['Administrator', 'Employee'])) {
        //     return redirect()->route('backend.dashboard');
        // }

        return redirect()->route('cart');
    }

}