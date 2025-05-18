<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\StoreBrandRequest;
use App\Services\BrandService;

class BrandController extends Controller
{
    protected $brandService;
    public function __construct()
    {
        $this->brandService = new BrandService();
    }


    public function index() {} 


    public function create() {
        return view('admin.brands.create', ['title' => 'CartList | Brand-create']);
    }


    public function store(StoreBrandRequest $request) {
        $response = [
            'status' => false,
            'message' => '',
            'data' => '',
            'errors' => '',
        ];

        $brandData = $request->getBrandData();
        $brand = $this->brandService->createBrand($brandData);

        if($brand) {
            $response['status'] = true;
            $response['message'] = 'Brand created successfully!';

            session()->flash('brand_created', true);
        } else {
            $response['message'] = 'Failed to create brand. Please try again later.';
        }

        return response()->json($response);
    }


    public function edit() {}


    public function update() {}


    public function destroy() {}
}
