<?php namespace TeachMe\Entities;

class Ticket extends Entity
{
    protected $fillable = ['title','status'];

    public function author(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function comments(){
        return $this->hasMany(TicketComment::class);
    }

    public function voters(){
        return $this->belongsToMany(User::class,'ticket_votes')->withTimestamps();
    }

    public function getOpenAttribute(){
        return $this->status=='open';
    }
}
