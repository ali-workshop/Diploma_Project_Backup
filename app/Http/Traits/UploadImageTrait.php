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

    public function verifyAndUpload($img, $directory,$disk='images') {
            $nameWithoutLastExtension=explode('.',$img->getClientOriginalName())[0];
            $imageName=$nameWithoutLastExtension.time().'.'.$img->extension();
            $path=$img->storeAs($directory,$imageName,$disk);
            return $path;
    }


}