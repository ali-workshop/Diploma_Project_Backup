<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;
<<<<<<< HEAD
=======
    protected $fillable = [
        'identificationNumber',  
        'name',
        'birthDate',
        'phone_number',
    ];

    protected $dates = ['birthDate'];
>>>>>>> repoB/main

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class);
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> repoB/main
