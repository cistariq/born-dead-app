<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Authenticate
{
    /**
     * Handle an incoming request.
     */
public function handle(Request $request, Closure $next): Response
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $sessionToken = session('device_token');
    $dbToken = Auth::user()->current_device_token;

    if (!$sessionToken || $sessionToken !== $dbToken) {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()
            ->route('login')
            ->withErrors([
                'msg' => 'تم تسجيل خروجك لأن الحساب تم استخدامه من جهاز آخر'
            ]);
    }

    return $next($request);
}

}
