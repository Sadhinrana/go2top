<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct()
	{
		$this->middleware('auth:admin');
	}

	/**
	* Show the application dashboard.
	*
	* @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	*/
	public function index()
	{
		return view('admin.dashboard');
	}

	/**
	* Show the specified resource.
	*
	* @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	*/
	public function show()
	{
		return view('admin.profile');
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
			'email' => 'required|email|unique:admins,email,'.Auth::guard('admin')->id(),
			'new_email' => 'required|email|confirmed',
		]);

        try {
            if (Auth::guard('admin')->user()->email != $request->email) {
                return redirect()->back()->withErrors(['email' => 'Current email does not match!']);
            }

            Admin::find(Auth::guard('admin')->id())->update(['email' => $request->new_email]);

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
            $admin = Admin::find(Auth::guard('admin')->id());

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
            Admin::find(Auth::guard('admin')->id())->update($request->except(['_token', '_method']));

            return redirect()->back()->withSuccess('Profile updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
