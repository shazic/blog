<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Http\Controllers\AlertsController as Alert;
class Admin
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
        if( !Auth::user()->admin )  {

            Alert::flashMessage(false,null, 'You need admin access to perform this task', 'info');
            return redirect()->back();
        }

        return $next($request);
    }
}
