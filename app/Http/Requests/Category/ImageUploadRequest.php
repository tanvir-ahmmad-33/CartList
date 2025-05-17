<?php

namespace App\Http\Requests\Category;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Http\FormRequest;

class ImageUploadRequest extends FormRequest
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
            'image' => 'required|image|mimes:jpeg,png,gif,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'image.required' => 'Please upload an image.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'Only jpeg, png, gif, and jpg images are allowed.',
            'image.max' => 'The image size must not exceed 2MB.',
        ];
    }

    public function getCategoryImage()
    {
        return $this->validated()['image'] ?? null;
    }
}
