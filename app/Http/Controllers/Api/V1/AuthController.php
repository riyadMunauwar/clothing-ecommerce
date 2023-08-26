<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Traits\HttpJsonResponses;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;

class AuthController extends Controller
{
    use HttpJsonResponses;

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('api_token')->plainTextToken;

        return $this->jsonSuccessResponse([
            'token' => $token,
        ]);

    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $token = Auth::user()->createToken('api_token')->plainTextToken;

            return $this->jsonSuccessResponse([
                'token' => $token,
            ],'Login successful', 200);
        }

        throw ValidationException::withMessages([
            'email' => 'Invalid email or password',
        ]);
    }

    public function logout(Request $request)
    {

        try {

        }catch(\Exception $e){
            
        }
        $request->user()->tokens()->delete();

        return $this->jsonSuccessResponse([], 'Logout successfull', 200);
    }

}
