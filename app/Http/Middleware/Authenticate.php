<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Contracts\Auth\Middleware\AuthenticatesRequests;
use Illuminate\Auth\AuthenticationException;


class Authenticate extends Middleware
{


    protected function authenticate($request, array $guards)
    {

        if (empty($guards)) {
            $guards = [null];
        }

        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                return $this->auth->shouldUse($guard);
            }
        }

        $this->unauthenticated($request, $guards);
    }


    protected function unauthenticated($request, array $guards)
    {      
       // dd($request);
             
        throw new AuthenticationException(
            'Unauthenticated token.', $guards, $this->redirectTo($request)
        );
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request)
    {

        try {
          $request->expectsJson() ? null : response()->json('false');
        }catch(\Exception $exception){
            dd($exception);
        }
    } 
}
