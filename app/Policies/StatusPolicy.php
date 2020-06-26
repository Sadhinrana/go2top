<?php

namespace App\Policies;

use App\Status;
use App\Reseller;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class StatusPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any statuses.
     *
     * @param  \App\Reseller  $reseller
     * @return mixed
     */
    public function viewAny(Reseller $reseller)
    {
        //
    }

    /**
     * Determine whether the user can view the status.
     *
     * @param  \App\Reseller  $reseller
     * @param  \App\Status  $status
     * @return mixed
     */
    public function view(Reseller $reseller, Status $status)
    {
        return $reseller->id === $status->reseller_id
            ? Response::allow()
            : Response::deny('You do not own this status.');
    }

    /**
     * Determine whether the user can create statuses.
     *
     * @param  \App\Reseller  $reseller
     * @return mixed
     */
    public function create(Reseller $reseller)
    {
        //
    }

    /**
     * Determine whether the user can update the status.
     *
     * @param  \App\Reseller  $reseller
     * @param  \App\Status  $status
     * @return mixed
     */
    public function update(Reseller $reseller, Status $status)
    {
        return $reseller->id === $status->reseller_id
            ? Response::allow()
            : Response::deny('You do not own this status.');
    }

    /**
     * Determine whether the user can delete the status.
     *
     * @param  \App\Reseller  $reseller
     * @param  \App\Status  $status
     * @return mixed
     */
    public function delete(Reseller $reseller, Status $status)
    {
        return $reseller->id === $status->reseller_id
            ? Response::allow()
            : Response::deny('You do not own this status.');
    }

    /**
     * Determine whether the user can restore the status.
     *
     * @param  \App\Reseller  $reseller
     * @param  \App\Status  $status
     * @return mixed
     */
    public function restore(Reseller $reseller, Status $status)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the status.
     *
     * @param  \App\Reseller  $reseller
     * @param  \App\Status  $status
     * @return mixed
     */
    public function forceDelete(Reseller $reseller, Status $status)
    {
        //
    }
}
