@extends('Admin.layouts.master')
@section('show.rooms')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Details</h1>

<!-- Details -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Room Number {{ $room->code }} Details</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                @foreach(json_decode($room->images,true) as $image)
                        <img src={{asset('images/'.$image)}} alt="{{$room->code}}" class="img-fluid">
                @endforeach
            </div>
            <div class="col-md-8">
                <p><strong>Room Number:</strong> {{ $room->code}}</p>
                <p><strong>Floor:</strong> {{ $room->floorNumber }}</p>
                <p><strong>Availability Status:</strong> {{ $room->status }}</p>
                <p><strong>Description:</strong> {{ $room->description }}</p>
                <p><strong>Price:</strong> {{ $room->price }}</p>
                <div class="pull-right ">
                    <a class="btn btn-outline-primary" href="{{ route('rooms.index') }}">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection