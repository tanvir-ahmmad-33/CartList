<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Image\ImageUploadRequest;
use App\Services\ImageService;


class TempImagesController extends Controller
{
    protected $imageService;

    public function __construct()
    {
        $this->imageService = new ImageService();
    }

    public function create(ImageUploadRequest $request) {
        $image = $request->getImage();
        $tempImage = $this->imageService->saveImage($image);
        
        
        return response()->json([
            'success' => true,
            'image_id' => $tempImage->id,
        ]);
    }
}