<?php

namespace App\Http\Controllers\Reseller;

use App\Provider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CmsSettingProviderController extends Controller
{
    public function index()
    {
        $providers  = Provider::get();
        return view('reseller.settings.provider.index', compact('providers'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'domain' => 'required',
        ]);

        try{
            Provider::create([
                'domain'=> $request->domain,
                'api_url'=> $request->url,
                'api_key'=> $request->api_key,
            ]);
            return redirect()->route('reseller.setting.provider.index')->withSuccess('Provider Added successfully.');
         } catch (\Exception $e) {
             return redirect()->back()->withErrors(['error' => $e->getMessage()]);
         }
    }

    public function editProvider(Request $request)
    {
        $provider = Provider::find($request->id); 
        return [
            'status' => true,
            'data'   => $provider,
        ];
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'edit_domain' => 'required',
        ]);

        try{
            Provider::where('id', $request->provider_domain_id)->update([
                'domain'=> $request->edit_domain,
                'api_url'=> $request->edit_url,
                'api_key'=> $request->edit_api_key,
            ]);
            return redirect()->back()->withSuccess('Provider updated successfully.');
         } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
         }
    }
    public function destroy(Request $request)
    {
        try{
            $pro = Provider::find($request->provider_domain_del_id);
            if ($pro != null) {
                $pro->delete();
            }
            return redirect()->back()->withSuccess('Provider Deleted successfully.');
         } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
         }
    }
  

}
