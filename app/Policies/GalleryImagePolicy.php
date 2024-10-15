<?php

namespace App\Policies;

use App\Models\User;
use App\Models\GalleryImage;
use Illuminate\Auth\Access\HandlesAuthorization;

class GalleryImagePolicy
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
     * @param  \App\Models\GalleryImage  $gallery_image
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, GalleryImage $gallery_image)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GalleryImage  $gallery_image
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, GalleryImage $gallery_image)
    {
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GalleryImage  $gallery_image
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, GalleryImage $gallery_image)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GalleryImage  $gallery_image
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, GalleryImage $gallery_image)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GalleryImage  $gallery_image
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, GalleryImage $gallery_image)
    {
        //
    }
}
