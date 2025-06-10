<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\SubCategoryService;
use Illuminate\Http\Request;

class ProductSubCategoryController extends Controller
{
    protected $subCategoryService;
    protected $categoryService;

    public function __construct()
    {
        $this->subCategoryService = new SubCategoryService();
        $this->categoryService = new CategoryService();
    }
    
    public function index(Request $request) {
        $response = [
            'status' => false,
            'message' => '',
            'data' => '',
        ];
        $id = $request->category_id;

        if(!$this->categoryService->validCategory($id)) {
            $response['message'] = "Invalid category ...";
            return response()->json($response, 404);
        }

        $subcategories = $this->subCategoryService->getSubCategoryUsingCategoryId($id);

        if($subcategories) {
            $response['status'] = true;
            $response['message'] = 'Subcategories loaded successfully.';
            $response['data'] = $subcategories;
        } else {
            $response['message'] = "Subcategories doesn't loaded successfully.";
        }

        return response()->json($response);
    }
}
