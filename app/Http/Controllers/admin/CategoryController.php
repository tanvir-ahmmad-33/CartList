<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
    }
    // listing
    public function index() {
        $categories = $this->categoryService->getCategories();
        
        return view('admin.category.index', ['title' => 'CartList | Category','categories' => $categories]);
    }

    // create
    public function create() {
        return view('admin.category.create', ['title' => 'CartList | Category-create']);
    }

    // store
    public function store(StoreCategoryRequest $request) {
        $response = [
            'status' => false,
            'message' => '',
            'data' => '',
            'errors' => '',
        ];

        $categoryData = $request->getCategoryData();
        $result = $this->categoryService->createCategory($categoryData);

        if($result) {
            $response['status'] = true;
            $response['message'] = 'Category created successfully!';

            session()->flash('category_created', true);
        } else {
            $response['message'] = 'Failed to create category. Please try again later.';
        }

        return response()->json($response);
    }

    // edit
    public function edit() {

    }

    // update
    public function update() {

    }

    // destroy
    public function destroy() {

    }
}
