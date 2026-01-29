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

    if (!Auth::check()) {
        return $next($request);
    }

    if (
        !session('device_token') ||
        session('device_token') !== Auth::user()->current_device_token
    ) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->withErrors([
            'msg' => 'تم تسجيل خروجك تلقائياً لأن الحساب تم فتحه من جهاز آخر'
        ]);
      //  return redirect()->route('login');
    }

    return $next($request);
}

// public function handle(Request $request, Closure $next): Response
// {
//     // إذا لم يكن المستخدم مسجّل دخول → اسمح بالمرور
//     if (!Auth::check()) {
//         return $next($request);
//     }

//     // ===============================
//     // 🔐 Device Token Validation
//     // ===============================
//     $sessionToken = $request->session()->get('device_token');
//     $dbToken      = Auth::user()->current_device_token;

//     /**
//      * إذا:
//      * - لا يوجد توكن في الجلسة
//      * - أو لا يوجد توكن في قاعدة البيانات
//      * - أو التوكن مختلف
//      * ⇒ خروج إجباري (الجهاز قديم)
//      */
//     if (!$sessionToken || !$dbToken || $sessionToken !== $dbToken) {

//         Auth::logout();

//         $request->session()->invalidate();
//         $request->session()->regenerateToken();

//         return redirect()->route('login')->withErrors([
//             'msg' => 'تم تسجيل خروجك تلقائياً لأن الحساب تم فتحه من جهاز آخر'
//         ]);
//     }

//     return $next($request);
// }


}
