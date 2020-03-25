<?php

namespace App\Http\Middleware;

use App\Role;
use Closure;
use Illuminate\Support\Facades\Auth;

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
        if(! Auth::check()) {
            session()->flash('error', 'You are not logged in');
            return redirect()->route('login');
        }

        if(Auth::user()->roles->isEmpty() || ! Auth::user()->roles->each(function ($role) {
                return $role->id === Role::ADMIN_ROLE ? true : false;
            })) {
            session()->flash('error', 'You are not authorized to view this page');
            return redirect()->route('login');
        }

        return $next($request);
    }
}
