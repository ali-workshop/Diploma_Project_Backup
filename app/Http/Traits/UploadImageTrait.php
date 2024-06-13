<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait UploadImageTrait
{
    public function storeImage($img, $folderName, $disk = 'images')
    {
        $photo = time().$img->getClientOriginalName();
        $path = $img->storeAs($folderName, $photo, $disk);
        return $path;
    }

    public function deleteImage($path, $disk ='images')
    {   
        return Storage::disk($disk)->delete($path);
    }
    
    // don't use this method when you try to upload multiple images because  code runs so quick that the timestamp never changed
    public function verifyAndUploadImage($img,$directory,$imageName=null,$disk='images') {
            if (!$imageName){
                $nameWithoutExtension=explode('.',$img->getClientOriginalName())[0];
                $imageName=$nameWithoutExtension.time().'.'.$img->extension();
            }else{
                $imageName=$imageName.'-'.time().'.'.$img->extension();
            }
            $path=$img->storeAs($directory,$imageName,$disk);
            return $path;
    }

    // time() method causes an issue because we have duplicate files named the same thing and duplicate file paths stored in the database.
    public function UploadMultipleImages($img,$directory,$imageName=null,$disk='images') {
        $name = Str::random(10);
        if (!$imageName){
            $nameWithoutExtension=explode('.',$img->getClientOriginalName())[0];
            $imageName=$nameWithoutExtension.'-'.$name.'.'.$img->extension();
        }else{
            $imageName=$imageName.'-'.$name.'.'.$img->extension();
        }
        $path=$img->storeAs($directory,$imageName,$disk);
        return $path;
}

}