<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
=======


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> repoB/main

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
        'code',
        'start_date',
        'end_date',
        'guestNumber',
        'totalPrice',
    ];
<<<<<<< HEAD
    
=======

>>>>>>> repoB/main
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function guests()
    {
        return $this->belongsToMany(Guest::class);
    }

    public function reservationStatusEvents()
    {
        return $this->hasMany(ReservationStatusEvent::class);
    }
}
