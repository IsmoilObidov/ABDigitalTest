<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;

use App\Models\User;

use App\Notifications\TwoFactorCode;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Http\Request;

use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\ValidationException;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    function view_register()
    {
        return view("auth.register");
    }

    function view_login()
    {
        return view("auth.login");
    }

    function register(RegisterRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return $this->login($request);
    }
    function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'name' => __('auth.failed'),
            ]);
        }

        $this->authenticated($request->email);

        return redirect()->route('verify.index');
    }

    protected function authenticated($email)
    {
        $user = User::where('email', $email)->first();

        $user->generateTwoFactorCode();

        $user->notify(new TwoFactorCode());
    }

    function logout()
    {
        Auth::guard('web')->logout();

        return redirect('login');
    }
}
