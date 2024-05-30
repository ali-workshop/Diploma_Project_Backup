<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationStatusCatlog extends Model
{
    use HasFactory;
    public function reservationStatusEvents()
    {
        return $this->belongsToMany(ReservationStatusEvent::class);
    }
}
