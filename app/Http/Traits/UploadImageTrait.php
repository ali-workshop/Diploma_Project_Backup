<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait UploadImageTrait
{
    public function storeImage($img, $folderName, $disk = 'images')
    {
        $photo = time().$img->getClientOriginalName();
        $path = $img->storeAs($folderName, $photo, $disk);
        return $path;
    }
    public function deleteImage($path, $disk = 'images')
    {
        return Storage::disk($disk)->delete($path);
    }
}