<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Services\BrandService;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected $categoryService;
    protected $brandService;
    protected $productService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
        $this->brandService = new BrandService();
        $this->productService = new ProductService();
    }
    

    public function index() {
        $products = $this->productService->getProducts();

        return view('admin.products.index', ['title' => 'CartList | Product', 'products' => $products]);
    }


    public function create() {
        $categories = $this->categoryService->getAllCategory();
        $brands = $this->brandService->getAllBrand();
        
        return view('admin.products.create', [
            'title' => 'CartList | Product-create',
            'categories' => $categories,
            'brands' => $brands
        ]);
    }


    public function store(StoreProductRequest $request) {
        $response = [
            'status' => false,
            'message' => '',
            'data' => '',
            'errors' => '',
        ];

        $productData = $request->getProductData();
        $product = $this->productService->createProduct($productData);

        if($product) {
            $response['status'] = true;
            $response['message'] = 'Product created successfully!';

            session()->flash('product_created', true);
        } else {
            $response['message'] = 'Failed to create product. Please try again later.';
        }

        return response()->json($response);
    }


    public function edit() {}


    public function update() {}


    public function destroy() {}    
}