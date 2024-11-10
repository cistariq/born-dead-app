<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){
            try {
                if($request->isMethod('get')){
                    $listRouter = HeaderMenu()->pluck('url')->toArray();
                    $key = in_array(request()->route()->action['as'],$listRouter);
                    $array = array('dashboard','dead.print_dead_notic','profile.index','dead.scan_file.downloadFile');

                    if(!$key && !in_array(request()->route()->action['as'], $array)){
                        foreach ($listRouter as $value) {
                            if($value != '/'){
                               // return redirect()->route($value);
                            }
                        }
                    }
                }
            }catch (\Exception $exception){
                return abort('404');
            }
            return $next($request);
        }
        return redirect()->route('login');
    }



}
