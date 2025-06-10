<?php

namespace App\Http\Requests\Product;

use Illuminate\Support\Facades\URL;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
        $rules = [
            'title'           => 'required',
            'slug'            => 'required|unique:products,slug',
            'price'           => 'required|numeric',
            'compare_price'   => 'nullable|numeric',
            'description'     => 'nullable|string',
            'sku'             => 'required|unique:products',
            'track_qty'       => 'required|in:Yes,No',
            'category_id'     => 'required|numeric',
            'is_featured'     => 'required|in:Yes,No',
            'sub_category_id' => 'nullable|exists:sub_categories,id',
            'brand_id'        => 'nullable|exists:brands,id',
            'barcode'         => 'nullable|string|unique:products,barcode',

            'image_ids'       => 'nullable|json',
            'image_ids.*'     => 'exists:temp_images,id',
        ];

        if($this->input('track_qty') === 'Yes') {
            $rules['qty'] = 'required|numeric';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'title.required'         => 'The product title is required.',
            'slug.required'          => 'The slug is required.',
            'slug.unique'            => 'The slug has already been taken.',
            'price.required'         => 'Please enter a price.',
            'price.numeric'          => 'The price must be a number.',
            'sku.required'           => 'The SKU is required.',
            'sku.unique'             => 'The SKU has already been taken.',
            'track_qty.required'     => 'Please specify if quantity tracking is enabled.',
            'track_qty.in'           => 'Track quantity must be either Yes or No.',
            'category_id.required'   => 'Please select a category.',
            'category_id.numeric'    => 'Category ID must be numeric.',
            'is_featured.required'   => 'Please indicate if this product is featured.',
            'is_featured.in'         => 'Featured value must be either Yes or No.',
            'qty.required'           => 'Quantity is required when tracking is enabled.',
            'qty.numeric'            => 'Quantity must be a numeric value.',
            'image_ids.*.exists'     => 'One or more selected images are invalid or do not exist.',
            'sub_category_id.exists' => 'Selected subcategory does not exist.',
            'brand_id.exists'        => 'Selected brand does not exist.',
            'compare_price.numeric'  => 'The compare price must be a valid number.',
            'description.string'     => 'The description must be a valid text.',
            'barcode.string'         => 'The barcode must be a valid text.',
            'barcode.unique'         => 'The barcode has already been taken.',
        ];
    }

    public function getProductData() {
        $data = $this->validated();

        if(URL::current() == route('products.store'))  {
            $data['created_at'] = date('Y:m:d H:i:s');
        } else {
            $data['updated_at'] = date('Y:m:d H:i:s');
            unset($data['id']);
        }

        return $data;
    }

}
