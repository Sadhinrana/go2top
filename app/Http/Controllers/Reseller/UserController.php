<?php

namespace App\Http\Controllers\Reseller;

use App\ExportedUser;
use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Service;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\ArrayToXml\ArrayToXml;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $input = $request->all();
        $input['keyword'] = isset($input['keyword']) ? $input['keyword'] : '';
        $sort_by = isset($input['sort_by']) ? $input['sort_by'] : 'id';
        $order_by = isset($input['order_by']) ? $input['order_by'] : 'desc';

        $users = auth()->guard('reseller')->user()->users()->where(function ($q) use ($input) {
            if ($input['keyword']) {
                $q->where('id', 'like', '%' . $input['keyword'] . '%')
                    ->orWhere('username', 'like', '%' . $input['keyword'] . '%')
                    ->orWhere('email', 'like', '%' . $input['keyword'] . '%')
                    ->orWhere('skype_name', 'like', '%' . $input['keyword'] . '%')
                    ->orWhere('balance', 'like', '%' . $input['keyword'] . '%')
                    ->orWhere('spent', 'like', '%' . $input['keyword'] . '%')
                    ->orWhere('status', 'like', '%' . $input['keyword'] . '%')
                    ->orWhere('created_at', 'like', '%' . $input['keyword'] . '%')
                    ->orWhere('last_login_at', 'like', '%' . $input['keyword'] . '%');
            }
        })->where(function ($q) use ($input) {
            if (isset($input['columns']) && is_array($input['columns'])) {
                foreach ($input['columns'] as $index => $value) {
                    $q->where($index, $value);
                }
            }
        })
            ->orderBy($sort_by, $order_by)
            ->paginate(100);

        return view('reseller.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'username' => 'nullable|string|max:255|unique:users',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'skype_name' => 'nullable|string|max:255|unique:users',
            'status' => 'required|in:pending,active,inactive',
            'password' => 'required|string|min:8|confirmed',
            'payment_methods' => 'required|array',
            'payment_methods.*' => 'required|integer|exists:reseller_payment_methods_settings,id',
        ]);

        try {
            $data = $request->except('_token');
            $data['reseller_id'] = Auth::guard('reseller')->id();
            $user = User::create($data);

            foreach ($request->payment_methods as $payment_method) {
                $user->paymentMethods()->attach($payment_method);
            }

            return redirect()->back()->withSuccess('User added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(User $user)
    {
        Gate::authorize('view', $user);

        try {
            $user = User::with('paymentMethods')->find($user->id);

            return response()->json(['status' => 200, 'data' => $user]);
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'msg' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        // Validate form data
        $request->validate([
            'username' => 'nullable|string|max:255|unique:users,username,'.$user->id,
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'skype_name' => 'nullable|string|max:255|unique:users,skype_name,'.$user->id,
            'status' => 'required|in:pending,active,inactive',
            'password' => 'nullable|string|min:8|confirmed',
            'payment_methods' => 'required|array',
            'payment_methods.*' => 'required|integer|exists:reseller_payment_methods_settings,id',
        ]);

        Gate::authorize('update', $user);

        try {
            $data = $request->except('_token', '_method');

            if ($request->password) {
                $data['password'] = bcrypt($request->password);
            } else {
                unset($data['password']);
            }

            $user->update($data);

            $user->paymentMethods()->sync($request->payment_methods);

            return redirect()->back()->withSuccess('User updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Update the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param  \App\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function passwordUpdate(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            $user->update(['password' => bcrypt($request->password)]);

            return redirect()->back()->withSuccess('Password updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Deactivate the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function suspend(User $user)
    {
        try {
            $user->update(['status' => $user->status == 'active' ? 'inactive' : 'active']);

            return redirect()->back()->withSuccess($user->status == 'inactive' ? 'User suspended successfully.' : 'User activated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Deactivate the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function suspendOrActicate(Request $request)
    {
        // Validate form data
        $request->validate([
            'type' => 'required|in:active,inactive',
            'users' => 'required|array',
            'users.*' => 'required|integer|exists:users,id',
        ]);

        try {
            User::whereIn('id', $request->users)->update(['status' => $request->type]);

            return redirect()->back()->withSuccess($request->type == 'inactive' ? 'Users suspended successfully.' : 'Users activated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show user services.
     *
     * @param \App\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function services(User $user)
    {
        try {
            return response()->json(['status' => 200, 'data' => $user->servicesList]);
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'msg' => $e->getMessage()]);
        }
    }

    /**
     * Update user service price.
     *
     * @param \App\User  $user
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function serviceUpdate(User $user, Request $request)
    {
        $request->validate([
            'price.*' => 'required|numeric',
            'percentage.*' => 'required|numeric',
        ]);

        Gate::authorize('view', $user);

        try {
            foreach ($request->price as $index => $value) {
                if ($user->servicesList->contains('id', $index)) {
                    $user->servicesList()->detach($index);
                    $user->servicesList()->attach($index, ['price' => $request->percentage[$index] ? ($value * Service::find($index)->price) / 100 : $value]);
                } else {
                    $user->servicesList()->attach($index, ['price' => $request->percentage[$index] ? ($value * Service::find($index)->price) / 100 : $value]);
                }
            }

            return redirect()->back()->withSuccess('Service custom rate updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Update user service price.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function serviceCustomRateUpdate(Request $request)
    {
        $request->validate([
            'from' => 'required|integer',
            'to' => 'required|integer',
        ]);

        try {
            $fromUser = User::findOrFail($request->from);
            $toUser = User::findOrFail($request->to);

            foreach ($fromUser->servicesList as $service) {
                if ($toUser->servicesList->contains('id', $service->id)) {
                    $toUser->servicesList()->detach($service->id);
                    $toUser->servicesList()->attach($service->id, ['price' => $service->pivot->price]);
                } else {
                    $toUser->servicesList()->attach($service->id, ['price' => $service->pivot->price]);
                }
            }

            return redirect()->back()->withSuccess('Custom rates copied successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function servicesDestroy(User $user)
    {
        Gate::authorize('view', $user);

        try {
            $user->servicesList()->detach();

            return redirect()->back()->withSuccess('Service custom rates deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\User  $user
     * @param \App\Service  $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function serviceDestroy(User $user, Service  $service)
    {
        Gate::authorize('view', $user);
        Gate::authorize('delete', $service);

        try {
            $user->servicesList()->detach($service->id);

            return redirect()->back()->withSuccess('Service custom rate deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function serviceCustomRateReset(Request $request)
    {
        // Validate form data
        $request->validate([
            'users' => 'required|array',
            'users.*' => 'required|integer|exists:users,id',
        ]);

        try {
            foreach ($request->users as $user) {
                User::find($user)->servicesList()->detach();
            }

            return redirect()->back()->withSuccess('Users custom rate reset successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Copy service custom rates to users.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function serviceCustomRateBulkUpdate(Request $request)
    {
        // Validate form data
        $request->validate([
            'from' => 'required|integer|exists:users,id',
            'users' => 'required|array',
            'users.*' => 'required|integer|exists:users,id',
        ]);

        try {
            $fromUser = User::find($request->from);
            $users = User::find($request->users);

            foreach ($users as $user) {
                foreach ($fromUser->servicesList as $service) {
                    if ($user->servicesList->contains('id', $service->id)) {
                        $user->servicesList()->detach($service->id);
                        $user->servicesList()->attach($service->id, ['price' => $service->pivot->price]);
                    } else {
                        $user->servicesList()->attach($service->id, ['price' => $service->pivot->price]);
                    }
                }
            }

            return redirect()->back()->withSuccess('Users custom rate copied successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function export()
    {
        return view('reseller.user.export');
    }

    /**
     * Export users.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function exportUsers(Request $request)
    {
        // Validate form data
        $request->validate([
            'from' => 'required|date',
            'to' => 'required|date|after_or_equal:from',
            'status' => 'required|array|in:all,pending,active,inactive',
            'format' => 'required|in:xml,json,csv',
            'include_columns' => 'required|array|in:id,username,email,name,skype_name,balance,spent,status,created_at,last_login_at',
        ]);

        try {
            $data = $request->except('_token');
            $data['include_columns'] = serialize($request->include_columns);
            $data['status'] = serialize($request->status);
            $data['reseller_id'] = auth()->guard('reseller')->id();

            ExportedUser::create($data);

            return redirect()->back()->withSuccess('Users exported successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Download exported users.
     *
     * @param \App\ExportedUser $exportedUser
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadExportedUser(ExportedUser $exportedUser)
    {
        try {
            $users = User::whereBetween('created_at', [$exportedUser->from, $exportedUser->to])
                ->where(function ($q) use ($exportedUser) {
                    if (!in_array('all', unserialize($exportedUser->status))) {
                        $q->whereIn('status', unserialize($exportedUser->status));
                    }
                })
                ->get(unserialize($exportedUser->include_columns));

            if ($exportedUser->format == 'json') {
                $filename = "public/exportedData/users.json";
                Storage::disk('local')->put($filename, $users->toJson(JSON_PRETTY_PRINT));
                $headers = array('Content-type' => 'application/json');

                return response()->download('storage/exportedData/users.json', 'users.json', $headers);
            } elseif ($exportedUser->format == 'xml') {
                $data = ArrayToXml::convert(['__numeric' => $users->toArray()]);
                $filename = "public/exportedData/users.xml";
                Storage::disk('local')->put($filename, $data);
                $headers = array('Content-type' => 'application/xml');

                return response()->download('storage/exportedData/users.xml', 'users.xml', $headers);
            } else {
                return Excel::download(new UsersExport($users, unserialize($exportedUser->include_columns)), 'users.xlsx');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
