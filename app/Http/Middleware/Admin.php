<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Admin
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
        $user = Session::get('user');
        if ($user) {
            if ($user['role'] == 0) {
                return $next($request);
            }
            return redirect('/mahasiswa');
        }
        return redirect('/auth');
    }
}
