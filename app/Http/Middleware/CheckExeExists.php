<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Executor;

class CheckExeExists
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
        $exe_id = $request->route('exe_id');

        if($exe_id==null || empty($exe_id)){
            abort(404);
        }

        $executor = Executor::where('id', @$exe_id)->count();

        if($executor > 0)
        {
           return $next($request);
        }
        else
        {
            abort(404);
            // return redirect()->route('home');
        }

    }
}
