<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Beneficiaries;

class CheckBenExists
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
        $ben_id = $request->route('ben_id');

        if($ben_id==null || empty($ben_id)){
            abort(404);
        }

        $beneficiaries = Beneficiaries::where('id', @$ben_id)->count();

        if($beneficiaries > 0)
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
