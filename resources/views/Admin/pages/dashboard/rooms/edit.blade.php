@extends('Admin.layouts.master')
@section('edit.rooms')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Edit {{$room->code}} Room</h1>

<!-- Form -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <form method="POST" action="{{ route('rooms.update', $room->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <label for="room_type" class="col-md-4 col-form-label text-md-end">{{ __('Room Type') }}</label>
                    <div class="col-md-6">
                        <select name="room_type" id="room_type"
                            class="form-control @error('room_type') is-invalid @enderror"
                            name="name">{{ old('status') }}
                            @foreach ($roomTypes as $roomType)
                                <option value="{{ $roomType->id }}">{{ $roomType->name }}</option>
                            @endforeach
                        </select>
                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="code" class="col-md-4 col-form-label text-md-end">{{ __('Code') }}</label>
                    <div class="col-md-6">
                        <input id="code" type="text" class="form-control @error('code') is-invalid @enderror"
                            name="code" value="{{ $room->code }}" required autocomplete="code" autofocus>
                        @error('code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="floorNumber" class="col-md-4 col-form-label text-md-end">{{ __('FloorNumber') }}</label>
                    <div class="col-md-6">
                        <input id="floorNumber" type="number" step="0.01"
                            class="form-control @error('floorNumber') is-invalid @enderror" name="floorNumber"
                            value="{{$room->floorNumber }}" required>
                        @error('floorNumber')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>
                    <div class="col-md-6">
                        <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required>{{ $room->description }}</textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="img" class="col-md-4 col-form-label text-md-end">{{ __('Image') }}</label>
                    <div class="col-md-6">
                        <input id="img" type="file"  class="form-control @error('img') is-invalid @enderror" name="img" value={{$room->img}}>
                        <img src={{ asset('images/' . $room->img) }} alt="my image" width="50%" heigh="50%"/>
                        @error('img')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('Status') }}</label>
                    <div class="col-md-6">
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="available" {{ $room->status == 'available' ? 'selected' : '' }}>Available</option>
                            <option value="booked" {{ $room->status == 'booked' ? 'selected' : '' }}>Booked</option>
                        </select>
                        @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                
                <div class="row mb-3">
                    <label for="price" class="col-md-4 col-form-label text-md-end">{{ __('Price') }}</label>
                    <div class="col-md-6">
                        <input value='{{$room->price}}' id="price" type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" name="price" required>
                        @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                

                

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </form>
            <br>
            <br>
            <br>
        </div>
    </div>
</div>
@endsection