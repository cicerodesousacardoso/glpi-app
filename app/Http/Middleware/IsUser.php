<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsUser
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user || $user->role_id != 3) {  // supondo role_id 3 = usuário comum
            abort(403, 'Acesso não autorizado. Você precisa ser usuário comum.');
        }

        return $next($request);
    }
}
