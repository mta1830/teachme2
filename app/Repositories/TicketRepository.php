<?php
namespace TeachMe\Repositories;

use TeachMe\Entities\Ticket;

class TicketRepository extends BaseRepository {

    public function paginateClosed()
    {
        return $this->consultaTicketsPorStatus('closed');
    }

    protected function selectTicketsList(){

        /*SELECT t.*,
        (SELECT COUNT(*) FROM ticket_comments c WHERE c.ticket_id = t.id) AS num_comments,
        (SELECT COUNT(*) FROM ticket_votes v WHERE v.ticket_id = t.id) AS num_votes
        FROM tickets t*/

        return $this->newQuery()->selectRaw(
            'tickets.*,'.
            '(SELECT COUNT(*) FROM ticket_comments WHERE ticket_comments.ticket_id = tickets.id) AS num_comments,'.
            '(SELECT COUNT(*) FROM ticket_votes WHERE ticket_votes.ticket_id = tickets.id) AS num_votes'
        )->with('author');
    }

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
            ->paginate(20);
    }

    public function paginateOpen()
    {
        return $this->consultaTicketsPorStatus('open');
    }

    /**
     * @return Ticket
     */
    public function getModel()
    {
        return new Ticket();
    }

    public function newOpen(User $user, $title)
    {
        return $user->tickets()->create([
            'title'  => $title,
            'status' => 'open'
        ]);
    }
}
