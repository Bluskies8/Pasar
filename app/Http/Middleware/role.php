<?php

namespace App\Http\Middleware;

use App\Models\role as ModelsRole;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class role
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
        if (!Auth::check())
            return redirect('login');

        $user = Auth::user();
        $roles = ModelsRole::get();
        if($user->role_id == 1)
            return $next($request);

        foreach($roles as $role) {
            // Check if user has the role This check will depend on how your roles are set up
            if($user->role_id == $role->id)
                return $next($request);
        }

        return redirect('login');
    }
}
