<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class userAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$role): Response
    {
        if (in_array(auth()->user()->role, $role)) {
            return $next($request);
        }

        // Redirect based on the user's role if access is not allowed
        switch (auth()->user()->role) {
            case 'admin':
                return redirect('/dashboard/admin');
            case 'petugas':
                return redirect('/dashboard/petugas');
            case 'pimpinan':
                return redirect('/dashboard/pimpinan');
            default:
                return redirect('/');
        }
    }
}
