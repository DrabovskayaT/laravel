<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Auth\AuthenticationException;
use Closure;
use App\Models\User;
use Auth;
use Route;
use App\Helpers\JsonHelper;

class Authenticate extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        //    dd($request->header());
        //@Note Временные проверки, для облегчения интеграции backend и fronend
        // if (in_array(Route::current()->uri, config('middleware.accessNotAuthRoutes')) && !isset($_REQUEST["TEST"])
        //     && !$request->header('Authorization')) {
        //     return $next($request);
        // }

        // if ($request->has("local_auth_front")) {
        //     $user = User::find(1);
        //     if($user){
        //         Auth::login($user);
        //         return $next($request);
        //     }
        // }

        try {
            $this->authenticate($request, $guards);
        } catch (AuthenticationException $e) {
            return abort(403);
        }


        return $next($request);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login');
        }
    }
}
