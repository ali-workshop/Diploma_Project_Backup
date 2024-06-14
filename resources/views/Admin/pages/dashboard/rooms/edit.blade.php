@extends('Admin.layouts.master')
@section('edit.rooms')
<style>
    .image-preview{
        display: inline-block;
        position: relative;
        margin: 10px;
    }
    .image-preview img{
        width: 60px;
        height: 60px;
    }
    .image-preview .remove-image{
        position: absolute;
        top:0;
        right: 0;
        background: rgba(255,255,255,0.8);
    }
</style>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Edit {{$room->code}} Room</h1>

<!-- Form -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <form method="POST" action="{{ route('rooms.update', $room->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Room Type Field -->
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

                <!-- Room Code Field -->
                <div class="row mb-3">
                    <label for="code" class="col-md-4 col-form-label text-md-end">{{ __('Code') }}</label>
                    <div class="col-md-6">
                        <input id="code" type="text" class="form-control @error('code') is-invalid @enderror"
                            name="code" value="{{ $room->code }}" autocomplete="code" autofocus>
                        @error('code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Floor Field -->
                <div class="row mb-3">
                    <label for="floorNumber" class="col-md-4 col-form-label text-md-end">{{ __('FloorNumber') }}</label>
                    <div class="col-md-6">
                        <input id="floorNumber" type="number" step="0.01"
                            class="form-control @error('floorNumber') is-invalid @enderror" name="floorNumber"
                            value="{{$room->floorNumber }}">
                        @error('floorNumber')
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
                        <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" >{{ $room->description }}</textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <!-- Display existing images with delete option -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        @foreach (json_decode($room->images,true) as $image)
                            <div id="Existing-images">
                                <img src={{asset('images/'.$image)}} alt="room {{$room->code}}">
                                <span class="remove-image" onclick="removeImage(this,'{{$image}}')">X</span>
                            </div> 
                        @endforeach
                    </div>
                </div>

                <!-- Hidden input to store images to delete-->
                <input type="hidden" name="delete_images" id="delete-images">
                <div class="row mb-3">
                <!--File input for new images-->
                    <label for="new_images" class="col-md-4 col-form-label text-md-end">Add New Images:</label>
                <div class="col-md-6">
                    <input id="new_images" type="file"  class="form-control @error('images') is-invalid @enderror" name="new_images[]" multiple accept="image/*" onchange="previeImages(this)">
                    <!-- Container for new Images preview-->
                    <div id="new-images-preview"></div>
                </div>
                </div>

                {{-- <div class="row mb-3">
                    <label for="file-input" class="col-md-4 col-form-label text-md-end">{{ __('Image') }}</label>
                    <div class="col-md-6">
                        <input id="file-input" type="file"  class="form-control @error('images') is-invalid @enderror" name="images" >
                        <div id="preview-container"></div>
                        @error('images')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div> --}}

                <!-- Status Field -->
                <div class="row mb-3">
                    <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('Status') }}</label>
                    <div class="col-md-6">
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="available" {{ $room->status == 'available' ? 'selected' : '' }}>Available</option>
                            <option value="unavailable" {{ $room->status == 'booked' ? 'selected' : '' }}>unavailable</option>
                        </select>
                        @error('status')
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
                        <input value='{{$room->price}}' id="price" type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" name="price">
                        @error('price')
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
<script>
// $(document).ready(function(){
//     $("#file-input").on("change", function(){
//         var files = $(this)[0].files;
//         $("#preview-container").empty();
//         if(files.length > 0){
//             for(var i = 0; i < files.length; i++){
//                 var reader = new FileReader();
//                 reader.onload = function(e){
//                     $("<div class='preview'><img src='" + e.target.result + "'><button class='delete'>UnCheck</button></div>").appendTo("#preview-container");
//                 };
//                 reader.readAsDataURL(files[i]);
//             }
//         }
//     });
// $("#preview-container").on("click", ".delete", function(){
//         $(this).parent(".preview").remove();
//         $("#file-input").val(""); // Clear input value if needed
//     });
// });

let deleteImages=[];

function removeImage(element,filename) {
    element.parentElement.remove();
    deleteImages.push(filename);
    document.getElementById('delete-images').value=JSON.stringify(deleteImages); 
}
function previewImages(params) {
    const previewContainer=document.getElementById('new-images-preview');
    previewContainer.innerHTML='';
    for (const file of input.files) {
        const reader = new FileReader();
        reader.onload=function(e){
            const preview=document.createElement('div');
            preview.classList.add('image-preview');
            const img=document.createElement('img');
            img.src=e.target.result;
            preview.appendChid(img);
        };
    reader.readAsDataURL(file);   
    }
}
</script>
@endsection