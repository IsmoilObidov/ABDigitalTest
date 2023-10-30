<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function register(Request $request)
    {

        $user = new User();
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->save();

        return $this->login_api($request);
    }

    function login_api(Request $request)
    {

        $credentials = request(['name', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Credeantials'
            ], 401);
        }

        $token = $request->user()->createToken($request->user()->name);

        return response()->json([

            'token_type' => 'Bearer',
            'access_token' => $token->plainTextToken,

        ], 200, [], JSON_PRETTY_PRINT);
    }
}
