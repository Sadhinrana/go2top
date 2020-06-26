<?php

namespace App\Http\Controllers\reseller;

use App\CmsStaffEmail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CmsSettingStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->validate([
            'email' => 'required'
        ]);
            
        try{
            $check_email = CmsStaffEmail::where('reseller_id', Auth::user()->id)->where('email', $request->email)->get();
            if (count($check_email) > 0) {
                return redirect()->back()->withErrors(['email' => 'This staff email already exists']);
            }

            $insert = CmsStaffEmail::create([
                'reseller_id'=> Auth::user()->id,
                'email'=> $request->email,
                'payment_received'=> $request->payment_received == "on" ? '1' : '0',
                'new_manual_orders'=> $request->new_manual_orders  == "on" ? '1' : '0',
                'fail_orders'=> $request->fail_orders  == "on" ? '1' : '0',
                'new_messages' => $request->new_messages  == "on" ? '1' : '0',
                'new_manual_payout' => $request->new_manual_payout  == "on" ? '1' : '0',
                'updated_at' => date('Y-m-d h:i:s'),
            ]);

            return redirect()->back()->withSuccess('Staff Email create successfully.');
        } catch(\Exception $e){
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
        //
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

    public function staffEmailUpdate(Request $request, $id)
    {
        $rules = [
            'email' => "required|email"
        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return response()->json(['status' => 0, "errors" => $validator->getMessageBag()->toArray()]);
        } else {
            $status = false;
            if ($request->email == $request->prev_email){
                $status = true;
            }else{
                $check_email = CmsStaffEmail::where('reseller_id', Auth::user()->id)->where('email', $request->email)->get();
                if (!$check_email->isEmpty()) {
                    foreach ($check_email as $checkEmail){
                        if ($checkEmail->email == $request->email) {
                            $status = false;
                        }
                    }
                } else {
                    $status = true;
                }
            }
             
            if ($status == false){
                return response()->json(['status' => 2, 'mess' => 'Staff email already exists.', "errors" => $validator->getMessageBag()->toArray()]);
            }

            $Arr = [
                'email' => $request->email, 
                'payment_received' => $request->payment_received == 'true' ? '1' : '0', 
                'new_manual_orders' => $request->manual_orders == 'true' ? '1' : '0',
                'fail_orders' => $request->fail_orders == 'true' ? '1' : '0',
                'new_messages' => $request->new_messages == 'true' ? '1' : '0',
                'new_manual_payout' => $request->manual_payout == 'true' ? '1' : '0',
                'updated_at' => date('Y-m-d h:i:s')
            ];
            
            $data = CmsStaffEmail::find($id);
            $update = $data->update($Arr);

            if ($update) {
                return response()->json(['status' => 1, 'mess' => 'Staff email update successfully.']);
            } else {
                return response()->json(['status' => 0, 'mess' => 'Staff email update failed.', "errors" => $validator->getMessageBag()->toArray()]);
            }
            
        }

    }

    public function getStaffData(Request $request)
    {
        return CmsStaffEmail::find($request->id);
    }

    public function delete(Request $request){

        $rules = [
            'id' => "required"
        ];

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
            return response()->json(['status' => 0, "errors" => $validator->getMessageBag()->toArray()]);
        } else {
            try{
                CmsStaffEmail::find($request->id)->delete();
                return response()->json(['status' => 1, 'mess' => 'Staff email delete successfully.']);
            } catch (\Exception $e) {
                return response()->json(['status' => 0, 'mess' => 'Staff email delete failed.', "errors" => $e->getMessage()]);
            }
        }
    }
}
