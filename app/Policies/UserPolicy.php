<?php

namespace App\Policies;

use App\Reseller;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Reseller  $reseller
     * @return mixed
     */
    public function viewAny(Reseller  $reseller)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Reseller  $reseller
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(Reseller  $reseller, User $user)
    {
        return $reseller->id === $user->reseller_id
            ? Response::allow()
            : Response::deny('You do not own this user.');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Reseller  $reseller
     * @return mixed
     */
    public function create(Reseller  $reseller)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Reseller  $reseller
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(Reseller  $reseller, User $user)
    {
        return $reseller->id === $user->reseller_id
            ? Response::allow()
            : Response::deny('You do not own this user.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Reseller  $reseller
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(Reseller  $reseller, User $user)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Reseller  $reseller
     * @param  \App\User  $user
     * @return mixed
     */
    public function restore(Reseller  $reseller, User $user)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Reseller  $reseller
     * @param  \App\User  $user
     * @return mixed
     */
    public function forceDelete(Reseller  $reseller, User $user)
    {
        //
    }
}
