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
                // Function to dynamically load selected filter form
                $('#filterOptions').change(function() {
                    var selectedOption = $(this).val();
                    var formContent = '';
        
                    // Generate the form content based on the selected option
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
        
                    // Set the generated form content to the #filterForms div
                    $('#filterForms').html(formContent);
                });
        
                // Function to toggle visibility of filter options
                $('#collapseIndicator').click(function() {
                    $('#filterCard').toggle();
                    $(this).text($(this).text() === '^' ? 'v' : '^'); // Change symbol from ^ to v or vice versa
                });
            });
        </script>
        </body>
        <br>
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