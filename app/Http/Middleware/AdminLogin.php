<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Auth;
class AdminLogin
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

        
        
        if(empty(Session::has('adminSession')))
        {
            return redirect('admin')->with('error','Please login first to access');       

        }
        return $next($request);  
        
        
    }
}
