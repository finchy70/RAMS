<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use function Laravel\Prompts\error;

class EPS
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if(auth()->user()->client_id == 1){
            return $next($request);
        }
        return redirect()->route('errors.401');


    }
}
