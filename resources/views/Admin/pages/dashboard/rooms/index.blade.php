@extends('Admin.layouts.master')
@section('index.rooms')

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
        <form action="{{ route('rooms.available.specificTime') }}" method="GET">
            <div class="row mb-3 my-1">
                <div class="col-md-4">
                    <input type="text" name="specificDate" id="specificDate" class="form-control" placeholder="Available Rooms in Specific Date">
                </div>
                <div >
                    <button type="submit" class="btn btn-outline-secondary">Filter</button>
                </div>
            </div>
        </form> 
        <form action="{{ route('rooms.reserved.specificTime') }}" method="GET">
            <div class="row mb-3 my-1">
                <div class="col-md-4">
                    <input type="text" name="specificDate" id="specificDate" class="form-control" placeholder="Booked Rooms in Specific Date ">
                </div>
                <div >
                    <button type="submit" class="btn btn-outline-secondary">Filter</button>
                </div>
            </div>
        </form> 
        <form action="{{ route('rooms.available.period') }}" method="GET">
            <div class="row mb-3 my-1">
                <div class="col-md-5">
                    <input type="text" name="start_range" id="start_range" class="form-control" placeholder="Enter Start Date For Available Rooms">
                </div>
                <div class="col-md-5">
                    <input type="text" name="end_range" id="end_range" class="form-control" placeholder="Enter End Date For Available Rooms // default:NUll">
                </div>
                <div >
                    <button type="submit" class="btn btn-outline-secondary">Filter</button>
                </div>
            </div>
        </form> 
        <form action="{{ route('rooms.reserved.period') }}" method="GET">
            <div class="row mb-3 my-1">
                <div class="col-md-5">
                    <input type="text" name="start_range" id="start_range" class="form-control" placeholder="Enter Start Date For Reserved Rooms">
                </div>
                <div class="col-md-5">
                    <input type="text" name="end_range" id="end_range" class="form-control" placeholder="Enter End Date For Reserved Rooms  // default:NUll">
                </div>
                <div >
                    <button type="submit" class="btn btn-outline-secondary">Filter</button>
                </div>
            </div>
        </form> 
        <div class="table-responsive">
            <table class="table table-bordered table-striped"  id="dataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Room type</th>
                        <th>Room code</th>
                        <th>Floor Number</th>
                        <th>Description</th>
                        <th>status</th>
                        <th>Image</th>
                        <th>price</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody >
                    @foreach($rooms as $room)
                    <tr>
                        <td>{{ $loop->iteration}}</td>
                        <td>{{ $room->roomType->name}}</td>
                        <td><a href='{{route("rooms.show", $room->id)}}'>{{ $room->code}}</a></td>
                        <td>{{ $room->floorNumber}}</td>
                        <td>{{ $room->description}}</td>
                        <td>{{ $room->status}}</td>
                        <td><img src="{{ asset('images/' . $room->img) }}" alt="{{ $room->code }}" style="max-width: 100px;"></td>
                        <td>{{ $room->price}}</td>
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