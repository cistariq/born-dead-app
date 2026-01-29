<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SingleDeviceMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return $next($request);
        }

        $sessionToken = session('device_token');
        $dbToken = Auth::user()->current_device_token;

        if (!$sessionToken || !$dbToken || $sessionToken !== $dbToken) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login_from_perm')->withErrors([
                'msg' => 'تم تسجيل خروجك لأن الحساب تم فتحه من جهاز آخر'
            ]);
        }

        return $next($request);
    }
}
