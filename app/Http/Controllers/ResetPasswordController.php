<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    function reset()
    {
        return view('auth.reset.reset');
    }

    function verification(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {

            $user->notify(new \App\Notifications\ResetVerification());

            return 'Ссылка для сброса пароля была отправлена на вашей электронной почте';
        } else {
            return back()->with('error', 'Указанный email не существует!');
        }
    }

    function veiw_reset_password(User $id)
    {
        return view('auth.reset.reset-password', ['user' => $id]);
    }

    function reset_password(Request $request, User $id)
    {
        $id->update([
            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('view_login')->with('success', 'Пароль изменён!');
    }
}
