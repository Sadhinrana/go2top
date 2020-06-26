<?php

namespace App\Http\Controllers\reseller;

use App\CmsSettingBonuse;
use App\GlobalPaymentMethod;
use App\Http\Controllers\Controller;
use App\ResellerPaymentMethodsSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CmsSettingBonusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cms_bonuses = CmsSettingBonuse::where('reseller_id', Auth::user()->id)->get();
        $cms_payment_setting = GlobalPaymentMethod::where('status', '1')->get();
        return view('reseller.settings.bonuses.index',compact('cms_bonuses','cms_payment_setting'));
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
            'bonus_amount' => 'required',
            'payment_method_id' => 'required|integer',
            'deposit_from' => 'required',
            'status' => 'required|integer|in:0,1',
        ]);

        try{
            $insert = CmsSettingBonuse::create([
                'reseller_id' => Auth::user()->id,
                'global_payment_method_id' => (int)$request->payment_method_id,
                'bonus_amount' => $request->bonus_amount,
                'deposit_from' => $request->deposit_from,
                'status' => $request->status,
                'created_at' => date('Y-m-d h:i:s'),
            ]);

            return redirect()->back()->withSuccess('Bonuses add successfully.');
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

    public function getBonusesData(Request $request){
        return CmsSettingBonuse::find($request->id);
    }

    public function updateData(Request $request, $id)
    {
        $rules = [
            'bonus_amount' => 'required',
            'payment_id' => 'required|integer',
            'deposit_from' => 'required',
            'status' => 'required|integer|in:0,1',
        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return response()->json(['status' => 0, "errors" => $validator->getMessageBag()->toArray()]);
        } else {

            $Arr = [
                'global_payment_method_id' => $request->payment_id,
                'bonus_amount' => $request->bonus_amount,
                'deposit_from' => $request->deposit_from,
                'status' => $request->status,
                'updated_at' => date('Y-m-d h:i:s')
            ];

            $data = CmsSettingBonuse::find($id);
            $update = $data->update($Arr);

            if ($update) {
                return response()->json(['status' => 1, 'mess' => 'Bonuses update successfully.']);
            } else {
                return response()->json(['status' => 0, 'mess' => 'Bonuses update failed.', "errors" => $validator->getMessageBag()->toArray()]);
            }

        }
    }
}
