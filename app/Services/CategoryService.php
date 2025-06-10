<?php
namespace App\Services;

use App\Models\Category;
use App\Models\TempImage;
use Illuminate\Support\Facades\Storage;

class CategoryService {
    public function getCategories() {
        $perPage = 10;
        return Category::query()->search()->latest()->paginate($perPage);
    }

    public function getAllCategory() {
        return Category::get();
    }

    public function createCategory(array $data) {
        $imageId = $data['image'] ?? null;
        unset($data['image']);

        $category = Category::create($data);

        if($imageId) {
            $image = TempImage::find($imageId);

            if($image) {
                $ext = pathinfo($image->name, PATHINFO_EXTENSION);
                $newFileName = $category->id . '.' . $ext;
                $categoryFolder = 'admin/categories_image';

                $tempPath = public_path('admin/temp/' . $image->name);
                $newPath = public_path($categoryFolder . '/' . $newFileName);


                if (!file_exists(public_path($categoryFolder))) {
                    mkdir(public_path($categoryFolder), 0755, true);
                }

                if (!file_exists($tempPath)) {
                    throw new \Exception("File does not exist: $tempPath");
                }

                rename($tempPath, $newPath);

                $category->update(['image' => $newFileName]);

                $image->delete();
            }
        }

        return $category;
    }


    public function validCategory($id): bool {
        return Category::where('id', $id)->exists();
    }


    public function getCategoryById($id) {
        return Category::find($id);
    }


    public function updateCategory(array $data, $id) {
        $category = Category::find($id);

        if($category) {
            if(isset($data['image'])) {
                $image = TempImage::find($data['image']);

                if(!$image) {
                    throw new \Exception("Temp image isn't found");
                }

                if(!file_exists(public_path('admin/categories_image'))) {
                    mkdir(public_path('admin/categories_image', 0755, true));
                }

                $oldFileName = public_path('admin/categories_image/' . $category->image);
                
                if(file_exists($oldFileName)) {
                    unlink($oldFileName);
                }

                $ext = pathinfo($image->name, PATHINFO_EXTENSION);
                $newName = $id . '.' . $ext;

                rename(public_path('admin/temp/' . $image->name), public_path('admin/categories_image/' . $newName));

                $data['image'] = $newName;
                $category->update($data);

                return $category;
            }

            return $category->update($data);
        }

        return false;
    }

    public function deleteCategory($id) {
        return Category::findOrFail($id)->delete();
    }
}