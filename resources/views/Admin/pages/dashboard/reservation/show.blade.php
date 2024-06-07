@extends('Admin.layouts.master')
@section('show.rooms')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Reservation Details</h1>

<!-- Details -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{ $room->code }}</h6>
    </div>
    <div class="card-body">
        <div class="row">
            {{-- <div class="col-md-4">
                <img src="{{ asset('images/' . $reservation->room_id->img) }}" alt="{{ $reservation->room_id->code }}" class="img-fluid">
            </div> --}}
            <div class="col-md-8">
                <p><strong>User ID &nbsp:&nbsp</strong> {{ $reservation->user_id }}</p>
                <p><strong>Room ID &nbsp:&nbsp </strong> {{ $reservation->room_id }}</p>
                <p><strong>Reservation Code &nbsp:&nbsp </strong> {{ $reservation->code }}</p>
                <p><strong>Reservation Start Date &nbsp:&nbsp </strong> {{ $reservation->start_date }}</p>
                <p><strong>Reservation End Date &nbsp:&nbsp </strong> {{ $reservation->end_date }}</p>
                <p><strong>Number of Guests &nbsp:&nbsp </strong> {{ $reservation->guestNumber }}</p>
                <p><strong>Total Price &nbsp:&nbsp </strong> {{ $reservation->totalPrice }}</p>


                <div class="pull-right ">
                    <a class="btn btn-outline-primary" href="{{ route('reservation.index') }}">Back</a>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection