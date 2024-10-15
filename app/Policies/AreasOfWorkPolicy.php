<?php

namespace App\Policies;

use App\Models\User;
use App\Models\AreasOfWork;
use Illuminate\Auth\Access\HandlesAuthorization;

class AreasOfWorkPolicy
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
     * @param  \App\Models\AreasOfWork  $areasofwork
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, AreasOfWork $areasofwork)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AreasOfWork  $areasofwork
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, AreasOfWork $areasofwork)
    {
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AreasOfWork  $areasofwork
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, AreasOfWork $areasofwork)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AreasOfWork  $areasofwork
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, AreasOfWork $areasofwork)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AreasOfWork  $areasofwork
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, AreasOfWork $areasofwork)
    {
        //
    }
}
