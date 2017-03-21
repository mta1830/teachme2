<?php namespace TeachMe\Http\Controllers;

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
        return $this->consultaTicketsPorStatus('open');
    }

    public function closed()
    {
        return $this->consultaTicketsPorStatus('closed');
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
        $tickets = Ticket::where('status', $status)
            ->orderBy('created_at', 'DESC')->paginate(20);
        return view('tickets/list', compact('tickets'));
    }
}
