<?php

namespace App\Http\Middleware;

use App\Models\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;

class TwoFactor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $user = User::find(Auth::id());
        if (auth()->check() && $user->two_factor_code) {
            $expiresAt = Carbon::parse($user->two_factor_expires_at);

            if ($expiresAt->lt(now())) {
                $user->resetTwoFactorCode();
                auth()->logout();
                return redirect()->route('login')
                    ->withMessage('Срок действия двухфакторного кода истек. Пожалуйста, войдите еще раз.');
            }
            if (!$request->is('verify*')) {
                return redirect()->route('verify.index');
            }
        }
        return $next($request);
    }
}
