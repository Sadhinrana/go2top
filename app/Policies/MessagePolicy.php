<?php

namespace App\Policies;

use App\Message;
use App\Reseller;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class MessagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any messages.
     *
     * @param  \App\Reseller  $reseller
     * @return mixed
     */
    public function viewAny(Reseller $reseller)
    {
        //
    }

    /**
     * Determine whether the user can view the message.
     *
     * @param  \App\Reseller  $reseller
     * @param  \App\Message  $message
     * @return mixed
     */
    public function view(Reseller $reseller, Message $message)
    {
        return $reseller->id === $message->reseller_id
            ? Response::allow()
            : Response::deny('You do not own this message.');
    }

    /**
     * Determine whether the user can create messages.
     *
     * @param  \App\Reseller  $reseller
     * @return mixed
     */
    public function create(Reseller $reseller)
    {
        //
    }

    /**
     * Determine whether the user can update the message.
     *
     * @param  \App\Reseller  $reseller
     * @param  \App\Message  $message
     * @return mixed
     */
    public function update(Reseller $reseller, Message $message)
    {
        return $reseller->id === $message->reseller_id
            ? Response::allow()
            : Response::deny('You do not own this message.');
    }

    /**
     * Determine whether the user can delete the message.
     *
     * @param  \App\Reseller  $reseller
     * @param  \App\Message  $message
     * @return mixed
     */
    public function delete(Reseller $reseller, Message $message)
    {
        return $reseller->id === $message->reseller_id
            ? Response::allow()
            : Response::deny('You do not own this message.');
    }

    /**
     * Determine whether the user can restore the message.
     *
     * @param  \App\Reseller  $reseller
     * @param  \App\Message  $message
     * @return mixed
     */
    public function restore(Reseller $reseller, Message $message)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the message.
     *
     * @param  \App\Reseller  $reseller
     * @param  \App\Message  $message
     * @return mixed
     */
    public function forceDelete(Reseller $reseller, Message $message)
    {
        //
    }
}
