<?php

namespace App\Http\Requests\SubCategory;

use Illuminate\Support\Facades\URL;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSubCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $subcategoryId = $this->route('id');
        
        return [
            'name' => 'required',
            'slug' => ['required', Rule::unique('sub_categories', 'slug')->ignore($subcategoryId),],
            'category_id' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The sub-category name is required.',
            'slug.required' => 'The sub-category slug is required.',
            'slug.unique' => 'The sub-category slug must be unique.',
            'category_id.required' => 'The category name is required.',
            'status.required' => 'The sub-category status is required.',
        ];
    }

    public function getSubCategoryData() {
        $data = $this->validated();

        if(URL::current() == route('sub-categories.store'))  {
            $data['created_at'] = date('Y:m:d H:i:s');
        } else {
            $data['updated_at'] = date('Y:m:d H:i:s');
            unset($data['id']);
        }
        
        return $data;
    }
}
