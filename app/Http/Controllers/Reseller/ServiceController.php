<?php

namespace App\Http\Controllers\Reseller;

use App\Service;
use App\Category;
use App\Provider;
use http\Env\Response;
use App\ProviderService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:reseller');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $r)
    {
        if(isset($r->serviceTypefilter))
        {   $stype  = $r->serviceTypefilter;
            if($stype =='All')
            {
                $cate_services = Category::with(['services'=>function($q){
                    $q->orderBy('sort','ASC');
                }])->orderBy('sort', 'ASC')->get();
            }
            else
            {
                $cate_services = Category::with(['services'=>function($q) use ($stype){
                    $q->where('service_type','=',$stype);
                    $q->orderBy('sort','ASC');
                }])->orderBy('sort', 'ASC')->get();
            }

        }
        else
        {
            $cate_services = Category::with(['services'=>function($q){
                $q->orderBy('sort','ASC');
            }])->orderBy('sort', 'ASC')->get();
        }

        $service_type_counts =  [
            'All' => 0,
            'Default' => 0,
            'SEO'=> 0,
            'SEO2'=> 0,
            'Custom Comments'=> 0,
            'Custom Comments Package'=> 0,
            'Comment Likes'=> 0,
            'Mentions'=> 0,
            'Mentions with Hashtags'=> 0,
            'Mentions Custom List'=> 0,
            'Mentions Hashtag'=> 0,
            'Mentions Users Followers'=> 0,
            'Mentions Media Likers'=> 0,
            'Package'=> 0,
            'Poll'=> 0,
            'Comment Replies'=> 0,
            'Invites From Groups'=> 0,
        ];
        $all_service = Service::get();
        foreach ($all_service as $cs)
        {   $service_type_counts['All'] ++;
            if ($cs->service_type !=null)
                $service_type_counts[$cs->service_type]++;
        }

        // providers for auto mode services
        $providers = Provider::where('status', 'active')->get();
        return view('reseller.service.index',compact('cate_services','service_type_counts', 'providers'));
    }


    public function resetUserServiceCustomRate($service_id)
    {

        try {
            $service_clients = Service::find($service_id)->clients();
            if ($service_clients->count()>0)
            {
                $service_clients->detach();
            }
            return redirect()->back()->withSuccess('Service deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    public function duplicateService($service_id)
    {

        try {
            $service_clients = Service::find($service_id)->replicate();
            if ($service_clients->save()) {
                return redirect()->back()->withSuccess('Service duplicate successfully.');
            }
            else
            {
                return redirect()->back()->withErrors(['error' => 'unable to duplicate service']);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function resetManyServiceCustomRate(Request $r)
    {
        $see = Service::whereIn('id',explode(',',$r->service_ids))->get();
        foreach ($see as $s) {
            $s->clients()->detach();
        }
        return response()->json(['status'=>200,'message'=>'All service custom rate reset']);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('reseller.service.create-edit');
    }

    public function bulkEnable(Request $r)
    {
        Service::whereIn('id',explode(',',$r->service_ids))->update([
            'status' => 'active'
        ]);
        return response()->json(['status'=>200,'message'=>'successfully enabled all']);

    }
    public function bulkDisable(Request $r)
    {
        Service::whereIn('id',explode(',',$r->service_ids))->update([
            'status' => 'inactive'
        ]);
        return response()->json(['status'=>200,'message'=>'successfully disabled all']);
    }
    public function bulkCategory(Request $r)
    {
        Service::whereIn('id',explode(',',$r->service_ids))->update([
            'category_id' => $r->bulk_category_id
        ]);
        return response()->json(['status'=>200,'message'=>'successfully disabled all']);
    }
    public function bulkDelete(Request $r)
    {
        Service::whereIn('id',explode(',',$r->service_ids))->delete();
        return response()->json(['status'=>200,'message'=>'successfully disabled all']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate form data
        /* $request->validate([
             'name' => ['required', 'string', 'max:255'],
             'number' => ['required', 'string', 'max:255'],
             'shortname' => ['required', 'string', 'max:255'],
             'score' => ['required', 'integer', 'min:1', 'max:5'],
             'short_description' => ['required', 'string', 'max:255'],
             'description' => ['required', 'string'],
             'icon' => ['required', 'image', 'max:25'],
             'status' => 'required|in:active,inactive',
             'type' => 'required|in:1,2',
             'price' => 'required|numeric',
             'min_quantity' => 'required|integer',
             'max_quantity' => 'required|integer|gt:min_quantity',
             'category_id' => 'required|integer|exists:categories,id',
             'drip_feed' => 'required|boolean',
             'users' => 'nullable|array',
         ]);*/
        if ($request->service_type == 'Custom Comments Package' || $request->service_type == 'Package') {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'price' => 'required|numeric',
                'category_id' => 'required|integer|exists:categories,id',
            ]);
        }
        else
        {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'price' => 'required',
                'min_quantity' => 'required',
                'max_quantity' => 'required',
                'category_id' => 'required|integer|exists:categories,id',
            ]);
        }


        try {

            if ($request->has('edit_id'))
            {
                $data = $request->except('_token', 'score', 'users','edit_id','edit_mode', 'provider_selected_service_data');
            }
            else
            {
                $data = $request->except('_token', 'score', 'users', 'provider_selected_service_data');
            }

            $data['crown'] = $request->score;
            $data['reseller_id'] = Auth::guard('reseller')->id();
            $data['provider_sync_status'] = $request->provider_sync_status == 'on'? true: false;
            if (!$request->has('edit_id'))
            {
                $data['status'] = 'active';
            }

            if ($request->has('edit_id') && $request->has('edit_mode'))
            {
                $service = Service::find($request->edit_id)->update($data);
            }
            else
            {
                $service = Service::create($data);
                if ($data['mode'] == 'Auto') {
                    $json_data = json_decode($request->provider_selected_service_data, true);
                    ProviderService::create([
                        'service_id' => $service->id,
                        'provider_id' => $data['provider_id'],
                        'provider_service_id' => $json_data['service'],
                        'name' => $json_data['name'],
                        'type' => $json_data['type'],
                        'category' =>  $json_data['category'],
                        'rate'=>  $json_data['rate'],
                        'min'=>  $json_data['min'],
                        'max'=>  $json_data['max'],
                    ]);
                }
            }
            return response()->json(['status'=>200,'data'=> $service, 'message'=>'Service created successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status'=>401, 'data'=>$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Service $service)
    {
        Gate::authorize('view', $service);

        return view('reseller.service.show', compact('service'));
    }

    public function displayService($id){
        $servcie = Service::find($id);
        if($servcie!=null)
            return response()->json(['status'=>200,'data'=>$servcie]);
        else
            return response()->json(['status'=>401, data=>'data is not found with the ID']);
    }
    public function enableService($id){
        $servcie = Service::find($id);
        $servcie->status = ($servcie->status =='active') ? 'inactive':'active';
        if ($servcie->save())
        {
            // return redirect()->back()->withSuccess("Description updated successfully");
            return redirect()->route('reseller.services.index')->withSuccess('Service updated successfully.');
        }
        else
        {
            return redirect()->route('reseller.services.index')->withErrors(['error' => 'unable to update data']);
        }
    }
    public function updateService(Request $r, $id)
    {
        $data = $r->all();
        $servcie = Service::find($id);
        $servcie->description =
        $udpated = $servcie->update($data);
        if ($servcie->update($data))
        {
            return response()->json(['status'=>200, 'message'=>"Description updated successfully"]);
        }
        else
        {
            return response()->json(['status'=>401, 'message'=>"Error occured"]);
        }
        // dd($udpated);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Service $service)
    {
        Gate::authorize('view', $service);

        return view('reseller.service.create-edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        // Validate form data
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'number' => ['required', 'string', 'max:255'],
            'shortname' => ['required', 'string', 'max:255'],
            'score' => ['required', 'integer', 'min:1', 'max:5'],
            'short_description' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'icon' => ['nullable', 'image', 'max:25'],
            'status' => 'required|in:active,inactive',
            'type' => 'required|in:1,2',
            'price' => 'required|numeric',
            'min_quantity' => 'required|integer',
            'max_quantity' => 'required|integer|gt:min_quantity',
            'category_id' => 'required|integer|exists:categories,id',
            'drip_feed' => 'required|boolean',
            'users' => 'nullable|array',
        ]);

        Gate::authorize('update', $service);

        try {
            $data = $request->except('_token', 'score', '_method', 'users');
            $data['crown'] = $request->score;
            $data['is_user'] = count($request->users) && !in_array('all', $request->users) ? 1 : 0;
            if ($request->hasFile('icon')) {
                if ($service->icon) {
                    Storage::delete('public/'.$service->icon);
                }

                $data['icon'] = $request->file('icon')->store('services', ['disk' => 'public']);
            }

            $service->update($data);

            $service->users()->detach();

            if (count($request->users) && !in_array('all', $request->users)) {
                $service->users()->attach($request->users);
            }

            return redirect()->back()->withSuccess('Service updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */

    public function deleteService($id)
    {
        $service = Service::find($id);
        Gate::authorize('delete', $service);

        try {
            if ($service->icon) {
                Storage::delete('public/'.$service->icon);
            }

            $service->delete();

            return redirect()->back()->withSuccess('Service deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy(Service $service)
    {
        Gate::authorize('delete', $service);

        try {
            if ($service->icon) {
                Storage::delete('public/'.$service->icon);
            }

            $service->delete();

            return redirect()->back()->withSuccess('Service deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function sortData(Request $r)
    {
        try {
            $categories  = $r->services_ids;
            $cas = Service::get();
            $category_count = count($categories);
            foreach($cas as $ca)
            {
                $pos = null;
                foreach ($categories as $key => $id) {
                    if ($ca->id == $id) {
                        $pos  = $key == 0? 1: $key + 1;
                        break;
                    }
                }
                if ($pos !=null)
                {
                    $ca->sort  = $pos;
                    $ca->save();
                    $category_count--;
                }

            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'data'   => $e->getMessage(),
            ]);
        }
    }


    // auto provider

    public function getProviderServices(Request $r)
    {
        try {
            if (isset($r->provider_id)) {

                $provider  = Provider::find($r->provider_id);
                if ($provider != null) {
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $provider->api_url);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    //curl_setopt($ch, CURLOPT_POSTFIELDS,
                    //"postvar1=value1&postvar2=value2&postvar3=value3");

                    // In real life you should use something like:
                    curl_setopt($ch, CURLOPT_POSTFIELDS,
                        http_build_query(array(
                            'key' =>$provider->api_key,
                            'action' => 'services',
                        )));

                    // Receive server response ...
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                    $server_output = curl_exec($ch);

                    curl_close ($ch);
                    $result  =  json_decode($server_output, true);
                    return response()->json([
                        'status' => true,
                        'data'    => $result,
                    ]);
                }
                else
                {
                    return response()->json([
                        'status' => false,
                        'data'    => "No provider found",
                    ]);
                }

            }
            else
            {
                return response()->json([
                    'status' => false,
                    'data'    => "Invalid parameters",
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'data'    => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display a listing of provider services.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProviderServicesByCategory(Provider $provider)
    {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $provider->api_url);
            curl_setopt($ch, CURLOPT_POST, 1);

            // In real life you should use something like:
            curl_setopt($ch, CURLOPT_POSTFIELDS,
                http_build_query(array(
                    'key' =>$provider->api_key,
                    'action' => 'services',
                )));

            // Receive server response ...
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $server_output = curl_exec($ch);

            curl_close ($ch);
            $result = json_decode($server_output, true);

            $categories = [];

            foreach ($result as $item) {
                $key = array_search($item['category'], array_column($categories, 'category'));

                if ($key !== false) {
                    $categories[$key]['services'][] = $item;
                } else {
                    $categories[] = array(
                        'category' => $item['category'],
                        'services' => [$item]
                    );
                }
            }

            return response()->json([
                'status' => 200,
                'data'    => $categories,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'msg'    => $e->getMessage(),
            ]);
        }
    }

    /**
     * Import provider services.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function servicesImport(Request $request)
    {
        try {
            $data = [];

            foreach ($request->services as $index => $service) {
                $service = json_decode($service);

                if ($request->categories[$index] == 'create') {
                    $category = Category::where('name', $service->category)->first();

                    if ($category) {
                        $category = $category->id;
                    } else {
                        $category = Category::create([
                            'name' => $service->category,
                            'reseller_id' => \auth()->guard('reseller')->id()
                        ])->id;
                    }
                } else {
                    $category = $request->categories[$index];
                }

                $data[] = array(
                    'name' => $service->name,
                    'service_type' => $service->type,
                    'price' => $service->rate,
                    'min_quantity' => $service->min,
                    'max_quantity' => $service->max,
                    'drip_feed_status' => $service->dripfeed ? 'allow' : 'disallow',
                    'category_id' => $category,
                    'reseller_id' => \auth()->guard('reseller')->id(),
                    'created_at' => now(),
                    'updated_at' => now(),
                );
            }

            Service::insert($data);

            return redirect()->back()->withSuccess('Services imported successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
