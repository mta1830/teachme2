<?php
namespace TeachMe\Repositories;

use TeachMe\Entities\Ticket;

class TicketRepository{

    public function paginateClosed()
    {
        return $this->consultaTicketsPorStatus('closed');
    }

    protected function selectTicketsList(){

        /*SELECT t.*,
        (SELECT COUNT(*) FROM ticket_comments c WHERE c.ticket_id = t.id) AS num_comments,
        (SELECT COUNT(*) FROM ticket_votes v WHERE v.ticket_id = t.id) AS num_votes
        FROM tickets t*/

        return Ticket::selectRaw(
            'tickets.*,'.
            '(SELECT COUNT(*) FROM ticket_comments WHERE ticket_comments.ticket_id = tickets.id) AS num_comments,'.
            '(SELECT COUNT(*) FROM ticket_votes WHERE ticket_votes.ticket_id = tickets.id) AS num_votes'
        )->with('author');
    }

    /**
     * @param $status
     * @return Ticket
     */
    protected function consultaTicketsPorStatus($status)
    {
        return $this->selectTicketsList()
            ->where('status', $status)
            ->orderBy('created_at', 'DESC')
            ->paginate(20);
    }

    public function paginateLatest(){
        return $this->selectTicketsList()
            ->orderBy('created_at', 'DESC')
            ->with('author')
            ->paginate(20);
    }

    public function paginateOpen()
    {
        return $this->consultaTicketsPorStatus('open');
    }

    /**
     * @param $id
     * @return Ticket
     */
    public function findOrFail($id)
    {
        return Ticket::findOrFail($id);
    }
}
