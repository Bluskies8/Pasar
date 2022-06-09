<?php

namespace App\Http\Middleware;

use App\Models\shif;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkshif
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
        // $cekuser = User::where('email',$request->email)->first();
        $cekuser = Auth::guard('checkLogin')->user();
        $time = Carbon::now();
        $cekshif = shif::where('number',$cekuser->shif)->first();
        if($cekuser->role_id == 4){
            // return $next($request);
            if($time < $cekshif->end && $time > $cekshif->start) {
                return $next($request);
            }else{
                return redirect('tologin');
            }
        }else{
            return $next($request);
        }

    }
}
