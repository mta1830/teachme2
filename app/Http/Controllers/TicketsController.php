<?php namespace TeachMe\Http\Controllers;

use Illuminate\Auth\Guard;
use Illuminate\Support\Facades\Redirect;
use Psy\Util\String;
use TeachMe\Entities\Ticket;
use TeachMe\Http\Requests;
use TeachMe\Http\Controllers\Controller;

use Illuminate\Http\Request;

class TicketsController extends Controller
{
    public function latest()
    {
        $tickets = Ticket::orderBy('created_at', 'DESC')->paginate(20);

        return view('tickets/list',compact('tickets'));
    }

    public function popular()
    {
        return view('tickets/list');
    }

    public function open()
    {
        $tickets = $this->consultaTicketsPorStatus('open');

        return view('tickets/list', compact('tickets'));
    }

    public function closed()
    {
        $tickets = $this->consultaTicketsPorStatus('closed');

        return view('tickets/list', compact('tickets'));
    }

    public function details($id)
    {
        $ticket = Ticket::findOrFail($id);

        return view('tickets/details', compact('ticket'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function consultaTicketsPorStatus($status)
    {
        return Ticket::where('status', $status)
            ->orderBy('created_at', 'DESC')->paginate(20);
    }

    public function create(){
        return view('tickets/create');
    }

    public function store(Request $request, Guard $auth){

        $this->validate($request,[
            'title' => 'required|max:120'
        ]);

        $ticket = $auth->user()->tickets()->create([
            'title' => $request->get('title'),
            'status' => 'open'
        ]);

        return Redirect::route('tickets.details',$ticket);
    }
}
