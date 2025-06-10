<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Category\StoreCategoryRequest;

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
    public function edit($id) {
        $validCategory = $this->categoryService->validCategory($id);

        if($validCategory) {
            $category = $this->categoryService->getCategoryById($id);

            if(!empty($category->image)) {
                $category->image_id = $category->image;
            } else {
                $category->image_id = null;
            }

            return view('admin.category.edit',[
                'title' => 'CartList | Category-edit',
                'category' => $category,
            ]);
        } else {
            session()->flash('found_category_error', true);
            return redirect()->route('categories.index');
        }
    }

    // update
    public function update(StoreCategoryRequest $request, $id) {
        $response = [
            'status' => false,
            'message' => '',
        ];

        $categoryData = $request->getCategoryData();
        $category = $this->categoryService->updateCategory($categoryData, $id);

        if($category) {
            $response['status'] = true;
            $response['message'] = 'Category updated successfully!';

            session()->flash('category_updated', true);
        } else {
            $response['message'] = 'Failed to update category. Please try again later.';
        }

        return response()->json($response);
    }

    // destroy
    public function destroy($id) {
        $response = [
            'status' => false,
            'message' => '',
        ];

        $category = $this->categoryService->validCategory($id);

        if($category) {
            $categoryDelete = $this->categoryService->deleteCategory($id);

            if($categoryDelete) {
                $response['status'] = true;
                $response['message'] = 'Category deleted successfully';

                session()->flash('category_deleted', true);
            } else {
                $response['message'] = 'Failed to delete category. Please try again later.';
            }

            return response()->json($response);
        } else {
            session()->flash('found_category_error', true);
        }
    }
}
