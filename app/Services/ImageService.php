<?php
namespace App\Services;

use App\Models\TempImage;

class ImageService {
    public function saveImage($image) {
        $fileName = now()->format('ymd-his') . '.' . $image->getClientOriginalExtension();

        $destinationPath = public_path('admin/temp');
        $image->move($destinationPath, $fileName);

        return TempImage::create([
            'name' => $fileName,
        ]);
    }
}