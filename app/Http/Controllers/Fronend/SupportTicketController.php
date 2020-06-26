<?php

namespace App\Http\Controllers\Fronend;

use App\SupportTicket;
use Illuminate\Http\Request;
use App\SupportTicketComment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SupportTicketController extends Controller
{
    public function index()
    {
        $supports = SupportTicket::where('user_id', auth()->user()->id)->get();
        return view('frontend.support_tickets.index', compact('supports'));
    }

    public function store(Request $r)
    {
        try {
            $data = $r->all();
            $validator = Validator::make($data, [
                'subject' => 'required'
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
                'description' => $data['description'],
                'user_id' => auth()->user()->id,
                'send_by' => auth()->user()->id,
                'sender_role' => 'user',
            ]);

            if ($s_tickets) {
                return redirect()->back()->with('success', 'Ticket has been recieved '.$s_tickets);
            }
            else
            {
                return redirect()->back()->with('error', 'There is an error');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show(Request $r)
    {
        $ticket   = SupportTicket::find($r->supportTicket);
        $ticketMessages = $ticket->comments()->get();
        return view('frontend.support_tickets.show', compact('ticket', 'ticketMessages'));
    }

    public function makeComment(Request $r)
    {
        try {
            $data = $r->all();
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
            $comment->comment_by = auth()->user()->id;
            $comment->commentor_role = "user";
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
}
