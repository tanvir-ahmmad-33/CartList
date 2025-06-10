<?php
namespace App\Services;

use App\Models\Brand;

class BrandService{
    public function getBrands() {
        $perPage = 10;
        return Brand::query()
                    ->search()
                    ->latest('id')
                    ->paginate($perPage);
    }


    public function getAllBrand() {
        return Brand::get();
    }


    public function createBrand(array $data) {
        return Brand::create($data);
    }

    public function validBrand($id) {
        return Brand::find($id);
    }

    public function updateBrand(array $data, $id) {
        return Brand::findOrFail($id)
            ->update($data);
    }

    public function deleteBrand($id) {
        return Brand::findOrFail($id)
            ->delete();
    }
}