<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Relations\HasMany;
>>>>>>> repoB/main

class ReservationStatusCatlog extends Model
{
    use HasFactory;
<<<<<<< HEAD
    public function reservationStatusEvents()
    {
        return $this->belongsToMany(ReservationStatusEvent::class);
=======
    public function reservationStatusEvents():HasMany
    {
        return $this->hasMany(ReservationStatusEvent::class);
>>>>>>> repoB/main
    }
}
