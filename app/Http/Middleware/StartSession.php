<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StartSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $credentials = $request->only('email', 'password');

        if(auth(guard: 'api')->attempt($credentials) or session('auth')){
            if(session('auth')){
                return $next($request);
            }
            session([
                'auth'=>'OK',
                'me'=>auth(guard: 'api')->user(),
            ]);
            return $next($request);
        }
        return redirect()->to('/login');
    }
}
