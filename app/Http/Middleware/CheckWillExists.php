<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\WillMaster; 

class CheckWillExists
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
        $will_id = $request->route('id');

        if($will_id==null || empty($will_id)){
            abort(404);
        }

        $will = WillMaster::where('user_id',Auth::id())->where('id',@$will_id)->count();
        
        if($will > 0)
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
