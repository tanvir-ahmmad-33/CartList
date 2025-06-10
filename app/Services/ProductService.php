<?php
namespace App\Services;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\TempImage;

class ProductService {
    public function getProducts() {
        $perPage = 10;
        return Product::latest('id')
                      ->paginate($perPage);
    }

    public function createProduct(array $data) {
        if(isset($data['image_ids'])) {
            $imageIds = json_decode($data['image_ids'], true);
            unset($data['image_ids']);
        } else {
            $imageIds = null;
        }
        
        $product = Product::create($data);

        if($imageIds) {
            foreach($imageIds as $imageId) {
                $tempImage = TempImage::find($imageId);

                $productImage = ProductImage::create([
                    'product_id' => $product->id,
                    'name' => $tempImage->name
                ]);

                $oldImageName = $tempImage->name;
                $ext = pathinfo($oldImageName, PATHINFO_EXTENSION);
                $imageNewName = $product->id . '-' . $productImage->id . '-' . time() . '.' . $ext;

                $productImage->update([
                    'name' => $imageNewName,
                ]);

                $oldImagePath = public_path('admin/temp/' . $oldImageName);
                $newImagePath = public_path('admin/products_image/' . $imageNewName);
                rename($oldImagePath, $newImagePath);
            }
        }

        return $product;
    }
}