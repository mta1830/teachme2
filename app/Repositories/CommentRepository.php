<?php
/**
 * Created by PhpStorm.
 * User: MIGUEL-PF
 * Date: 2/4/2017
 * Time: 3:25 PM
 */

namespace TeachMe\Repositories;


use TeachMe\Entities\Ticket;
use TeachMe\Entities\TicketComment;
use TeachMe\Entities\User;

class CommentRepository extends BaseRepository
{
    /**
     * @return \TeachMe\Entities\Entity
     */
    public function getModel()
    {
        return new TicketComment();
    }

    public function create(Ticket $ticket, User $user, $comment, $link = '')
    {
        $comment = new TicketComment(compact('comment', 'link'));
        $comment->user_id = $user->id;
        $ticket->comments()->save($comment);
    }


}