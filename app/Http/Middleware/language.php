<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use App\Models\DataLayer;

class language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $dl=new DataLayer();
        $dl->console_log('sono fuori');
        $dl->console_log(Session::get('language'));
        if(Session::has('language')){
            $dl->console_log('sono dentro');
            app()->setLocale(Session::get('language'));
        }
        return $next($request);
    }
}
