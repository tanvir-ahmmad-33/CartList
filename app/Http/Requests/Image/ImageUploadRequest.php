<?php

namespace App\Http\Requests\Image;

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
            'image' => 'nullable|image|mimes:jpeg,png,gif,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'Only jpeg, png, gif, and jpg images are allowed.',
            'image.max' => 'The image size must not exceed 2MB.',
        ];
    }

    public function getImage()
    {
        return $this->file('image');
    }
}
