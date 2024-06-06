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
                        <td>{{ $room->img}}</td>
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