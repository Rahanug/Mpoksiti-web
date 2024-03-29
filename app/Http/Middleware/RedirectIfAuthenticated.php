<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case "trader":
                if (Auth::guard("trader")->check()) {
                    return redirect()->route('trader.home');
                }
                break;
            case "admin":
                if (Auth::guard("admin")->check()) {
                    return redirect()->route('admin.manage');
                }
                break;
            case "jpp":
                if (Auth::guard("jpp")->check()) {
                    return redirect()->route('jpp.home'); //TODO
                }
                break;
            case "penanganan":
                if (Auth::guard("penanganan")->check()) {
                    return redirect()->route('penanganan.dashboard');
                }
                break;
            case "pengolahan":
                if (Auth::guard("pengolahan")->check()) {
                    return redirect()->route('pengolahan.dashboard');
                }
                break;
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect('/');
                }
                break;
        }

        return $next($request);
    }
}
