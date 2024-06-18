@extends('Admin.layouts.master')
@section('index.rooms')
<<<<<<< HEAD

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Hotel Rooms</h1>

<!-- DataTales -->
<div class="card shadow mb-1" >
=======
<style>
    .table-image {

        td,
        th {
            vertical-align: middle;
        }
    }
</style>
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Hotel Rooms</h1>
            <div>
                <a href="{{ route('rooms.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-plus fa-sm text-white-50"></i> New Room
                </a>
                <a href="{{ route('rooms.ending-in-24-hours') }}"
                    class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-clock fa-sm text-white-50"></i> Rooms Expiring in 24 Hours
                </a>
            </div>
        </div>
        <!-- DataTales -->
        {{-- <div class="card shadow mb-1">
            <div class="card-body"> --}}

<!-- DataTales -->
<div class="card shadow mb-1" >
    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
>>>>>>> repoB/main
    <div class="card-header py-2">
    <a href="{{ route('rooms.create') }}" class="btn btn-primary">New Room</a>
    <a href="{{ route('rooms.ending-in-24-hours') }}" class="btn btn-primary">Rooms that expire after 24 hours</a>
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
<<<<<<< HEAD
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
=======
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Room Filters</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <body>
        <div class="container mt-3">
            <div class="card">
                <div class="card-header">
                    <h4>Filter Rooms BY Date <span id="collapseIndicator" style="cursor: pointer;">^</span></h4>
                </div>
                <div class="card-body" id="filterCard">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="filterOptions">Select Filtering Option:</label>
                                <select id="filterOptions" class="form-control">
                                    <option value="availableSpecificDate">Available Rooms on Specific Date</option>
                                    <option value="reservedSpecificDate">Booked Rooms on Specific Date</option>
                                    <option value="availablePeriod">Available Rooms for Period</option>
                                    <option value="reservedPeriod">Reserved Rooms for Period</option>
                                </select>
                            </div>
                            <div id="filterForms">
                                <!-- Filtering forms will be added here dynamically -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                
                $('#filterOptions').change(function() {
                    var selectedOption = $(this).val();
                    var formContent = '';
        
                    if (selectedOption === 'availableSpecificDate') {
                        formContent = `
                            <form action="{{ route('rooms.available.specificTime') }}" method="GET">
                                <div class="form-group">
                                    <label for="specificDate">Select Date:</label>
                                    <input type="date" name="specificDate" id="specificDate" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-outline-secondary">Filter</button>
                            </form>
                        `;
                } else if (selectedOption === 'reservedSpecificDate') {
                    formContent = `
                            <form action="{{ route('rooms.reserved.specificTime') }}" method="GET">
                                <div class="form-group">
                                    <label for="specificDate">Select Date:</label>
                                    <input type="date" name="specificDate" id="specificDate" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-outline-secondary">Filter</button>
                            </form>
                        `;
                } else if (selectedOption === 'availablePeriod') {
                    formContent = `
                            <form action="{{ route('rooms.available.period') }}" method="GET">
                                <div class="form-group">
                                    <label for="start_range">Start Date:</label>
                                    <input type="date" name="start_range" id="start_range" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="end_range">End Date:</label>
                                    <input type="date" name="end_range" id="end_range" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-outline-secondary">Filter</button>
                            </form>
                        `;
                } else if (selectedOption === 'reservedPeriod') {
                    formContent = `
                            <form action="{{ route('rooms.reserved.period') }}" method="GET">
                                <div class="form-group">
                                    <label for="start_range">Start Date:</label>
                                    <input type="date" name="start_range" id="start_range" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="end_range">End Date:</label>
                                    <input type="date" name="end_range" id="end_range" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-outline-secondary">Filter</button>
                            </form>
                        `;
                }
                $('#filterForms').html(formContent);
            });


            $('#collapseIndicator').click(function() {
                $('#filterCard').toggle();
                $(this).text($(this).text() === '^' ? 'v' : '^');
            });
        });
    </script>

        </script>
        </body>
        <br>
        <div class="container">
            <table class="table-bordered table-hover table-image"  id="dataTable">
                <thead>
                    <tr>
                        <th class="col-md-1">#</th>
                        <th class="col-md-1">Room type</th>
                        <th class="col-md-1">Room code</th>
                        <th class="col-md-1">Floor Number</th>
                        <th class="col-md-1">Description</th>
                        <th class="col-md-1">status</th>
                        <th class="col-md-1">Price</th>
                        <th class="col-md-3">Images</th>
                        <th class="col-md-1">Edit</th>
                        <th class="col-md-1">Delete</th>
                    </tr>
                </thead>
                <tbody>
>>>>>>> repoB/main
                    @foreach($rooms as $room)
                    <tr>
                        <td>{{ $loop->iteration}}</td>
                        <td>{{ $room->roomType->name}}</td>
                        <td><a href='{{route("rooms.show", $room->id)}}'>{{ $room->code}}</a></td>
                        <td>{{ $room->floorNumber}}</td>
                        <td>{{ $room->description}}</td>
                        <td>{{ $room->status}}</td>
<<<<<<< HEAD
                        <td><img src="{{ asset('images/' . $room->img) }}" alt="{{ $room->code }}" style="max-width: 100px;"></td>
                        <td>{{ $room->price}}</td>
=======
                        <td>{{ $room->price}}</td>
                        <td>
                            @if ($room->images)
                                @foreach (json_decode($room->images,true) as $image)
                                    <img src="{{asset('images/'.$image )}}" alt="{{ $room->code }}" style="max-width:50%; height: auto; padding:5px; display:inline; float:left;" class="img-responsive">
                                @endforeach
                            @endif
                        </td>
>>>>>>> repoB/main
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
<<<<<<< HEAD
@endsection
=======
@endsection

>>>>>>> repoB/main
