<?php
namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{

    public function toResponse($request)
    {

        dd($request->redirect);

        $redirectRoute = $request->redirect ?? 'cart';

        return redirect()->route($redirectRoute);
    }

}