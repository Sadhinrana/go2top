<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class ResellerEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $redirectToRoute = null)
    {
        if (!$request->user('reseller') ||
        ($request->user('reseller') instanceof MustVerifyEmail &&
        !$request->user('reseller')->hasVerifiedEmail())) {
            return $request->expectsJson()
            ? abort(403, 'Your email address is not verified.')
            : Redirect::route($redirectToRoute ?: 'reseller.verification.notice');
        }
        return $next($request);
    }
}
