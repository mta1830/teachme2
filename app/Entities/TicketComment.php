<?php namespace TeachMe\Entities;

class TicketComment extends Entity
{
    protected $fillable = ['comment','link'];

    public function ticket(){
        return $this->belongsTo(Ticket::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
