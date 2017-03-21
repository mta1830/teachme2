<?php namespace TeachMe\Entities;

use Illuminate\Database\Eloquent\Model;

class TicketVote extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticke::class);
    }
}