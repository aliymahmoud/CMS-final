<?php

namespace App\Http\Middleware;

use Closure;

class Student
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(\Auth::check()){
            if(\Auth::user()->isStudent()){
                if(\Auth::user()->email_verified_at){
                    return $next($request);
                }
                else{
                    return redirect(route('profile'));
                }
            }
            else{
                return $next($request);
            }
        }
        else{
            redirect(route('login'));
        }
    }
}
