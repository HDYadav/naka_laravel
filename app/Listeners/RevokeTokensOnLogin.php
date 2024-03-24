<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Passport\Token;
use Illuminate\Auth\Events\Authenticated;
 


class RevokeTokensOnLogin
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Authenticated $event)
    {
        $user = $event->user; 
        // Revoke all of the user's tokens
        $user->tokens->each(function (Token $token) {
            $token->revoke();
        });
    }
}