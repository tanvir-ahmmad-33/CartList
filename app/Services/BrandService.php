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


    public function createBrand(array $data) {
        return Brand::create($data);
    }
}