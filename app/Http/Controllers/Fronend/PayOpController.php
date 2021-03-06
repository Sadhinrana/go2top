<?php

namespace App\Http\Controllers\Fronend;

use App\PaymentLog;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\ResellerPaymentMethodsSetting;
use App\ResellerPaymentMethodsParameter;
use Illuminate\Support\Facades\Validator;

class PayOpController extends Controller
{
    /*
     * Create a PayOp invoice.
     *
     * @param Request $request
     * @return redirect response
     */
    public function store(Request $request)
    {
        try {
            $settings = ResellerPaymentMethodsSetting::where('reseller_id', auth()->user()->reseller_id)->where('global_payment_method_id', 2)->first();
            $public_key  = ResellerPaymentMethodsParameter::where('global_payment_methods_id', 2)->where('key','PAYOP_PUBLIC_KEY')->where('status', '1')->first()->value;
            $secret_key  = ResellerPaymentMethodsParameter::where('global_payment_methods_id', 2)->where('key','PAYOP_SECRET_KEY')->where('status', '1')->first()->value;
           // dd($public_key,$secret_key);
            
                if ($settings == null)
                {
                    return redirect()->back()->withErrors(['error' => 'No setting found, contact your reseller']);
                }
                else if ($public_key == '' || $public_key == null) {
                    return redirect()->back()->withErrors(['error' => 'No setting found, contact your reseller']);
                }
                else if ($secret_key == '' || $secret_key == null) {
                    return redirect()->back()->withErrors(['error' => 'No setting found, contact your reseller']);
                }
                $min_amount = $settings->minimum;
                    $validator = Validator::make($request->all(), [
                        'amount' => 'required|numeric|min:' . $min_amount,
                    ]);
            
                if ($validator->fails()) {
                    return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
                }

                $paymentLogSecret = bcrypt(Auth::user()->email . 'PayOp' . time() . rand(1, 90000));

                // Create payment logs
               // $log = PaymentLog::create([]);

                $log = Transaction::create([
                    'transaction_type' => 'deposit',
                    'transaction_detail' => json_encode(['payment_secrete'=>  $paymentLogSecret, 'currency_code'=> 'USD']),
                    'amount' => $request->input('amount'),
                    'transaction_flag' => 'payment_gateway',
                    'user_id' =>  Auth::user()->id,
                    'admin_id' => null,
                    'status' => 'hold',
                    'memo' => null,
                    'fraud_risk' => null,
                    'payment_gateway_response' => null,
                    'reseller_payment_methods_setting_id' => 2,
                    'reseller_id' => 1,
                    ]);

                $order = ['id' => $log->id, 'amount' => $request->input('amount'), 'currency' => 'USD'];
                ksort($order, SORT_STRING);
                $dataSet = array_values($order);
                $dataSet[] = $secret_key;//'cdd39154b3c095345c3b57ef'; //env('PAYOP_SECRET_KEY');
                $signature = hash('sha256', implode(':', $dataSet));

                $data = json_encode(array(
                    'publicKey' => $public_key,//'application-4eabf98b-3da3-424b-a695-c3a9f2623c2a',//env('PAYOP_PUBLIC_KEY'),
                    'order' => array(
                        'id' => $log->id,
                        'amount' => $request->input('amount'),
                        'currency' => 'USD',
                        'items' => [
                            array(
                                'id' => 1111,
                                'name' => 'Add Fund',
                                'price' => $request->input('amount'),
                            ),
                        ],
                        'description' => 'Balance Recharge'
                    ),
                    'signature' => $signature,
                    'payer' => array(
                        'email' => Auth::user()->email,
                        "phone" => "",
                        "name" => "",
                        "extraFields" => array()
                    ),
                    'paymentMethod' => 381,
                    'language' => 'en',
                    "resultUrl" => url('thank-you'),
                    "failPath" => url('add-funds')
                ));
               // dd($data);

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, 'https://payop.com/v1/invoices/create');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_VERBOSE, 1);
                curl_setopt($ch, CURLOPT_HEADER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

                $headers = array();
                $headers[] = 'Content-Type: application/json';
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                $result = curl_exec($ch);
                if (curl_errno($ch)) {
                    echo 'Error:' . curl_error($ch);
                }
                curl_close($ch);

                list($header, $body) = explode("\r\n\r\n", $result, 2);
                $header = explode("\r\n", $header);
                $body = json_decode($body, 1);
                if ($header[0] == 'HTTP/1.1 200 OK') {
                    $identifierData = explode(': ', $header[8]);
                    return redirect()->away('https://payop.com/en/payment/invoice-preprocessing/' . $identifierData[1]);
                } else {
                    return redirect()->back()->with(['alert' => 'Whoops! Something went wrong! Please try again or contact support' . '<br>Technical info: ' . $body['message'], 'alertClass' => 'danger no-auto-close']);
                }

        } 
        catch (\Exception $e) {
            dd($e->getMessage());
        }
        
    }

    /*
     * Show success page.
     *
     * @param Request $request
     * @return view
     */
    public function success(Request $request)
    {
        if ($request->query('skey') && $request->query('tranID')) {
            return redirect('/thank-you')->with(['alert' => __('messages.payment_success'), 'alertClass' => 'success']);
        } else {
            abort(404);
        }
    }

    /*
     * Show fail page.
     *
     * @param Request $request
     * @return view
     */
    public function fail(Request $request)
    {
        if ($request->query('skey') && $request->query('tranID')) {
            return redirect('/addfunds')->with(['alert' => __('messages.payment_failed'), 'alertClass' => 'danger no-auto-close']);
        } else {
            abort(404);
        }
    }

    /*
     * PayOp IPN.
     *
     * @param Request $request
     * @return void
     */
    public function payopcallback(Request $request)
    {
        $data = $request->all();
        if (!isset($data['transaction'])) {
            abort(404);
        }
        Log::info($request);

        if (Storage::disk('local')->exists('paymentLog.txt')) {
            Storage::disk('local')->append('paymentLog.txt', $request);
        } else {
            Storage::disk('local')->put('paymentLog.txt', $request);
        }

        $paymentLog = PaymentLog::find($data['transaction']['order']['id']);
        $user = User::find($paymentLog->user_id);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://payop.com/v1/transactions/'.$data['invoice']['txid']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: Bearer '.env('PAYOP_JWT_TOKEN');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        Log::info($result);

        Storage::disk('local')->append('paymentLog.txt', $result);

        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }

        curl_close($ch);

        $result = json_decode($result, 1);

        if ($result['data']['state'] == 2 && $result['data']['error'] == '') {
            $transaction = [
                'amount' => $paymentLog->total_amount,
                'payment_method_id' => $paymentLog->payment_method_id,
                'details' => $data['transaction']['id'],
                'user_id' => $paymentLog->user_id,
            ];

            transaction($transaction, $user);
        }
    }
}
