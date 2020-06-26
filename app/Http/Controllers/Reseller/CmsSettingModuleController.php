<?php

namespace App\Http\Controllers\reseller;

use App\CmsSettingModule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\CmsSettingModuleModel;
use CmsSettingModuleTableSeeder;

class CmsSettingModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check_setting = CmsSettingModule::where('reseller_id', Auth::user()->id)->get();
        if (count($check_setting) != 3) :
            CmsSettingModule::where('reseller_id', Auth::user()->id)->delete();
            $cmsSettingSeed = new CmsSettingModuleTableSeeder();
            $cmsSettingSeed->run();
        endif; 

        $cms_active_module = CmsSettingModule::where('reseller_id', Auth::user()->id)->where('status','1')->get();
        $cms_inactive_module = CmsSettingModule::where('reseller_id', Auth::user()->id)->where('status','0')->get();
        return view('reseller.settings.module.index',compact('cms_active_module','cms_inactive_module'));
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required',
        ]);
        
        $update_mess = '';
        if ($request->type == 1) {
            $update_mess = 'Affiliate system ';
        } elseif ($request->type == 2) {
            $update_mess = 'Child panels selling ';
        } elseif ($request->type == 2) {
            $update_mess = 'Free balance ';
        }

        try{
            $update = [
                'amount' => $request->amount,
                'commission_rate'=> $request->commission_rate,
                'approve_payout' => $request->approve_payouts,
                'updated_at' => date('Y-m-d h:i:s')
            ];

            if ($request->status == 0) {
                $update['status'] = '1';
            }

            $data = CmsSettingModule::find($id);
            $data->update($update);

            return redirect()->back()->withSuccess($update_mess.' updated successfully.');
         } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage(), 'error_create_pop' => 1]);
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

    public function getModuleData(Request $request){
        return CmsSettingModule::find($request->id);
    }

    public function statusUpdate(Request $request){
        $request->validate([
            'id' => 'required|numeric',
        ]);

        try {
            $data = CmsSettingModule::find($request->id);
            $data->update(['status' => '0']);
            return response()->json(['status' => 1, 'message' => 'Deactivate successfully.']);
        } catch (\Exception $e) {
             return response()->json(['error' => $e->getMessage()]);
        }
    }
}
