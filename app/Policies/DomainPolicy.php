<?php

namespace App\Policies;

use App\Domain;
use App\Reseller;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class DomainPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any domains.
     *
     * @param  \App\Reseller  $reseller
     * @return mixed
     */
    public function viewAny(Reseller $reseller)
    {
        //
    }

    /**
     * Determine whether the user can view the domain.
     *
     * @param  \App\Reseller  $reseller
     * @param  \App\Domain  $domain
     * @return mixed
     */
    public function view(Reseller $reseller, Domain $domain)
    {
        return $reseller->id === $domain->reseller_id
            ? Response::allow()
            : Response::deny('You do not own this domain.');
    }

    /**
     * Determine whether the user can create domains.
     *
     * @param  \App\Reseller  $reseller
     * @return mixed
     */
    public function create(Reseller $reseller)
    {
        //
    }

    /**
     * Determine whether the user can update the domain.
     *
     * @param  \App\Reseller  $reseller
     * @param  \App\Domain  $domain
     * @return mixed
     */
    public function update(Reseller $reseller, Domain $domain)
    {
        return $reseller->id === $domain->reseller_id
            ? Response::allow()
            : Response::deny('You do not own this domain.');
    }

    /**
     * Determine whether the user can delete the domain.
     *
     * @param  \App\Reseller  $reseller
     * @param  \App\Domain  $domain
     * @return mixed
     */
    public function delete(Reseller $reseller, Domain $domain)
    {
        return $reseller->id === $domain->reseller_id
            ? Response::allow()
            : Response::deny('You do not own this domain.');
    }

    /**
     * Determine whether the user can restore the domain.
     *
     * @param  \App\Reseller  $reseller
     * @param  \App\Domain  $domain
     * @return mixed
     */
    public function restore(Reseller $reseller, Domain $domain)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the domain.
     *
     * @param  \App\Reseller  $reseller
     * @param  \App\Domain  $domain
     * @return mixed
     */
    public function forceDelete(Reseller $reseller, Domain $domain)
    {
        //
    }
}
