<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Models\User;
use App\Notifications\UserEmailVerificationNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;


class SendUserEmailVerificationNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        if ($event->user instanceof MustVerifyEmail && ! $event->user->hasVerifiedEmail()) {
            $user = User::find($event->user->id);
            $user->notify(new UserEmailVerificationNotification());
           
        }
       
    }
    
}
