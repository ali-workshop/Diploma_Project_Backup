@extends('Admin.layouts.master')
@section('index.rooms')
<style>
    .table-image {
        td, th {
            vertical-align: middle;
        }
    }
</style>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Hotel Rooms</h1>

<!-- DataTales -->
<div class="card shadow mb-1" >
    <div class="card-header py-2">
    <a href="{{ route('rooms.create') }}" class="btn btn-primary">New Room</a>
    </div>
    <div class="card-body">
        <form action="{{ route('rooms.index') }}" method="GET">
            <div class="row mb-3 my-1">
                <div class="col-md-3">
                    <input type="text" name="name" id="name" class="form-control" placeholder="Search by Room Type" value="{{ request()->name }}">
                </div>
                <div >
                    <button type="submit" class="btn btn-outline-secondary">Filter</button>
                </div>
            </div>
        </form> 
        <div class="container">
            <table class="table-bordered table-hover table-image">
                <thead>
                    <tr>
                        <th class="col-md-1">#</th>
                        <th class="col-md-1">Room type</th>
                        <th class="col-md-1">Room code</th>
                        <th class="col-md-1">Floor Number</th>
                        <th class="col-md-1">Description</th>
                        <th class="col-md-1">status</th>
                        <th class="col-md-1">Price</th>
                        <th class="col-md-3">Image</th>
                        <th class="col-md-1">Edit</th>
                        <th class="col-md-1">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rooms as $room)
                    <tr>
                        <td>{{ $loop->iteration}}</td>
                        <td>{{ $room->roomType->name}}</td>
                        <td><a href='{{route("rooms.show", $room->id)}}'>{{ $room->code}}</a></td>
                        <td>{{ $room->floorNumber}}</td>
                        <td>{{ $room->description}}</td>
                        <td>{{ $room->status}}</td>
                        <td>{{ $room->price}}</td>
                        <td>
                            @foreach (json_decode($room->images,true) as $image)
                                <img src="{{asset('images/'.$image )}}" alt="{{ $room->code }}" style="max-width:50%;  padding:5px; display:inline; float:left;" class="img-responsive">
                            @endforeach
                        </td>
                        <td><a href='{{route("rooms.edit", $room->id)}}' class="btn btn-outline-success">EDIT</a></td>
                        <td>
                            <form action="{{ route('rooms.destroy', $room->id) }}" method="POST">
                                @csrf
                                @method ('DELETE')
                                <button type="submit" class="btn btn-outline-danger">DELETE</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection