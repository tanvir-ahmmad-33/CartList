<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'status',
    ];

    public function scopeSearch($query)
    {
        $request = request();

        if ($request->has("keyword") && $request->keyword !== '') {
            $keyword = '%' . $request->keyword . '%';

            $query->where(function($subquery) use ($keyword) {
                $subquery->where('sub_categories.name', 'like', $keyword)->orWhere('categories.name', 'like', $keyword);
            });
    }
        
        return $query;
    }
}
