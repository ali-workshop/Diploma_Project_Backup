@extends('Admin.layouts.master')
@section('show.services')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Room Service Details</h1>

<!-- DataTales -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <button type="button" class="btn btn-primary">New Service</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                    <tr>
                        <td>{{ $loop->iteration}}</td>
                        <td>{{ $service->name}}</td>
                        <td>{{ $service->price}}</td>
                        <td>{{ $service->description}}</td>
                        <td>{{ $service->img}}</td>
                        <td><a href='{{route("services.edit", $service->id)}}' class="btn btn-outline-success">EDIT</a></td>
                        <td>
                            <form action="{{ route('services.destroy', $service->id) }}" method="POST">
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