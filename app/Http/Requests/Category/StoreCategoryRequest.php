<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\URL;

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
        return [
            'name' => 'required',
            'slug' => 'required|unique:categories',
            'image_id' => 'nullable|exists:temp_images,id',
            'image_extension' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The category name is required.',
            'slug.required' => 'The category slug is required.',
            'slug.unique' => 'The category slug must be unique.',
            'image_id.exists' => 'The selected image is invalid.',
            'image_id.exists' => 'The selected image is invalid.',
        ];
    }

    public function getCategoryData() {
        $data = $this->validated();

        if ($this->has('image_id') && $this->input('image_id')) {
            $data['image_id'] = $this->input('image_id');
        }

        if($this->has('image_extension') && $this->input('image_extension')) {
            $data['image_extension'] = $this->input('image_extension');
        }

        if(URL::current() == route('categories.store'))  {
            $data['created_at'] = date('Y:m:d H:i:s');
        }

        return $data;
    }
}
