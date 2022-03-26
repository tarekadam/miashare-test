<?php

namespace App\Http\Middleware;

use App\Models\Task;
use App\Scopes\UserScope;
use App\Scopes\WithTrashScope;
use Closure;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScopeMiddleware{
    /**
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next){

        if(!Auth::user()->is_administrator){
            Task::addGlobalScope(new UserScope(Auth::user()));
        }else{
            //removing global scope doesn't seem to work from middleware.
            Task::addGlobalScope(new WithTrashScope());
        }

        return $next($request);
    }
}
