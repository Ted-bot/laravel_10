<?php

namespace App\Observers;

use App\Models\User;
use App\Notifications\RegisteredUserNotification;
use App\Classes\Role;

class userObserver
{

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $messages["greeting"] = "Dear Admin, a new member {$user->name} has singed up!";
        $messages["notify"] = "Congrats with the growth of your company.";

        $admins = User::whereHas('roles', function($role) {
            $role->where('slug', '=', Role::ADMIN);
        })->get();

        foreach($admins as $admin)
        {
            $admin->notify(new RegisteredUserNotification($messages));
        }
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
