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


    public function index() {
        $brands = $this->brandService->getBrands();
        return view('admin.brands.index', ['title' => 'CartList | Brand', 'brands' => $brands]);
    } 


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


    public function edit($id) {
        $brand = $this->brandService->validBrand($id);

        if(!$brand) {
            session()->flash('Brand_not_found', true);
            return redirect()->route('brands.index');
        }

        return view('admin.brands.edit', ['title' => 'CartList | Brand-edit', 'brand' => $brand]);
    }


    public function update(StoreBrandRequest $request, $id) {
        $response = [
            'status' => false,
            'message' => '',
            'data' => '',
            'errors' => '',
        ];

        if(!$this->brandService->validBrand($id)) {
            $response['message'] = 'Brand not found';
            return response()->json($response, 404);
        }

        $brandData = $request->getBrandData();
        $brand = $this->brandService->updateBrand($brandData, $id);

        if($brand) {
            $response['status'] = true;
            $response['message'] = 'Brand updated successfully!';

            session()->flash('brand_updated', true);
        } else {
            $response['message'] = 'Failed to update brand. Please try again later.';
        }

        return response()->json($response);
    }


    public function destroy($id) {
        $response = [
            'status' => false,
            'message' => '',
            'data' => '',
            'errors' => '',
        ];

        if(!$this->brandService->validBrand($id)) {
            $response['message'] = 'Brand not found.';
            return response()->json($response, 404);
        }

        $deleteBrand = $this->brandService->deleteBrand($id);

        if($deleteBrand) {
            $response['status'] = true;
            $response['message'] = 'Brand deleted successfully!';

            session()->flash('brand_deleted', true);
        } else {
            $response['message'] = 'Failed to delete brand. Please try again later.';
        }

        return response()->json($response);
    }
}
