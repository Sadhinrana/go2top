<?php

namespace App\Http\Controllers\Reseller;

use App\Ticket;
use App\SupportTicket;
use App\TicketComment;
use Illuminate\Http\Request;
use App\SupportTicketComment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:reseller');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $input = request()->all();
        $input['keyword'] = isset($input['keyword']) ? $input['keyword'] : '';

        $tickets = SupportTicket::whereIn('user_id', auth()->guard('reseller')->user()->users->pluck('id'))
            ->where(function ($q) use ($input) {
            if ($input['keyword']) {
                $q->where('id', 'like', '%' . $input['keyword'] . '%')
                    ->orWhereHas('user', function($q) use ($input){
                        $q->where('name', 'like', '%' . $input['keyword'] . '%');
                    })
                    ->orWhere('subject', 'like', '%' . $input['keyword'] . '%')
                    ->orWhere('created_at', 'like', '%' . $input['keyword'] . '%')
                    ->orWhere('updated_at', 'like', '%' . $input['keyword'] . '%');
            }
        })->where(function ($q) use ($input) {
            if (isset($input['columns']) && is_array($input['columns'])) {
                foreach ($input['columns'] as $index => $value) {
                    $q->where($index, $value);
                }
            }
            if (isset($input['seen_at'])) {
                $q->whereNull('seen_at');
            }
        })->orderBy('id', 'DESC')
            ->paginate(100);

        return view('reseller.ticket.index', compact('tickets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $validator = Validator::make($data, [
                'subject' => 'required',
                'user_id' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
            }
            $s_ids = null;
            if (isset($data['order_ids'])) {
                $s_ids = $data['order_ids'];
            }elseif (isset($data['transaction_id'])) {
                $s_ids = $data['transaction_id'];
            }

            $payment_types = null;

            if (isset($data['order_types'])) {
                $payment_types = $data['order_types'];
            }elseif (isset($data['payment_types'])) {
                $payment_types = $data['payment_types'];
            }


            $s_tickets = SupportTicket::create([
                'subject' => $data['subject'],
                'subject_ids' => $s_ids,
                'payment_type' => $payment_types,
                'description' => $data['message'],
                'user_id' => $data['user_id'],
                'send_by' => Auth::guard('reseller')->id(),
                'sender_role' => 'reseller',
            ]);

            if ($s_tickets) {
                return redirect()->back()->with('success', 'Ticket has been sent');
            }
            else
            {
                return redirect()->back()->with('error', 'There is an error');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\RedirectResponse
     */
    public function comment(SupportTicket  $ticket, Request $request)
    {
        try {
            $data = $request->all();
            $validator = Validator::make($data, [
                'content' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
            }
            $ticket = SupportTicket::find($data['ticket_id']);
            $comment = new SupportTicketComment;
            $comment->message = $data['content'];
            $comment->comment_by = Auth::guard('reseller')->id();
            $comment->commentor_role = "reseller";
            $ticket->comments()->save($comment);

            if ($ticket) {
                return redirect()->back()->with('success', 'Ticket has been recieved '.$ticket);
            }
            else
            {
                return redirect()->back()->with('error', 'There is an error');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(SupportTicket $ticket)
    {
        if (Auth::guard('reseller')->id() != $ticket->user->reseller_id) {
            abort(403, 'You do not own this ticket.');
        }

        if (!$ticket->seen_at) {
            $ticket->update(['seen_at' => now()]);
        }

        return view('reseller.ticket.show', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // Validate form data
        $request->validate([
            'tickets' => 'required|array',
            'status' => 'required|string|between:1,3',
            'tickets.*' => 'required|integer|exists:tickets,id',
        ]);

        try {
            Ticket::whereIn('id', $request->tickets)->update($request->only('status'));

            return redirect()->back()->withSuccess('Tickets status updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function close(Request $request)
    {
        // Validate form data
        /* $request->validate([
            'tickets' => 'required|array',
            'tickets.*' => 'required|integer|exists:tickets,id',
        ]); */
        try {
            if (count($request->tickets)>0) {
                foreach ($request->tickets as $id) {
                   SupportTicket::where('id', $id)->update([
                       'status' => 'closed',
                   ]);
                }
           }

            return redirect()->back()->withSuccess('Tickets closed & locked successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        // Validate form data

        /* $request->validate([
            'tickets' => 'required|array',
            'tickets.*' => 'required|integer|exists:tickets,id',
        ]); */
        try {
            if (count($request->tickets)>0) {
                 foreach ($request->tickets as $id) {
                    SupportTicket::where('id', $id)->delete();
                 }
            }
            return redirect()->back()->withSuccess('Tickets deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
