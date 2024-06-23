@extends('Admin.layouts.master')
@section('index.guests')
<style>
    .table td,.table th {
        text-align: center;
    }
</style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Guests</div>

                    <div class="card-body">
                        <a href="{{ route('guests.create') }}" class="btn btn-primary mb-3">Add Guest</a>
                        
                        @if(session('status'))
                            <div class="alert alert-success">{{ session('status') }}</div>
                        @endif
                        
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="row">
                                    <th class="col-2">Full Name</th>
                                    <th class="col-2">Birth Date</th>
                                    <th class="col-2">Phone Number</th>
                                    <th class="col-2">Identification Number</th>
                                    <th class="col-2">visitings</th>
                                    <th class="col-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($guests as $guest)
                                    <tr class="row">
                                        <td class="col-2">{{ $guest->name }}</td>
                                        <td class="col-2">{{ $guest->birthDate }}</td>
                                        <td class="col-2">{{ $guest->phone_number }}</td>
                                        <td class="col-2"> {{ $guest->identificationNumber }}</td>
                                        <td class="col-2">Associated with <strong>{{ $guest->reservations_count }}</strong> reservations</td>
                                        <td class="col-2">
                                            <a href="{{ route('guests.edit', $guest->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('guests.destroy', $guest->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection