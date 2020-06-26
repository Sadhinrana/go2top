<?php

namespace App\Http\Controllers\reseller;

use App\CmsSettingNotification;
use App\CmsStaffEmail;
use App\Http\Controllers\Controller;
use CmsSettingNotificationTableSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CmsSettingNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check_notificatoin = CmsSettingNotification::where('reseller_id', Auth::user()->id)->get();
        if (count($check_notificatoin) != 8) :
            CmsSettingNotification::where('reseller_id', Auth::user()->id)->delete();
            $cmsSettingSeed = new CmsSettingNotificationTableSeeder();
            $cmsSettingSeed->run();
        endif; 

        $cms_notification = CmsSettingNotification::where('reseller_id', Auth::user()->id)->get();
        $cms_staff_email = CmsStaffEmail::where('reseller_id', Auth::user()->id)->get();
        return view('reseller.settings.notification.index',compact('cms_notification','cms_staff_email'));
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
        $cms_notification = CmsSettingNotification::find($id);
        return view('reseller.settings.notification.edit',compact('cms_notification'));
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
            'subject' => 'required|max:255',
            'body' => 'required',
            'status' => 'required|in:0,1'
        ]);

        try{
            $updateArr = [
                'subject' => $request->subject, 
                'body' => $request->body, 
                'status' => $request->status,
                'updated_at' => date('Y-m-d h:i:s')
            ];
            
            $data = CmsSettingNotification::find($id);
            $data->update($updateArr);

            return redirect()->back()->withSuccess('Notification updated successfully.');
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

}
