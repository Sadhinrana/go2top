<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Show the specified resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showProfile()
    {
        return view('profile');
    }

    /**
     * Update the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function emailUpdate(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,'.Auth::guard('web')->id(),
            'new_email' => 'required|email|confirmed',
        ]);

        try {
            if (Auth::guard('web')->user()->email != $request->email) {
                return redirect()->back()->withErrors(['email' => 'Current email does not match!']);
            }

            User::find(Auth::guard('web')->id())->update(['email' => $request->new_email]);

            return redirect()->back()->withSuccess('Email updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        try {
            $user = User::find(Auth::guard('web')->id());

            if (!Hash::check($request->password, $user->password)) {
                return redirect()->back()->withErrors(['password' => 'Current password does not match!']);
            }

            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->back()->withSuccess('Password updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            User::find(Auth::guard('web')->id())->update($request->except(['_token', '_method']));

            return redirect()->back()->withSuccess('Profile updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
