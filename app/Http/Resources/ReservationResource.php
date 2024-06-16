<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'userName'     => $this->user->name,
            'roomCode'     => $this->code,
            'guestNumber'  => $this->guestNumber,
            'totalPrice'   => $this->totalPrice,
            'startDate'    => $this->start_date,
            'endDate'      => $this->end_date,
        ];
    }
}
