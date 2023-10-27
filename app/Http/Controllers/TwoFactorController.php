<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFactorController extends Controller
{
    public function index()
    {
        return view('auth.twoFactor');
    }
    public function store(Request $request)
    {
        $request->validate([
            'two_factor_code' => 'integer|required',
        ]);
        $user = User::find(Auth::id());
        if ($request->input('two_factor_code') == $user->two_factor_code) {
            $user->resetTwoFactorCode();
            return redirect()->route('dashboard');
        }
        return redirect()->back()
            ->withErrors(['two_factor_code' =>
            'The two factor code you have entered does not match']);
    }
    public function resend()
    {
        $user = User::find(Auth::id());
        $user->generateTwoFactorCode();
        $user->notify(new \App\Notifications\TwoFactorCode());
        return redirect()->back()->withMessage('Двухфакторный код отправлен снова');
    }
}
