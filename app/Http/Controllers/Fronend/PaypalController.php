<?php

namespace App\Http\Controllers\fronend;

use App\PaymentLog;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\ResellerPaymentMethodsSetting;
use Illuminate\Support\Facades\Session;
use App\ResellerPaymentMethodsParameter;
use Illuminate\Support\Facades\Validator;

class PaypalController extends Controller
{
      // Paypal payment id in table `payment_methods`
      private $payment_method_id = 1;
      private $paypal_email;
      private $paypal_mode = '';
      const PAYPAL_URL = "https://www.paypal.com/cgi-bin/webscr?";
      const PAYPAL_SANDBOX_URL = "https://www.sandbox.paypal.com/cgi-bin/webscr?test_ipn=1&";
      const PAYPAL_IPN_URL = 'https://ipnpb.paypal.com/cgi-bin/webscr';
      const PAYPAL_SANDBOX_IPN_URL = 'https://ipnpb.sandbox.paypal.com/cgi-bin/webscr';

    

      public function showForm(Request $request)
      {
         //PaymentMethod::where(['config_key' => 'paypal_mode'])->first()->config_value;
          // check if payment method is not enabled then abort
          /* $paymentMethod = PaymentMethod::where(['id' => $this->payment_method_id, 'status' => 'ACTIVE'])->first();
          if (is_null($paymentMethod)) {
              abort(403);
          } */
  
          // User have assigned payment methods?
          /* if (empty(Auth::user()->enabled_payment_methods)) {
              abort(403);
          } */
          // Get users enabled payment methods & see if this method is enabled for him.
          /* $enabled_payment_methods = explode(',', Auth::user()->enabled_payment_methods);
          if (!in_array($this->payment_method_id, $enabled_payment_methods)) {
              abort(403);
          } */
  
          return view('frontend.payments.paypal');
      }

