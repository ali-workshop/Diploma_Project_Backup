@extends('Admin.layouts.master')
@section('index.guests')
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
                        
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Birth Date</th>
                                    <th>Phone Number</th>
                                    <th>Identification Number</th>
                                    <th>visitings</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($guests as $guest)
                                    <tr>
                                        <td>{{ $guest->name }}</td>
                                        <td>{{ $guest->birthDate }}</td>
                                        <td>{{ $guest->phone_number }}</td>
                                        <td> {{ $guest->identificationNumber }}</td>
                                        <td>Associated with <strong>{{ $guest->reservations_count }}</strong> reservations</td>
                                        <td>
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