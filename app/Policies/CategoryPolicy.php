<?php

namespace App\Policies;

use App\Category;
use App\Reseller;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any categories.
     *
     * @param  \App\Reseller  $reseller
     * @return mixed
     */
    public function viewAny(Reseller $reseller)
    {
        //
    }

    /**
     * Determine whether the user can view the category.
     *
     * @param  \App\Reseller  $reseller
     * @param  \App\Category  $category
     * @return mixed
     */
    public function view(Reseller $reseller, Category $category)
    {
        return $reseller->id === $category->reseller_id
            ? Response::allow()
            : Response::deny('You do not own this category.');
    }

    /**
     * Determine whether the user can create categories.
     *
     * @param  \App\Reseller  $reseller
     * @return mixed
     */
    public function create(Reseller $reseller)
    {
        //
    }

    /**
     * Determine whether the user can update the category.
     *
     * @param  \App\Reseller  $reseller
     * @param  \App\Category  $category
     * @return mixed
     */
    public function update(Reseller $reseller, Category $category)
    {
        return $reseller->id === $category->reseller_id
            ? Response::allow()
            : Response::deny('You do not own this category.');
    }

    /**
     * Determine whether the user can delete the category.
     *
     * @param  \App\Reseller  $reseller
     * @param  \App\Category  $category
     * @return mixed
     */
    public function delete(Reseller $reseller, Category $category)
    {
        return $reseller->id === $category->reseller_id
            ? Response::allow()
            : Response::deny('You do not own this category.');
    }

    /**
     * Determine whether the user can restore the category.
     *
     * @param  \App\Reseller  $reseller
     * @param  \App\Category  $category
     * @return mixed
     */
    public function restore(Reseller $reseller, Category $category)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the category.
     *
     * @param  \App\Reseller  $reseller
     * @param  \App\Category  $category
     * @return mixed
     */
    public function forceDelete(Reseller $reseller, Category $category)
    {
        //
    }
}