      public function store(Request $request)
      {
        try {
            $this->paypal_email = ResellerPaymentMethodsParameter::where('reseller_id',auth()->user()->reseller_id)
            ->where('key', 'PAYPAL_EMAIL')->first()->value;
            $this->paypal_mode  = 'live';
            $settings = ResellerPaymentMethodsSetting::where('reseller_id', auth()->user()->reseller_id)->first();
            
            if ($settings == null)
            {
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
      
              $paymentLogSecret = bcrypt(Auth::user()->email . 'PayPal' . time() . rand(1, 90000));
    
              // Create payment logs
              /* PaymentLog::create([
                  'user_id' => Auth::user()->id
              ]); */

              
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
                'reseller_payment_methods_setting_id' =>  $this->payment_method_id,
                'reseller_id' => 1,
                ]);
      
              $params = [
                  'cmd' => '_xclick',
                  'business' => $this->paypal_email,
                  'no_note' => 1,
                  'item_name' => 'Add Funds',
                  'item_number' => '160',
                  'amount' => $request->input('amount'),
                  'currency_code' => 'USD', 
                  'charset' => 'utf-8',
                  'return' => url('/payment/add-funds/paypal/success'),
                  'cancel_return' => url('/payment/add-funds/paypal/cancel'),
                  'notify_url' => url('/payment/add-funds/paypal/status'),
                  'no_shipping' => 1,
                  'quantity' => 1,
                  'custom' => $paymentLogSecret,
              ];
    
              $url = self::PAYPAL_URL;
              if (strtolower($this->paypal_mode) == 'sandbox') {
                  $url = self::PAYPAL_SANDBOX_URL;
              }
              $url .= http_build_query($params);
              return redirect()->away($url);
        } catch (\Exception $e) {
            
            dd($e->getMessage());
        }

         

      }

      public function ipn(Request $request)
      {
          // Get rawp POST data from php://input
          $rawPostedData = $request->getContent();
          $rawPostedDataArray = explode('&', $rawPostedData);

          // Decode all url parameters and store in $myPost
          $myPost = [];
          foreach ($rawPostedDataArray as $keyval) {
              $keyval = explode('=', $keyval);
              if (count($keyval) == 2) {
                  // Since we do not want the plus in the datetime string to be encoded to a space, we manually encode it.
                  if ($keyval[0] === 'payment_date') {
                      if (substr_count($keyval[1], '+') === 1) {
                          $keyval[1] = str_replace('+', '%2B', $keyval[1]);
                      }
                  }
                  $myPost[$keyval[0]] = urldecode($keyval[1]);
              }
          }

          $client = new Client();

          try {

              $params = ['cmd' => '_notify-validate'];

              // Create request params to send to paypal
              foreach ($myPost as $key => $value) {
                  $params[$key] = $value;
              }

              $url = self::PAYPAL_IPN_URL;
              if (strtolower($this->paypal_mode) == 'sandbox') {
                  $url = self::PAYPAL_SANDBOX_IPN_URL;
              }

              $res = $client->request('POST', $url, [
                  'form_params' => $params
              ]);

              if ($res->getStatusCode() === 200) {
                  $resp = $res->getBody()->getContents();
                  if ($resp == 'VERIFIED') {

                      // custom data missing
                      if (empty($myPost['custom'])) {
                          activity('paypal')
                              ->withProperties(['ip' => $request->ip()])
                              ->log('Missing custom data from POST.');
                          die();
                      }

                      // Get paymentLog where details = $custom
                      $custom = $myPost['custom'];
                      //$paymentLog = PaymentLog::where(['details' => $custom])->first();
                      $paymentLog = Transaction::where(['transaction_detail' => $custom])->first();
                      if (is_null($paymentLog)) {
                          activity('paypal')
                              ->withProperties(['ip' => $request->ip()])
                              ->log('Payment Log not found. details: ' . $custom);
                          die();
                      }

                      // Check amount against order total
                      if ($myPost['mc_gross'] != $paymentLog->total_amount) {
                          activity('paypal')
                              ->withProperties([
                                  'ip' => $request->ip()
                              ])->log('Amount is less than order total! mc_gross:' . $myPost['mc_gross']);
                          die();
                      }

                      // Check currency match
                      if (strcasecmp(trim(strtoupper($myPost['mc_currency'])), trim(getOption('currency_code'))) != 0) {
                          activity('paypal')
                              ->withProperties([
                                  'ip' => $request->ip()
                              ])->log('Currency mismatch. mc_currency:' . $myPost['mc_currency']);
                          die();
                      }

                      // Check PayPal emails is same added by admin in panel
                      if (strcasecmp(trim($this->paypal_email), trim($myPost['receiver_email'])) != 0) {
                          activity('paypal')
                              ->withProperties([
                                  'ip' => $request->ip()
                              ])->log('IPN Response is not for paypal email in added in panel. receiver_email:' . $myPost['receiver_email']);
                          die();
                      }

                      // Check for a valid transaction types.
                      $accepted_types = array('cart', 'instant', 'express_checkout', 'web_accept', 'masspay', 'send_money', 'paypal_here');
                      if (!in_array(strtolower($myPost['txn_type']), $accepted_types)) {
                          activity('paypal')
                              ->withProperties([
                                  'ip' => $request->ip()
                              ])->log('Invalid transaction type. txn_type:' . $myPost['txn_type']);
                          die();
                      }

                      // Check payment status, if not sandbox then it should be 'complete' for processing.
                      if (strtolower($this->paypal_mode) != 'sandbox') {
                          if (strtolower($myPost['payment_status']) != 'completed') {
                              activity('paypal')
                                  ->withProperties([
                                      'ip' => $request->ip()
                                  ])->log('Payment status not complete. Status is : ' . $myPost['payment_status']);
                              die();
                          }
                      }

                      // Amount after fees deduction
                      $amount_after_fee = $myPost['mc_gross'] - $myPost['mc_fee'];

                      $transaction = [
                          'amount' => $amount_after_fee,
                          'payment_method_id' => $this->payment_method_id,
                          'user_id' => $paymentLog->user_id,
                          'details' => "txn_id: " . $myPost['txn_id']
                      ];
                      $user = User::find($paymentLog->user_id);

                      transaction($transaction, $user);

                      /**
                       * NOTE:
                       * not checking txn_id for next time process, because if once proceed $custom variable will not be able to
                       * fetch from payment_log table and next ipn hit will be ignored by logic
                       */

                      // Payment successful, load fund and update payment log
                      /* Transaction::where(['details' => $custom])->update([
                          'details' => json_encode($myPost),
                      ]); */
                      Transaction::where(['transaction_detail' => $custom])->update([
                        'transaction_detail' => json_encode($myPost),
                        ]);

                      activity('paypal')
                          ->withProperties([
                              'ip' => $request->ip()
                          ])->log('Payment Successful for user_id:' . $paymentLog->user_id . ' amount:' . $amount_after_fee);

                  } else {
                      activity('paypal')
                          ->withProperties([
                              'ip' => $request->ip()
                          ])->log("IPN Unverified, responses status code:".$res->getStatusCode());
                      die();
                  }

              } else {
                  activity('paypal')
                      ->withProperties([
                          'ip' => $request->ip()
                      ])->log('Invalid response from paypal. response code: ' . $res->getStatusCode());
                  die();
              }

          } catch (ClientException $e) {
              activity('paypal')
                  ->withProperties([
                      'ip' => $request->ip()
                  ])->log('Issue in sending data back to paypal.');
              die();
          }
      }

      public function success(Request $request)
      {
          Session::flash('alert', __('messages.payment_success'));
          Session::flash('alertClass', 'success');
          return redirect('/thank-you');
      }

      public function cancel(Request $request)
      {
          Session::flash('alert', __('messages.payment_failed'));
          Session::flash('alertClass', 'danger no-auto-close');
          return redirect('/payment/add-funds/paypal');
      }
}
