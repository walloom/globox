<?php

namespace App\Http\Middleware;

use Closure;

class CheckRoles {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        
        return $next($request);

        $permissions = auth()->user()->role->permissions;
        $permissions->load(['actions']);
        $actions = [];
        
        foreach ($permissions as $permission):
            foreach ($permission->actions as $action):
                $actions[] = [
                    'slug' => $action->slug,
                    'method' => $action->method
                ];
            endforeach;
        endforeach;
        
       
        $isNext = false;

        foreach ($actions as $action):

            if (!$isNext && $request->is($action['slug']) && $request->isMethod($action['method'])) {
                $isNext = true;
                break;
            }

        endforeach;

        if ($isNext) {
            return $next($request);
        }

        abort(401);



    }

}
