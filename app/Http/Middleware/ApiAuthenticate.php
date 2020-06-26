<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class ApiAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Validate form data
        $rules = array(
            'api_token' => 'required|string|max:255',
            'action' => 'required|string|in:package,add,status,balance',
        );

        $validator = validator($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors'=> $validator->getMessageBag()->toarray()));
        }

        if (!User::where('api_key', $request->api_token)->first()) {
            return response()->json(["error" => "invalid_credentials", "error_description" => "The api_token were incorrect.", "message" => "The user api_token were incorrect."], 401);
        }

        return $next($request);
    }
}
