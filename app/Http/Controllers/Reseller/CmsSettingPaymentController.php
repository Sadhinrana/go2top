<?php

namespace App\Http\Controllers\reseller;

use App\GlobalPaymentMethod;
use App\Http\Controllers\Controller;
use App\ResellerPaymentMethodsParameter;
use App\ResellerPaymentMethodsSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CmsSettingPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reseller_payment_method_list = ResellerPaymentMethodsSetting::where('reseller_id', Auth::user()->id)->orderBy('visibility','desc')->orderBy('sort')->get();
        $global_payment_list = GlobalPaymentMethod::select('global_payment_methods.*')
        ->whereNotIn('id', function ($query) {
            $query->select('global_payment_method_id')->from('reseller_payment_methods_settings')->where('reseller_id', Auth::user()->id);
        })
        ->where('global_payment_methods.status', '1')
        ->select('*')
        ->get();

        return view('reseller.settings.payment.index',compact('global_payment_list','reseller_payment_method_list'));
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
        $this->validate($request, [
            'payment_method' => 'required|integer',
        ]);

        try{
            $global_payment = GlobalPaymentMethod::where('id',$request->payment_method)->select('name')->get();

            ResellerPaymentMethodsSetting::create([
                'reseller_id'=> Auth::user()->id,
                'global_payment_method_id'=> $request->payment_method,
                'method_name'=> $global_payment[0]->name,
                'minimum' => 10,
                'created_at' => date('Y-m-d h:i:s'),
            ]);

            $this->paymentParameters($request->payment_method);
            return redirect()->route('reseller.setting.payment.index')->withSuccess('Payment Method Add successfully.');
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

    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'status' => 'required',
        ]);

        $status = '';
        if ($request->status == '1') :
            $status = '0';
        elseif ($request->status == '0') :
            $status = '1';
        endif;

        try{
            $updateArr = [
                'visibility' => $status,
                'updated_at' => date('Y-m-d h:i:s')
            ];

            $data = ResellerPaymentMethodsSetting::find($request->id);
            $data->update($updateArr);

            return response()->json(['status' => 1, 'message' => 'Payment status updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function editPaymentMethod(Request $request)
    {
        $reseller_payment_method = ResellerPaymentMethodsSetting::where(['reseller_id' => Auth::user()->id, 'id' => $request->id])->get();
        $payment_parameters = ResellerPaymentMethodsParameter::where(['reseller_id' => Auth::user()->id, 'global_payment_methods_id' => $reseller_payment_method[0]->global_payment_method_id])->orderBy('id', 'asc')->get();
        $reseller_payment_method[0]['parameters'] = $payment_parameters;
        return $reseller_payment_method;
    }

    public function updatePaymentMethod(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'global_methods_id' => 'required|integer',
            'method_name' => 'required|max:255',
            'minimum' => 'required',
            'maximum' => 'required',
            'new_users' => 'required',
        ]);

        try{

            $updatePaymentSetting = [
                'minimum' => $request->minimum,
                'maximum' => $request->maximum,
                'new_user_status' => $request->new_users,
                'updated_at' => date('Y-m-d h:i:s')
            ];

            $settingSetting = ResellerPaymentMethodsSetting::find($request->id);
            $settingSetting->update($updatePaymentSetting);

            if (!empty($request->parameters['payment'])) :
                foreach ($request->parameters['payment'] as $payment) :
                    $updateParameters = [
                        'value' => $payment['value'],
                        'status' => '1'
                    ];
                    ResellerPaymentMethodsParameter::where(['reseller_id' => Auth::user()->id, 'global_payment_methods_id' =>$request->global_methods_id, 'key' => $payment['key']])->update($updateParameters);
                endforeach;
            endif;

            return redirect()->back()->withSuccess('Payment Setting updated successfully.');
         } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
         }
    }

    private function paymentParameters($global_payment_id)
    {
        $check_parameters = ResellerPaymentMethodsParameter::where(['reseller_id' => Auth::user()->id, 'global_payment_methods_id' => $global_payment_id])->get()->count();
        if ($check_parameters == 0) :
            $get_global_payment_data = GlobalPaymentMethod::where(['id' => $global_payment_id])->get();
            if (!empty($get_global_payment_data)) :
                $fields = (array)json_decode($get_global_payment_data[0]->fields);
                if  (count($fields) > 0) :
                    foreach ($fields as $key => $value) :
                        ResellerPaymentMethodsParameter::create([
                            'reseller_id'=> Auth::user()->id,
                            'global_payment_methods_id'=> $global_payment_id,
                            'form_label' => $value,
                            'key'=> $key,
                            'created_at' => date('Y-m-d h:i:s'),
                        ]);
                    endforeach;
                endif;
            endif;
        endif;
    }

    public function sortArrUpdate(Request $request)
    {
        $request->validate([
            'sortArr' => 'required'
        ]);

        try{
            if (!empty($request->sortArr)) :
                $count = 1;
                foreach ($request->sortArr as $key => $id) :
                    $updateArr = [
                        'sort' => $count
                    ];

                    $data = ResellerPaymentMethodsSetting::find($id);
                    $data->update($updateArr);
                    $count++;
                endforeach;
            endif;
            return response()->json(['status' => 1, 'message' => 'sort updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
