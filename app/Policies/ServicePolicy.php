<?php

namespace App\Policies;

use App\Service;
use App\Reseller;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ServicePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any services.
     *
     * @param  \App\Reseller  $reseller
     * @return mixed
     */
    public function viewAny(Reseller $reseller)
    {
        //
    }

    /**
     * Determine whether the user can view the service.
     *
     * @param  \App\Reseller  $reseller
     * @param  \App\Service  $service
     * @return mixed
     */
    public function view(Reseller $reseller, Service $service)
    {
        return $reseller->id === $service->reseller_id
            ? Response::allow()
            : Response::deny('You do not own this service.');
    }

    /**
     * Determine whether the user can create services.
     *
     * @param  \App\Reseller  $reseller
     * @return mixed
     */
    public function create(Reseller $reseller)
    {
        //
    }

    /**
     * Determine whether the user can update the service.
     *
     * @param  \App\Reseller  $reseller
     * @param  \App\Service  $service
     * @return mixed
     */
    public function update(Reseller $reseller, Service $service)
    {
        return $reseller->id === $service->reseller_id
            ? Response::allow()
            : Response::deny('You do not own this service.');
    }

    /**
     * Determine whether the user can delete the service.
     *
     * @param  \App\Reseller  $reseller
     * @param  \App\Service  $service
     * @return mixed
     */
    public function delete(Reseller $reseller, Service $service)
    {
        return $reseller->id === $service->reseller_id
            ? Response::allow()
            : Response::deny('You do not own this service.');
    }

    /**
     * Determine whether the user can restore the service.
     *
     * @param  \App\Reseller  $reseller
     * @param  \App\Service  $service
     * @return mixed
     */
    public function restore(Reseller $reseller, Service $service)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the service.
     *
     * @param  \App\Reseller  $reseller
     * @param  \App\Service  $service
     * @return mixed
     */
    public function forceDelete(Reseller $reseller, Service $service)
    {
        //
    }
}
