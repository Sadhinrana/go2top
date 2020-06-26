<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Controller;
use App\Order;
use App\Payment;
use App\Ticket;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $request = request();
        $payments = collect();

        for ($i = 1; $i < 32; $i++) {
            $data = collect();

            for ($j = 1; $j < 13; $j++) {
                $year = $request->query('year') ?? date('Y');
                $query = Payment::whereDate('created_at', $year . '-' . $j . '-' . $i)
                    ->where(function ($q) use ($request) {
                        if ($request->query('user_ids') && !in_array('all', $request->query('user_ids'))) {
                            $q->whereIn('user_id', $request->query('user_ids'));
                        }
                    });
                $data->put($j, !$request->query('show') || $request->query('show') == 'amount' ? $query->sum('amount') : $query->count());
            }

            $payments->push($data);
        }

        return view('reseller.report.index', compact('payments'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function order()
    {
        $request = request();
        $orders = collect();

        for ($i = 1; $i < 32; $i++) {
            $data = collect();

            for ($j = 1; $j < 13; $j++) {
                $year = $request->query('year') ?? date('Y');
                $query = Order::whereDate('created_at', $year . '-' . $j . '-' . $i)
                    ->where(function ($q) use ($request) {
                        if ($request->query('user_ids') && !in_array('all', $request->query('user_ids'))) {
                            $q->whereIn('user_id', $request->query('user_ids'));
                        }
                        if ($request->query('service_id') && !in_array('all', $request->query('service_id'))) {
                            $q->whereIn('service_id', $request->query('service_id'));
                        }
                        if ($request->query('status') && !in_array('all', $request->query('status'))) {
                            $q->whereIn('status', $request->query('status'));
                        }
                    });

                if ($request->query('show') == 'charge') {
                    $result = $query->sum('amount');
                } elseif ($request->query('show') == 'quantity') {
                    $result = $query->sum('quantity');
                } else {
                    $result = $query->count();
                }

                $data->put($j, $result);
            }

            $orders->push($data);
        }

        return view('reseller.report.order', compact('orders'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ticket()
    {
        $request = request();
        $tickets = collect();

        for ($i = 1; $i < 32; $i++) {
            $data = collect();

            for ($j = 1; $j < 13; $j++) {
                $year = $request->query('year') ?? date('Y');
                $query = Ticket::whereDate('created_at', $year . '-' . $j . '-' . $i)
                    ->where(function ($q) use ($request) {
                        if ($request->query('status')) {
                            $q->where('status', $request->query('status'));
                        } else {
                            $q->where('status', 1);
                        }
                    })->count();
                $data->put($j, $query);
            }

            $tickets->push($data);
        }

        return view('reseller.report.ticket', compact('tickets'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profits()
    {
        $request = request();
        $profits = collect();

        for ($i = 1; $i < 32; $i++) {
            $data = collect();

            for ($j = 1; $j < 13; $j++) {
                $year = $request->query('year') ?? date('Y');
                $result = Order::select(\DB::raw('sum(charges - original_charges) AS total'))
                    ->whereDate('created_at', $year . '-' . $j . '-' . $i)
                    ->whereNotNull('provider_order_id')
                    ->where(function ($q) use ($request) {
                        if ($request->query('service_id') && !in_array('all', $request->query('service_id'))) {
                            $q->whereIn('service_id', $request->query('service_id'));
                        }
                        if ($request->query('status') && !in_array('all', $request->query('status'))) {
                            $q->whereIn('status', $request->query('status'));
                        }
                    })
                    ->get();

                $data->put($j, $result[0]->total);
            }

            $profits->push($data);
        }

        return view('reseller.report.profit', compact('profits'));
    }
}
