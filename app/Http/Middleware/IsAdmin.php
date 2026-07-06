<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;

class IsAdmin extends Middleware

{

    public function handle(Request $request, Closure $next): Response

    {

        // Cek apakah user sudah login

        if (!auth()->check()) {

            return redirect()->route('login');

        }

        return $next($request);

    }

}

