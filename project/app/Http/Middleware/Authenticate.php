<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class Authenticate
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        Log::info('MIDDLEWARE HIT', [
            'auth' => Auth::check(),
            'session_token' => session('device_token'),
            'db_token' => Auth::check() ? Auth::user()->current_device_token : null,
            'url' => $request->url(),
        ]);

        // if (!Auth::check()) {
        //     return $next($request);
        // }
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        return $next($request);
        $user = Auth::user();

        // إذا ما في device_token في السيشن → عبّيها
        if (!session()->has('device_token')) {
            session(['device_token' => $user->current_device_token]);
            return $next($request);
        }

        // تحقق من التطابق
        if (session('device_token') !== $user->current_device_token) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->withErrors([
                'msg' => 'تم تسجيل خروجك لأن الحساب مفتوح من جهاز آخر'
            ]);
        }

        return $next($request);
    }
}
