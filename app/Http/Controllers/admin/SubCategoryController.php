<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\SubCategoryService;
use App\Http\Requests\SubCategory\StoreSubCategoryRequest;

class SubCategoryController extends Controller
{
    protected $subCatagoryService;

    public function __construct()
    {
        $this->subCatagoryService = new SubCategoryService();
    }

    public function index() {
        $subcategories = $this->subCatagoryService->getSubCategories();
        return view('admin.sub_category.index', ['title' => 'CartList | Sub-Category', 'subcategories' => $subcategories]);
    }

    public function create() {
        $categories = $this->subCatagoryService->getCategory();
        return view('admin.sub_category.create', ['title' => 'CartList | Sub-Category-create','categories' => $categories]);
    }

    public function store(StoreSubCategoryRequest $request) {
        $response = [
            'status' => false,
            'message' => '',
            'data' => '',
            'errors' => '',
        ];
        
        $subCategoryData = $request->getSubCategoryData();
        $subCategory = $this->subCatagoryService->createSubCategory($subCategoryData);

        if($subCategory) {
            $response['status'] = true;
            $response['message'] = 'Sub-category created successfully!';

            session()->flash('sub_category_created', true);
        } else {
            $response['message'] = 'Failed to create sub-category. Please try again later.';
        }

        return response()->json($response);
    }

    public function edit($id) {
        $subCategory = $this->subCatagoryService->vaildSubCategory($id);

        if($subCategory) {
            $categories = $this->subCatagoryService->getCategory();
            return view('admin.sub_category.edit', ['title' => 'CartList | Sub-Category-edit','categories' => $categories, 'subCategory' => $subCategory]);
        } else {
            return redirect()->route('sub-categories.index');
        }
    }
    
    public function update(StoreSubCategoryRequest $request, $id) {
        $response = [
            'status' => false,
            'message' => '',
            'data' => '',
            'errors' => '',
        ];

        if(!$this->subCatagoryService->vaildSubCategory($id)) {
            $response['message'] = 'Sub-category not found.';
            return response()->json($response, 404);
        }
        

        $subCategoryData = $request->getSubCategoryData();
        $subCategory = $this->subCatagoryService->updateSubCategory($subCategoryData, $id);

        if($subCategory) {
            $response['status'] = true;
            $response['message'] = 'Sub-category updated successfully!';

            session()->flash('sub_category_updated', true);
        } else {
            $response['message'] = 'Failed to update category. Please try again later.';
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

        if(!$this->subCatagoryService->vaildSubCategory($id)) {
            $response['message'] = 'Sub-category not found.';
            return response()->json($response, 404);
        }

        $deleteSubCategory = $this->subCatagoryService->deleteSubCategory($id);

        if($deleteSubCategory) {
            $response['status'] = true;
            $response['message'] = 'Sub-category deleted successfully!';

            session()->flash('sub_category_deleted', true);
        } else {
            $response['message'] = 'Failed to delete category. Please try again later.';
        }

        return response()->json($response);
    }
}
