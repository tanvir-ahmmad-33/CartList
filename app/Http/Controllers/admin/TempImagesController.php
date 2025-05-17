<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\ImageUploadRequest;
use App\Services\ImageService;
use Intervention\Image\ImageManager;

class TempImagesController extends Controller
{
    protected $imageService;

    public function __construct()
    {
        $this->imageService = new ImageService();
    }

    public function create(ImageUploadRequest $request) {
        $response = [
            'status' => false,
            'message' => '',
            'image_id' => '',
        ];
        $image = $request->getCategoryImage();

        $ext = $image->getClientOriginalExtension();
        $newName = time() . '.' . $ext;
        $result = $this->imageService->saveImage($newName);

        if($result) {
            $image->move(public_path().'/admin/temp', $newName);
            $newNameWithId = $result->id . '.' . $ext;
            rename(public_path() . '/admin/temp/' . $newName, public_path() . '/admin/temp/' . $newNameWithId);

            $response['status'] = true;
            $response['message'] = 'Image uploaded successfully!';
            $response['image_id'] = $result->id;
        } else {
            $response['status'] = false;
            $response['message'] = "Image doesn't save!";
        }

        return response()->json($response);
    }
}
