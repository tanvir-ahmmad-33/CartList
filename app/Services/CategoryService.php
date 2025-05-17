<?php
namespace App\Services;

use App\Models\Category;

class CategoryService {
    public function getCategories() {
        $perPage = 10;
        return Category::query()->search()->latest()->paginate($perPage);
    }

    public function createCategory(array $data)
    {
        if (isset($data['image_id']) && !empty($data['image_id']) && isset($data['image_extension']) && !empty($data['image_extension'])) {
            $data['image'] = $data['image_id'] . '.' . $data['image_extension'];
        }

        $category = Category::create($data);
        
        if (isset($data['image_id']) && !empty($data['image_id']) && isset($data['image_extension']) && !empty($data['image_extension'])) {
            $name = $data['image_id'] . '.' . $data['image_extension'];
            $newNameWithId = $category->id . '.' . $data['image_extension'];
            rename(public_path() . '/admin/temp/' . $name, public_path() . '/admin/categories_image/' . $newNameWithId);
        }
        
        return $category;
    }

}