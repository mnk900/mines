<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ContactUs;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactUsPolicy
{
    use HandlesAuthorization;

    public function before($user,$ability){
        if($user->isAdminOrEditor()){
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ContactUs  $contact
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ContactUs $contact)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ContactUs  $contact
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ContactUs $contact)
    {
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ContactUs  $contact
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ContactUs $contact)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ContactUs  $contact
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ContactUs $contact)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ContactUs  $contact
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ContactUs $contact)
    {
        //
    }
}
