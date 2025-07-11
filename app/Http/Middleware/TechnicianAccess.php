<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TechnicianAccess
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user || $user->role_id != 2) {  // supondo role_id 2 = técnico
            abort(403, 'Acesso não autorizado. Você precisa ser técnico.');
        }

        return $next($request);
    }
}
