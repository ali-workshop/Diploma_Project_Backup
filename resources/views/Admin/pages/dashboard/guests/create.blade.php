@extends('Admin.layouts.master')
@section('create.guests')
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Guest
                    <a href="{{route('guests.index')}}" class="btn btn-outline-danger" style="float:right;">X</a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('guests.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" >
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="birthDate">Birth Date</label>
                            <input type="date" class="form-control @error('birthDate') is-invalid @enderror" id="birthDate" name="birthDate" >
                            @error('birthDate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number">
                            @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="identificationNumber">Identification Number</label>
                            <input type="text" class="form-control @error('identificationNumber') is-invalid @enderror" id="identificationNumber" name="identificationNumber">
                            @error('identificationNumber')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection