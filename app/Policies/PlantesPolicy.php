<?php

namespace App\Policies;

use App\Models\User;
use App\Models\plantes;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;


class PlantesPolicy
{
    use HandlesAuthorization;

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
     * @param  \App\Models\plantes  $plantes
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, plantes $plantes)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\plantes  $plantes
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, plantes $plantes)
    {
        //
        return $user->id == $plantes->user_id ? Response::allow()
        : Response::deny('Your are not authorized.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\plantes  $plantes
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, plantes $plantes)
    {
        //
        return $user->id == $plantes->user_id ? Response::allow()
        : Response::deny('Your are not authorized.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\plantes  $plantes
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, plantes $plantes)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\plantes  $plantes
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, plantes $plantes)
    {
        //
    }
}
