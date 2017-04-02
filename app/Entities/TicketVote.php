<?php namespace TeachMe\Entities;

class TicketVote extends Entity
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticke::class);
    }
}