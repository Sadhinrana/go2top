<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TicketController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('verified');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
  /*   public function index()
    {
        $tickets = SupportTicket::get();
        return view('ticket.index', compact('tickets'));
    } */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    /* public function create()
    {
        return view('ticket.create-edit');
    } */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  /*   public function store(Request $request)
    {
        // Validate form data
        $request->validate([
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        try {
            $data = $request->except('_token');
            $data['user_id'] = Auth::guard('web')->id();
            $data['status'] = 1;

            Ticket::create($data);

            return redirect()->back()->withSuccess('Ticket created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
 */
    /**
     * Display the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
   /*  public function show(Ticket $ticket)
    {
        Gate::authorize('view', $ticket);

        return view('ticket.show', compact('ticket'));
    } */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
   /*  public function edit(Ticket $ticket)
    {
        Gate::authorize('view', $ticket);

        return view('ticket.create-edit', compact('ticket'));
    } */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    /* public function update(Request $request, Ticket $ticket)
    {
        // Validate form data
        $request->validate([
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        Gate::authorize('update', $ticket);

        try {
            $data = $request->except('_token', '_method');

            $ticket->update($data);

            return redirect()->back()->withSuccess('Ticket updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    } */

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    /* public function destroy(Ticket $ticket)
    {
        Gate::authorize('delete', $ticket);

        try {
            $ticket->delete();

            return redirect()->back()->withSuccess('Ticket deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    } */
}
