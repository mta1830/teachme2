<?php namespace TeachMe\Http\Controllers;

use Illuminate\Auth\Guard;
use TeachMe\Entities\Ticket;
use TeachMe\Entities\TicketComment;
use TeachMe\Http\Requests;
use TeachMe\Http\Controllers\Controller;

use Illuminate\Http\Request;
use TeachMe\Repositories\CommentRepository;
use TeachMe\Repositories\TicketRepository;

class CommentsController extends Controller {

    protected $commentRepository;
    protected $ticketRepository;

    public function __construct(CommentRepository $commentRepository, TicketRepository $ticketRepository)
    {
        $this->commentRepository = $commentRepository;
        $this->ticketRepository = $ticketRepository;
    }

    public function submit(Request $request, Guard $auth, $id){
	    $this->validate($request, [
	       'comment' => 'required|max:250',
           'link' => 'url',
        ]);

        $ticket = $this->ticketRepository->findOrFail($id);

        $this->commentRepository->create($ticket,currentUser(),$request->get('comment'),$request->get('link'));

        session()->flash('success', 'Tu comentario fue guardado exitosamente');
        return redirect()->back();
    }
}
