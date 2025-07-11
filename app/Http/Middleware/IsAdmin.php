<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user || $user->role_id != 1) {  // supondo role_id 1 = admin
            abort(403, 'Acesso não autorizado. Você precisa ser administrador.');
        }

        return $next($request);
    }
}
