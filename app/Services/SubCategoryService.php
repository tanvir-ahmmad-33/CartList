<?php
namespace App\Services;

use App\Models\Category;
use App\Models\SubCategory;

class SubCategoryService {
    public function getSubCategories() {
        $perPage = 10;
        return SubCategory::leftJoin('categories', 'sub_categories.category_id', '=', 'categories.id')
            ->select('sub_categories.*', 'categories.name as category_name')
            ->search()
            ->latest('id')
            ->paginate($perPage);
    }
    
    public function getCategory() {
        return Category::orderBy('name', 'ASC')
            ->get();
    }

    public function createSubCategory(array $data){
        return SubCategory::create($data);
    }


    public function vaildSubCategory($id) {
        return SubCategory::find($id);
    }

    public function updateSubCategory(array $data, $id) {
        return SubCategory::findOrFail($id)
            ->update($data);
    }

    public function deleteSubCategory($id) {
        return SubCategory::find($id)
            ->delete();
    }
}