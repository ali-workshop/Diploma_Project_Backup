@extends('Admin.layouts.master')
@section('show.rooms')
<style>
    .carousel-item img {
    max-height: 500px;
    object-fit: cover;
}
</style>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Details</h1>

<!-- Details -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Room Number {{ $room->code }} Details</h6>
    </div>
    <div class="card-body" >
        <div class="row">
            <div class="col-md-5">
                <div id="showroomCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach(json_decode($room->images,true) as $key => $image)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="{{asset('images/'.$image)}}" class="d-block w-100" alt="...">
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#showroomCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#showroomCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-md-7">
                <h4 class="mb-3">Details</h4>
                <p><strong>Room Number:</strong> {{ $room->code }}</p>
                <p><strong>Room Type:</strong> {{ $room->roomType->name }}</p>
                <p><strong>Services:</strong>  @foreach ($room->roomType->services as $service){{$service->name.' '.','}} @endforeach </p>
                <p><strong>Floor:</strong> {{ $room->floorNumber }}</p>
                <p><strong>Capacity:</strong> {{ $room->roomType->capacity }}</p>
                <p><strong>Availability Status:</strong> {{ $room->status }}</p>
                <p><strong>Description:</strong> {{ $room->description }}</p>
                <p><strong>Price:</strong> {{ $room->price }}</p>
                <a class="btn btn-outline-primary" href="{{ route('rooms.index') }}">Back</a>
            </div>
        </div>
    </div>   
</div>

@endsection