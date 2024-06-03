@extends('Admin.layouts.master')
@section('create.services')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Create a New Room Service</h1>

<!-- Form -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <form method="POST" action="{{ route('services.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Name Field -->
                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <!-- Price Field -->
                <div class="row mb-3">
                    <label for="price" class="col-md-4 col-form-label text-md-end">{{ __('Price') }}</label>
                    <div class="col-md-6">
                        <input id="price" type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required>
                        @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <!-- Description Field -->
                <div class="row mb-3">
                    <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>
                    <div class="col-md-6">
                        <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required>{{ old('description') }}</textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <!-- Image Field -->
                <div class="row mb-3">
                    <label for="img" class="col-md-4 col-form-label text-md-end">{{ __('Image') }}</label>
                    <div class="col-md-6">
                        <input id="img" type="file" class="form-control @error('img') is-invalid @enderror" name="img" required>
                        @error('img')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <!-- Save Button -->
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