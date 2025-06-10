<?php

namespace App\Http\Requests\Category;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\URL;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
        $categoryId = $this->route('id');
        return [
            'name' => 'required',
            'slug' => [
                'required',
                Rule::unique('categories')->ignore($categoryId),
            ],
            'image_id' => 'nullable|exists:temp_images,id',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The category name is required.',
            'slug.required' => 'The category slug is required.',
            'slug.unique' => 'The category slug must be unique.',
            'image_id.exists' => 'The selected image is invalid.',
            'status.required' => 'Status is required.',
        ];
    }

    public function getCategoryData() {
        $data = $this->validated();

        
        if (isset($data['image_id'])) {
            $data['image'] = $data['image_id'];
            unset($data['image_id']);
        }


        if(URL::current() == route('categories.store'))  {
            $data['created_at'] = date('Y:m:d H:i:s');
        } else {
            $data['updated_at'] = date('Y:m:d H:i:s');
            unset($data['id']);
        }

        return $data;
    }
}
