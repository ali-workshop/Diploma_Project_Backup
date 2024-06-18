<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
>>>>>>> repoB/main

class ReservationStatusEvent extends Model
{
    use HasFactory;
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

<<<<<<< HEAD
    public function reservationStatusCatalogs()
    {
        return $this->belongsToMany(ReservationStatusCatlog::class);
=======
    public function reservationStatusCatalogs():BelongsTo
    {
        return $this->belongsTo(ReservationStatusCatlog::class,'reservation_status_catlog_id');
>>>>>>> repoB/main
    }
}
