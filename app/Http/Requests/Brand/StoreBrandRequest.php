<?php

namespace App\Http\Requests\Brand;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\URL;

class StoreBrandRequest extends FormRequest
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
            'slug' => 'required|unique:brands',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The brand name is required.',
            'slug.required' => 'The brand slug is required.',
            'slug.unique' => 'The brand slug must be unique.',
            'status.required' => 'The brand status is required.',
        ];
    }

    public function getBrandData() {
        $data = $this->validated();

        if(URL::current() == route('brands.store'))  {
            $data['created_at'] = date('Y:m:d H:i:s');
        } else {
            $data['updated_at'] = date('Y:m:d H:i:s');
            unset($data['id']);
        }

        return $data;
    }
}
