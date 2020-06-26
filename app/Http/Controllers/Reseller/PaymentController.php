<?php

namespace App\Http\Controllers\Reseller;

use App\User;
use App\Payment;
use App\Transaction;
use App\ExportedPayment;
use Illuminate\Http\Request;
use App\Exports\PaymentsExport;
use Spatie\ArrayToXml\ArrayToXml;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $input = request()->all();
        $input['keyword'] = isset($input['keyword']) ? $input['keyword'] : '';
        $sort_by = isset($input['sort_by']) ? $input['sort_by'] : 'id';
        $order_by = isset($input['order_by']) ? $input['order_by'] : 'desc';

        $payments = auth()->guard('reseller')->user()->payments()->where(function ($q) use ($input) {
            if ($input['keyword']) {
                $q->where('id', 'like', '%' . $input['keyword'] . '%')
                    ->orWhereHas('user', function($q) use ($input){
                        $q->where('name', 'like', '%' . $input['keyword'] . '%')
                            ->orWhere('balance', 'like', '%' . $input['keyword'] . '%');
                    })
                    ->orWhere('amount', 'like', '%' . $input['keyword'] . '%')
                    ->orWhere('status', 'like', '%' . $input['keyword'] . '%')
                    ->orWhere('fraud_risk', 'like', '%' . $input['keyword'] . '%')
                    ->orWhere('memo', 'like', '%' . $input['keyword'] . '%')
                    ->orWhere('created_at', 'like', '%' . $input['keyword'] . '%')
                    ->orWhere('updated_at', 'like', '%' . $input['keyword'] . '%');
            }
        })->where(function ($q) use ($input) {
            if (isset($input['columns']) && is_array($input['columns'])) {
                foreach ($input['columns'] as $index => $value) {
                    $q->where($index, $value);
                }
            }
        })
        ->where('transaction_flag', 'admin_panel')
        ->orderBy($sort_by, $order_by)
            ->paginate(100);

        return view('reseller.payment.index', compact('payments'));
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
            'user_id' => 'required|integer|exists:users,id',
            'reseller_payment_methods_setting_id' => 'required|integer|exists:reseller_payment_methods_settings,id',
            'amount' => 'required|numeric',
            'memo' => 'required|string|max:255',
        ]);

        try {
            $data = $request->except('_token');
            $data['reseller_id'] = auth()->guard('reseller')->id();
            $data['mode'] = 'manual';
            Transaction::create([
                'transaction_type' => 'deposit',
                'amount' => $request->amount,
                'transaction_flag' => 'admin_panel',
                'user_id' => $request->user_id,
                'admin_id' => auth()->guard('reseller')->id(),
                'status' => 'done',
                'memo' => $request->memo,
                'fraud_risk' => null,
                'payment_gateway_response' => null,
                'reseller_payment_methods_setting_id' => $request->reseller_payment_methods_setting_id,
                'reseller_id' => auth()->guard('reseller')->id(),
            ]);

            $user = User::find($request->user_id);
            $user->balance += $request->amount;
            $user->save();

            return redirect()->back()->withSuccess('Payment created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Transaction $payment)
    {
        return response()->json(['status' => 200, 'data' => $payment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Transaction $payment)
    {
        // Validate form data
        $request->validate([
            'memo' => 'required|string|max:255',
            'reseller_payment_methods_setting_id' => 'required|integer|exists:reseller_payment_methods_settings,id',
        ]);

        try {
            $payment->update($request->only('memo', 'reseller_payment_methods_setting_id'));
            return redirect()->back()->withSuccess('Payment updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function export()
    {
        return view('reseller.payment.export');
    }

    /**
     * Export payments.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function exportPayment(Request $request)
    {
        // Validate form data
        $request->validate([
            'from' => 'required|date',
            'to' => 'required|date|after_or_equal:from',
            'user_ids' => 'required|array',
            'payment_method_ids' => 'required|array',
            'user_ids.*' => 'required',
            'payment_method_ids.*' => 'required',
            'status' => 'required|array|in:all,pending,waiting,hold,completed,failed,expired',
            'mode' => 'required|in:all,auto,manual',
            'format' => 'required|in:xml,json,csv',
            'include_columns' => 'required|array|in:id,user_username,user_balance,amount,payment_method_name,status,memo,completed,created_at,ip_address,mode',
        ]);

        try {
            $data = $request->except('_token');
            $data['include_columns'] = serialize($request->include_columns);
            $data['user_ids'] = serialize($request->user_ids);
            $data['payment_method_ids'] = serialize($request->payment_method_ids);
            $data['status'] = serialize($request->status);
            $data['reseller_id'] = auth()->guard('reseller')->id();

            ExportedPayment::create($data);

            return redirect()->back()->withSuccess('Payment exported successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Download exported payments.
     *
     * @param \App\ExportedPayment $exportedPayment
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadExportedPayment(ExportedPayment $exportedPayment)
    {
        try {
            $columns = unserialize($exportedPayment->include_columns);
            $include_columns = [];

            foreach ($columns as $value) {
                if ($value != 'user_username' && $value != 'user_balance' && $value != 'payment_method_name') {
                    $include_columns[] = 'payments.' . $value;
                } elseif ($value == 'payment_method_name') {
                    $include_columns[] = 'reseller_payment_methods_settings.method_name';
                } else {
                    $include_columns[] = 'users.' . explode('user_', $value, 2)[1] . ' AS ' . $value;
                }
            }

            $payments = Payment::join('users', 'users.id', '=', 'payments.user_id')
                ->join('reseller_payment_methods_settings', 'reseller_payment_methods_settings.id', '=', 'payments.reseller_payment_methods_setting_id')
                ->select($include_columns)
                ->whereBetween('payments.created_at', [$exportedPayment->from, $exportedPayment->to])
                ->where(function ($q) use ($exportedPayment) {
                    if (!in_array('all', unserialize($exportedPayment->status))) {
                        $q->whereIn('payments.status', unserialize($exportedPayment->status));
                    }
                    if ($exportedPayment->mode != 'all') {
                        $q->where('payments.mode', $exportedPayment->mode);
                    }
                    if (!in_array('all', unserialize($exportedPayment->user_ids))) {
                        $q->whereIn('users.id', unserialize($exportedPayment->user_ids));
                    }
                    if (!in_array('all', unserialize($exportedPayment->payment_method_ids))) {
                        $q->whereIn('reseller_payment_methods_settings.id', unserialize($exportedPayment->payment_method_ids));
                    }
                })
                ->get();

            if ($exportedPayment->format == 'json') {
                $filename = "public/exportedData/payments.json";
                Storage::disk('local')->put($filename, $payments->toJson(JSON_PRETTY_PRINT));
                $headers = array('Content-type' => 'application/json');

                return response()->download('storage/exportedData/payments.json', 'payments.json', $headers);
            } elseif ($exportedPayment->format == 'xml') {
                $data = ArrayToXml::convert(['__numeric' => $payments->toArray()]);
                $filename = "public/exportedData/payments.xml";
                Storage::disk('local')->put($filename, $data);
                $headers = array('Content-type' => 'application/xml');

                return response()->download('storage/exportedData/payments.xml', 'payments.xml', $headers);
            } else {
                return Excel::download(new PaymentsExport($payments, unserialize($exportedPayment->include_columns)), 'payments.xlsx');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
