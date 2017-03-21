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
        $title = 'Solicitudes recientes';

        return view('tickets/list',compact('tickets','title'));
    }

    public function popular()
    {
        return view('tickets/list');
    }

    public function open()
    {
        $tickets = $this->consultaTicketsPorStatus('open');
        $title = 'Solicitudes abiertas';

        return view('tickets/list', compact('tickets','title'));
    }

    public function closed()
    {
        $tickets = $this->consultaTicketsPorStatus('closed');
        $title = 'Tutoriales';

        return view('tickets/list', compact('tickets','title'));
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
}
