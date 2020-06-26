<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Controller;
use App\Reseller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ResellerController extends Controller
{
    /**
     * Show the specified resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showProfile()
    {
        return view('reseller.profile');
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
            'email' => 'required|email|unique:resellers,email,'.Auth::guard('reseller')->id(),
            'new_email' => 'required|email|confirmed',
        ]);

        try {
            if (Auth::guard('reseller')->user()->email != $request->email) {
                return redirect()->back()->withErrors(['email' => 'Current email does not match!']);
            }

            Reseller::find(Auth::guard('reseller')->id())->update(['email' => $request->new_email]);

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
            $admin = Reseller::find(Auth::guard('reseller')->id());

            if (!Hash::check($request->password, $admin->password)) {
                return redirect()->back()->withErrors(['password' => 'Current password does not match!']);
            }

            $admin->password = Hash::make($request->new_password);
            $admin->save();

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
            Reseller::find(Auth::guard('reseller')->id())->update($request->except(['_token', '_method']));

            return redirect()->back()->withSuccess('Profile updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
