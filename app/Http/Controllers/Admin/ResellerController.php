<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Reseller;
use Illuminate\Http\Request;

class ResellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $resellers = Reseller::Latest()->get();

        return view('admin.reseller.index', compact('resellers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.reseller.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate form data
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:resellers'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'status' => 'required|in:approved,denied',
        ]);

        try {
            $data = $request->except('_token');
            $data['password'] = bcrypt($request->password);

            Reseller::create($data);

            return redirect()->back()->withSuccess('Reseller created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reseller  $reseller
     * @return \Illuminate\Http\Response
     */
    public function show(Reseller $reseller)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reseller  $reseller
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Reseller $reseller)
    {
        try {
            return view('admin.reseller.create-edit', compact('reseller'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reseller  $reseller
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Reseller $reseller)
    {
        // Validate form data
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => 'required|email|unique:resellers,email,'.$reseller->id,
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'status' => 'required|in:approved,denied',
        ]);

        try {
            if (isset($request->password)) {
                $data = $request->except('_token', '_method');
                $data['password'] = bcrypt($request->password);
            } else {
                $data = $request->only('name', 'email', 'status');
            }

            $reseller->update($data);

            return redirect()->back()->withSuccess('Reseller updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reseller  $reseller
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Reseller $reseller)
    {
        try {
            Reseller::destroy($reseller->id);

            return redirect()->back()->withSuccess('Reseller deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
