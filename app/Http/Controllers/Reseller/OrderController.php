<?php

namespace App\Http\Controllers\Reseller;

use App\User;
use App\Order;
use App\Service;
use App\Provider;
use App\Transaction;
use http\Env\Response;
use App\DripFeedOrders;
use App\ProviderService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $date_time = new \DateTime();
        $la_time = new \DateTimeZone('UTC');
        date_default_timezone_set('UTC'); 
        $date_time->setTimezone($la_time);
        $orders = Order::select('orders.*', 'users.username as username', 'services.service_type as service_type')
            ->leftJoin('drip_feed_orders', function($q) {
                $q->on('drip_feed_orders.id', '=', 'orders.drip_feed_id');
            })
            ->join('users','users.id','=','orders.user_id')
            ->join('services','orders.service_id','=','services.id')
            ->where('orders.refill_status', 0)
            ->where('orders.order_viewable_time', '<=', $date_time->format('Y-m-d H:i:s'))
            ->where(function ($q) {
                if (request()->query('status') && request()->query('status') != 'all') {
                    $q->where('orders.status', strtolower(request()->query('status')));
                }

                if (request()->query('user')) {
                    $q->where('orders.user_id', request()->query('user'));
                }

                if (request()->query('services')) {
                    $q->where('orders.service_id', request()->query('services'));
                }

                if (request()->query('filter_type')) {
                    $filte_type = request()->query('filter_type');
                    $search_input = request()->query('search');
                    if ($search_input != null) {
                        if ($filte_type == 'order_id') {
                            $q->where('orders.order_id', '=', $search_input); 
                        }
                        elseif ($filte_type == 'link') {
                            $q->where('orders.link', '=', $search_input); 
                        }
                        elseif ($filte_type == 'service_id') {
                            $q->where('orders.service_id', '=', $search_input); 
                        }
                    }
                   
                }
            })
            ->orderBy('id','DESC')->get();

        $role =  'admin';
        $page_name =  'order_index';
        $users = User::get();
        $services = Service::get();

        $auto_order_statuss = [];
        foreach ($orders as $order)
        {
            
            if ($order->mode == 'auto' && $order->status != 'CANCELLED') {
                    $ps = ProviderService::where('service_id', $order->service_id)->first();
                    $provider_info = null;   
                    if ($ps != null) {
                        $provider_info = Provider::find($ps->provider_id);
                    }
                    else continue;
                    if ($order->provider_order_id!=null) 
                    {
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $provider_info->api_url);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, 
                                http_build_query(array(
                                    'key' =>$provider_info->api_key,
                                    'action' => 'status',
                                    'order' => $order->provider_order_id,
                                    )));
                        // Receive server response ...
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $server_output = curl_exec($ch);
                        curl_close ($ch);
                        $result  =  json_decode($server_output, true);
                        if (isset($result['status'])) {
                            $auto_order_statuss[$order->order_id] = $result['status'];
                        }
                    }
            }
        }
        return view('reseller.order.index', compact('orders','role', 'users', 'services', 'page_name', 'auto_order_statuss'));
    }

    public function refillChnageStatus(Request $r)
    {
        try {
            $refill_status =  Order::where([
                ['id', '=', $r->order_table_id],
                ['order_id', '=', $r->order_id],
            ])->first();
            $refill_status->refill_order_status = $r->refill_order_status;
            if ($refill_status->save()) {
                  return redirect()->back()->with('success', 'status has been changed');
            }
            else
            {
                return redirect()->back()->with('error', 'Error occured');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }
    public function refillStatusChange(Request $r)
    {
        try {
            $refill_status =  Order::where([
                ['id', '=', $r->order_table_id],
                ['order_id', '=', $r->order_id],
            ])->first();

            $order_cloned  = Order::create([
                'order_id' => $refill_status->order_id,
                'status' => 'COMPLETED',
                'charges' => $refill_status->charges,
                'link' => $refill_status->link,
                'start_counter' => $refill_status->start_counter,
                'remains' => $refill_status->remains,
                'quantity' => $refill_status->quantity,
                'user_id' => $refill_status->user_id,
                'service_id' => $refill_status->service_id,
                'category_id' => $refill_status->category_id,
                'custom_comments' => $refill_status->custom_comments,
                'mode'  => $refill_status->mode,
                'source' => $refill_status->source,
                'drip_feed_id'  => $refill_status->drip_feed_id,
                'order_viewable_time' => $refill_status->order_viewable_time,
                'text_area_1' => $refill_status->text_area_1,
                'text_area_2' => $refill_status->text_area_2,
                'additional_inputs'  => $refill_status->additional_inputs,
                'refill_status' => false,
                'refill_order_status' => 'PENDING',
                ]);

                $refill_status->refill_status =  true;
                $refill_status->refill_order_status = $r->refill_order_status;

            if ($refill_status->save()) {
                return redirect()->back()->with('success', 'Status changes');
            }
            else
            {
                return redirect()->back()->with('error', 'Could not change, error occured');
            }
        } catch (\Exception $e) {
             return redirect()->back()->with('error', $e->getMessage());
        }

    }

    public function refillOrders()
    {
        $orders = Order::select('orders.*', 'users.username as username')
        ->where('orders.user_id', Auth::guard('reseller')->user()->id??1)
        ->where('refill_status', 0)
            ->leftJoin('drip_feed_orders', function($q) {
                $q->on( 'drip_feed_orders.id', '=', 'orders.drip_feed_id');
                $q->where('orders.order_viewable_time','<=', (new \DateTime())->format('Y-m-d H:i:s'));
            })
            ->join('users','users.id','=','orders.user_id')
            ->where(function ($q) {
                if (request()->query('status') && request()->query('status') != 'all') {
                    $q->where('orders.refill_order_status', request()->query('status'));
                }

                if (request()->query('user')) {
                    $q->where('orders.user_id', request()->query('user'));
                }

                if (request()->query('services')) {
                    $q->where('orders.service_id', request()->query('services'));
                }
            })->orderBy('id','DESC')->get();
        $role =  'admin';
        $page_name =  'tasks';
        $users = User::get();
        $services = Service::get();
        return view('reseller.order.refill_orders', compact('orders','role', 'users', 'services', 'page_name'));
    }

    public function dripFeed(Request $r)
    {
        $date = (new \DateTime())->format('Y-m-d H:i:s');
        $d_feeds = DripFeedOrders::select('drip_feed_orders.*','users.username as user_name', 'A.service_name', 'A.orders_link','A.service_quantity as service_quantity', 'A.totalOrders as totalOrders', 'B.runOrders as runOrders')
            ->join('users','users.id','=','drip_feed_orders.user_id')
            ->join(\DB::raw('(SELECT COUNT(orders.drip_feed_id) AS totalOrders, orders.drip_feed_id, GROUP_CONCAT(DISTINCT(orders.link)) AS orders_link,
            GROUP_CONCAT(DISTINCT(services.name)) AS service_name, GROUP_CONCAT(DISTINCT(orders.quantity)) AS service_quantity FROM orders INNER JOIN services
            ON services.id = orders.service_id GROUP BY orders.drip_feed_id) as A'), 'drip_feed_orders.id', '=', 'A.drip_feed_id')
            ->leftJoin(\DB::raw("(SELECT drip_feed_id, COUNT(drip_feed_id) AS runOrders FROM orders
            WHERE order_viewable_time <='".$date."' GROUP BY drip_feed_id) AS B"), 'drip_feed_orders.id', '=', 'B.drip_feed_id');

        if (isset($r->status))
        {
            if($r->status != 'all')
            $d_feeds->where('drip_feed_orders.status',$r->status);
        }

        $drip_feeds = $d_feeds->get();
        //dd($drip_feeds);

        return view('reseller.order.drip_feed', compact('drip_feeds'));
    }

    public function orderLists(Request $r)
    {
        $input = $r->all();
        $order = Order::where('user_id', auth()->user()->id)->where('refill_status', 0);
        if(isset($input['query']))
        {
            $orders =  $order->where('status', $input['query'])->orderBy('id', 'DESC')->get();
        }
        else
        {
            $orders = $order->orderBy('id', 'DESC')->get();
        }
        $role =  'user';
        $page_name =  'orders';

        $auto_order_statuss = [];
        foreach ($orders as $order)
        {
            
            if ($order->mode == 'auto' && $order->status != 'cancelled') {
                    $ps = ProviderService::where('service_id', $order->service_id)->first();
                    $provider_info = null;   
                    if ($ps != null) {
                        $provider_info = Provider::find($ps->provider_id);
                    }
                    else continue;
                    if ($order->provider_order_id!=null) 
                    {
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $provider_info->api_url);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, 
                                http_build_query(array(
                                    'key' =>$provider_info->api_key,
                                    'action' => 'status',
                                    'order' => $order->provider_order_id,
                                    )));
                        // Receive server response ...
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $server_output = curl_exec($ch);
                        curl_close ($ch);
                        $result  =  json_decode($server_output, true);
                        if (isset($result['status'])) {
                            $auto_order_statuss[$order->order_id] = $result['status'];
                        }
                    }
            }
        }
        return view('frontend.orders.order_lists',compact('orders','role','page_name', 'auto_order_statuss'));
    }


    public function updateDripOrder(Request $r, $id)
    {
        try {
            $data = $r->all();
            $order = DripFeedOrders::find($id)->update($data);
            if($order)
                return response()->json(['status'=>200, 'success'=>'successfully updated']);
            else return response()->json(['status'=>401, 'error'=>'Could not updated']);
        }catch (\Exception $e)
        {
            return response()->json(['status'=>500, 'error'=>$e->getMessage()]);
        }
    }
    public function updateOrder(Request $r, $id)
    {
        try {
            $data = $r->all();
            $order = Order::find($id);
            if (isset($data['status']) && $data['status'] == 'cancel_refund') {
                    $user = User::find($order->user_id); 
                    $user->balance = $user->balance + $order->charges;
                    $user->save();
                    Transaction::create([
                        'transaction_type' => 'deposit',
                        'amount' => $order->charges,
                        'transaction_flag' => 'refund',
                        'user_id' =>  $order->user_id,
                        'admin_id' => auth()->user()->id,
                        'status' => 'done',
                        'memo' => null,
                        'fraud_risk' => null,
                        'transaction_detail' => json_encode(['order_id'=> $order->id, 'quantity_history'=> [$order->quantity]]),
                        'payment_gateway_response' => null,
                        'reseller_payment_methods_setting_id' =>  null,
                        'reseller_id' => 1,
                        ]);
                        $order->status = 'cancelled';
                        $order->save();
            }
            elseif (isset($data['partial']) && !empty($data['partial'])) {

                $current_b = $order->charges;
                $now_b = $data['partial'] * ($order->unit_price / 1000);
                $updateable_balance =  $current_b - $now_b;

                $user = User::find($order->user_id); 
                    $user->balance = $user->balance + $updateable_balance;
                    $user->save();
                Transaction::create([
                'transaction_type' => 'deposit',
                'amount' => $updateable_balance,
                'transaction_flag' => 'refund',
                'user_id' =>  $order->user_id,
                'admin_id' => auth()->user()->id,
                'status' => 'done',
                'memo' => null,
                'fraud_risk' => null,
                'transaction_detail' => json_encode(['order_id'=> $order->id, 'quantity_history'=> [$order->quantity]]),
                'payment_gateway_response' => null,
                'reseller_payment_methods_setting_id' =>  null,
                'reseller_id' => 1,
                ]);
                $order->update([
                    'quantity' => $data['partial'],
                    'status'   => 'partial',
                    'charges'  => $now_b,
                ]);
            }
            else
            {
                $order->update($data);
            }
            if($order)
                return response()->json(['status'=>200, 'success'=>'successfully updated']);
            else return response()->json(['status'=>401, 'error'=>'Could not updated']);
        }catch (\Exception $e)
        {
            return response()->json(['status'=>500, 'error'=>$e->getMessage()]);
        }
    }

    public function bulkStatusChange(Request $r)
    {
        if ($r->status == 'cancel_refund') {
            $orders = Order::whereIn('id',explode(',',$r->service_ids))->get();
            foreach ($orders as $order) {
                 if ($order->mode == 'manual') {
                    $user = User::find($order->user_id); 
                    $user->balance = $user->balance + $order->charges;
                    $user->save();
                    Transaction::create([
                        'transaction_type' => 'deposit',
                        'amount' => $order->charges,
                        'transaction_flag' => 'refund',
                        'user_id' =>  $order->user_id,
                        'admin_id' => auth()->user()->id,
                        'status' => 'done',
                        'memo' => null,
                        'fraud_risk' => null,
                        'transaction_detail' => json_encode(['order_id'=> $order->id, 'quantity_history'=> [$order->quantity]]),
                        'payment_gateway_response' => null,
                        'reseller_payment_methods_setting_id' =>  null,
                        'reseller_id' => 1,
                        ]);
                        $order->status = 'cancelled';
                        $order->save();
                 }
            }
        }
        else
        {
            Order::whereIn('id',explode(',',$r->service_ids))->update([
                'status' => $r->status
            ]);
        }
      
            return response()->json(['status'=>200,'message'=>'successfully status changed']);

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


    public function storeMassOrder(Request $r)
    {
        try {
            $data = $r->all();
            $validate = Validator::make($data, [
                'content' => 'required',
            ]);
            if ($validate->fails()) {
                return redirect()->back()
                    ->withErrors($validate)
                    ->withInput();
            }
            $each_line = preg_split("/\r\n|\n|\r/", $data['content']);
            $orders = [];
            $total_amount = 0;
            foreach ($each_line as $line) {

                $input_line = explode('|', $line);
                if (count($input_line) != 3) return redirect()->back()->with('error', 'Please follow the instruction for filling up the form')->withInput();
                $ser = Service::find($input_line[0]);
                if ($ser==null) {
                     return redirect()->back()->with('error', 'No service found with this ID'. $input_line[0]);
                }
                /* sdfsd */
                $order_status = 'pending';
                $provider_id = null;
                $original_unit_price = 0;
                $original_charges = 0;
                $auto_order_response = null;
                if ($ser->mode == 'auto') {
                    $ps = ProviderService::where('service_id', $ser->id)->first();
                    $provider_info = null;   
                    if ($ps != null) {
                        $provider_info = Provider::find($ps->provider_id);
                    }
                    if ($provider_info == null) {
                        $order_status =  "cancelled";
                        $original_unit_price = $ps->rate;
                        $auto_order_response  =  json_encode(['error'=> 'provider not found, provider_id '.$ps->provider_id]);
                        $original_charges = ($ps->rate / 1000) *  $input_line[1];
                    }
                    else
                    {
                        $original_unit_price = $ps->rate;
                        $original_charges = ($ps->rate / 1000) *  $input_line[1];
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $provider_info->api_url);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, 
                                http_build_query(array(
                                    'key' => $provider_info->api_key,
                                    'action' => 'add',
                                    'service' => $ps->provider_service_id,
                                    'link' => $input_line[2],
                                    'quantity' => $input_line[1],
                                    )));
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $server_output = curl_exec($ch);
                        curl_close ($ch);
                        $result  =  json_decode($server_output, true);
                        $auto_order_response = json_encode($result);
                        if (isset($result['order'])) {
                            $provider_id = $result['order'];
                        }
                        else
                        {
                            $order_status =  "failed";
                        }                     
                    }
                }
                /* asdfasdf */
                $total_amount += $ser->price / 1000 * $input_line[1];
                $orders[] = [
                    'order_id' => rand(0, round(microtime(true))),
                    'status' => $order_status,
                    'charges' => ($ser->price / 1000) *  $input_line[1],
                    'unit_price' => $ser->price,
                    'original_charges' => $original_charges,
                    'original_unit_price' => $original_unit_price,
                    'provider_order_id' => $provider_id,
                    'link' => $input_line[2],
                    'quantity' => $input_line[1],
                    'user_id' => auth()->user()->id,
                    'category_id' => $ser->category_id,
                    'service_id' => $input_line[0],
                    'created_at' => now(),
                    'order_viewable_time' => now(),
                    'auto_order_response' => $auto_order_response,
                    'mode' =>  $ser->mode,
                ];
            }
            if (auth()->user()->balance() < $total_amount) {
                return redirect()->back()->with('error', 'You do not have sufficient Balance');
            }
            if (Order::insert($orders))
            {
                $update_balance = auth()->user()->balance() - $total_amount;
                User::where('id', auth()->user()->id)->update(['balance'=> $update_balance ]);
                $log = Transaction::create([
                    'transaction_type' => 'withdraw',
                    'amount' => $total_amount,
                    'transaction_flag' => 'order_place',
                    'user_id' =>  auth()->user()->id,
                    'admin_id' => null,
                    'status' => 'done',
                    'memo' => null,
                    'fraud_risk' => null,
                    'payment_gateway_response' => null,
                    'reseller_payment_methods_setting_id' =>  null,
                    'reseller_id' => 1,
                    ]);
                return redirect()->back()->with('success', 'Successfully saved');
            }
            else return redirect()->back()->with('error', 'Please make sure you are following correct format.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $data = $request->all();
            //dd($data);
            if (isset($data['drip_feed']) && $data['drip_feed']=='on')
            {
                $validate = Validator::make($data, [
                    'category_id' => 'required',
                    'service_id' => 'required',
                    'quantity' => 'required|numeric',
                    'runs' => 'required|numeric',
                    'interval' => 'required|numeric',
                    'link' => 'required',
                ]);
            }
            else
            {
                $validate = Validator::make($data, [
                    'category_id' => 'required',
                    'service_id' => 'required',
                    'quantity' => 'required|numeric',
                    'link' => 'required',
                ]);
            }

            if ($validate->fails()) {
                return redirect()->back()
                    ->withErrors($validate)
                    ->withInput();
            }

            if (auth()->user()->balance() < $data['charge']) {
                return redirect()->back()->with('error', 'You do not have sufficient Balance');
            }

            $service = Service::find($data['service_id']);
            if ($service != null) {
                if ($data['quantity'] < $service->min_quantity ||  $data['quantity'] >  $service->max_quantity) {
                    return redirect()->back()->with('error', 'Quantity Limit exceeds min = '.$service->min_quantity.' max = '.$service->max_quantity);
                }
            }

            if (isset($data['drip_feed']) && $data['drip_feed']=='on')
            {
                 $drip_feed = DripFeedOrders::create([
                     'user_id' => auth()->user()->id,
                     'runs'  => $data['runs'],
                     'interval'=> $data['interval'],
                     'total_quantity'=> $data['total_quantity'],
                     'total_charges'=> $data['charge'],
                 ]);

                 if ($drip_feed)
                 {
                     $drip_feed_data = [];

                     for ($i=0; $i<$data['runs']; $i++)
                     {
                         $date = new \DateTime();
                         $date->add(new \DateInterval("PT".$i * $data['interval']."M"));

                         $drip_feed_data[]= [
                             'order_id' => rand(0, round(microtime(true))),
                             'charges' => $data['charge'],
                             'link' => $data['link'],
                             'quantity' => $data['quantity'],
                             'user_id' => auth()->user()->id,
                             'service_id' => $data['service_id'],
                             'category_id' => $data['category_id'],
                             'drip_feed_id' => $drip_feed->id,
                             'order_viewable_time' => $date->format('Y-m-d H:i:s'),
                             'created_at' => date('Y-m-d H:i:s'),
                             'mode' => $data['service_mode'],
                             'text_area_1' => $data['text_area_1'] ?? null,
                             'text_area_2' => $data['text_area_2'] ?? null,
                             'additional_inputs' => $data['additional_inputs'] ?? null,
                         ];
                     }
                     $make_order =  Order::insert($drip_feed_data);
                     if ($make_order) {
                          User::where('id', auth()->user()->id)->update(['balance'=> auth()->user()->balance() - $data['charge'] ]);
                          $log = Transaction::create([
                            'transaction_type' => 'withdraw',
                            'amount' => $data['charge'],
                            'transaction_flag' => 'order_place',
                            'user_id' =>  auth()->user()->id,
                            'admin_id' => null,
                            'status' => 'done',
                            'memo' => null,
                            'fraud_risk' => null,
                            'payment_gateway_response' => null,
                            'reseller_payment_methods_setting_id' =>  null,
                            'reseller_id' => 1,
                            ]);
                     }
                 }

            }
            else
            {
                $make_order = Order::create([
                    'order_id' => rand(0, round(microtime(true))),
                    'charges' => ($service->price / 1000) *  $data['quantity'],
                    'unit_price' => $service->price,
                    'link' => $data['link'],
                    'quantity' => $data['quantity'],
                    'user_id' => auth()->user()->id,
                    'service_id' => $data['service_id'],
                    'category_id' => $data['category_id'],
                    'order_viewable_time' => (new \DateTime())->format('Y-m-d H:i:s'),
                    'mode' => $data['service_mode'],
                    'text_area_1' => $data['text_area_1'] ?? null,
                    'text_area_2' => $data['text_area_2'] ?? null,
                    'additional_inputs' => $data['additional_inputs'] ?? null,
                ]);
            }

            if ($make_order)
            {
                User::where('id', auth()->user()->id)->update(['balance'=> auth()->user()->balance() - $data['charge'] ]);
                $log = Transaction::create([
                    'transaction_type' => 'withdraw',
                    'amount' => $data['charge'],
                    'transaction_flag' => 'order_place',
                    'user_id' =>  auth()->user()->id,
                    'admin_id' => null,
                    'status' => 'done',
                    'memo' => null,
                    'fraud_risk' => null,
                    'payment_gateway_response' => null,
                    'reseller_payment_methods_setting_id' =>  null,
                    'reseller_id' => 1,
                    ]);
                if (gettype($make_order) == 'object' && $make_order->mode == 'auto') {
                    $ps = ProviderService::where('service_id', $make_order->service_id)->first();
                    $provider_info = null;   
                    if ($ps != null) {
                        $provider_info = Provider::find($ps->provider_id);
                    }
                    else
                    {
                        $make_order->status =  "cancelled";
                        $make_order->auto_order_response  =  json_encode(['error'=> 'service ID has some issue, not found, ID'.$make_order->service_id]);
                        $make_order->save();
                        return redirect()->back()->with('success', 'Successfully saved');
                    }

                    if ($provider_info == null) {
                        $make_order->status =  "cancelled";
                        $make_order->auto_order_response  =  json_encode(['error'=> 'provider not found']);
                        $make_order->save();
                        return redirect()->back()->with('success', 'Successfully saved');
                    }

                    $make_order->original_charges = ($ps->rate/1000) * $make_order->quantity;
                    $make_order->original_unit_price = $ps->rate;
                    $dataArray = array();
                    if ($ps->type == 'Default') {
                            $dataArray = array(
                            'key' =>$provider_info->api_key,
                            'action' => 'add',
                            'service' => $ps->provider_service_id,
                            'link' => $make_order->link,
                            'quantity' => $make_order->quantity,
                            );
                    }
                    elseif($ps->type == 'Package')
                    {
                        $dataArray = array(
                            'key' =>$provider_info->api_key,
                            'action' => 'add',
                            'service' => $ps->provider_service_id,
                            'link' => $make_order->link,
                            );
                    }
                    elseif($ps->type == 'Custom Comments' || $ps->type == 'Custom Comments Package')
                    {
                        $dataArray = array(
                            'key' =>$provider_info->api_key,
                            'action' => 'add',
                            'service' => $ps->provider_service_id,
                            'link' => $make_order->link,
                            'comments' => $make_order->text_area_1,
                            );
                    }
                    elseif($ps->type ==  'Mentions Custom List')
                    {
                        $dataArray = array(
                            'key' =>$provider_info->api_key,
                            'action' => 'add',
                            'service' => $ps->provider_service_id,
                            'link' => $make_order->link,
                            'usernames' => $make_order->text_area_1,
                            );
                    }
                    elseif($ps->type == 'Mentions Hashtag')
                    {
                        $dataArray = array(
                            'key' =>$provider_info->api_key,
                            'action' => 'add',
                            'service' => $ps->provider_service_id,
                            'link' => $make_order->link,
                            'quantity' => $make_order->quantity,
                            'hashtag' => $make_order->additional_inputs,
                            );
                    }
                    elseif($ps->type == 'Comment Likes')
                    {
                        $dataArray = array(
                            'key' =>$provider_info->api_key,
                            'action' => 'add',
                            'service' => $ps->provider_service_id,
                            'link' => $make_order->link,
                            'quantity' => $make_order->quantity,
                            'username' => $make_order->additional_inputs,
                            );
                    }
                    elseif($ps->type == 'Poll')
                    {
                        $dataArray = array(
                            'key' =>$provider_info->api_key,
                            'action' => 'add',
                            'service' => $ps->provider_service_id,
                            'link' => $make_order->link,
                            'quantity' => $make_order->quantity,
                            'answer_number' => $make_order->additional_inputs,
                            );
                    }
                    elseif($ps->type == 'Subscriptions' || $ps->type == 'Mentions User Followers')
                    {
                        $make_order->status =  "cancelled";
                        $make_order->auto_order_response  =  json_encode(['error'=> 'subscription is not implemented yet']);
                        $make_order->save();
                        return redirect()->back()->with('success', 'Successfully saved');
                    }

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $provider_info->api_url);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($dataArray));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $server_output = curl_exec($ch);
                    curl_close ($ch);
                    $result  =  json_decode($server_output, true);
                    $make_order->auto_order_response  =  json_encode($result);
                    if (isset($result['order'])) {
                        $make_order->provider_order_id = $result['order'];
                    }
                    else
                    {
                        $make_order->status =  "failed";
                    }
                    $make_order->save();
                }
                return redirect()->back()->with('success', 'Successfully saved');
            }
            else return redirect()->back()->with('error', 'Error Occuered');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        // Validate form data
        $request->validate([
            'quantity' . $order->id => 'required|numeric',
            'start_counter' . $order->id => 'nullable|integer',
            'remains' . $order->id => 'nullable|integer',
            'status' . $order->id => 'required|in:COMPLETED,PROCESSING,INPROGRESS,PENDING,PARTIAL,CANCELLED,REFUNDED,REFILLING,CANCELLING',
        ]);

        try {
            $data = $request->except('_token', '_method');
            $order->update(['quantity' => $data['quantity' . $order->id], 'start_counter' => $data['start_counter' . $order->id], 'remains' => $data['remains' . $order->id], 'status' => $data['status' . $order->id]]);

            return redirect()->back()->withSuccess('Order updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        try {
            $order->delete();

            return redirect()->back()->withSuccess('Order deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
