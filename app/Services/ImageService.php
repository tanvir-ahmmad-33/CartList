<?php
namespace App\Services;

use App\Models\TempImage;

class ImageService {
    public function saveImage($newName) {
        $tempImage = new TempImage();
        $tempImage->name = $newName;
        $tempImage->save();

        return $tempImage;
    }
}