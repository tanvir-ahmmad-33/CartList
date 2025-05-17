<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
    ];

    public function scopeSearch($query)
    {
        $request = request();

        if ($request->has("keyword") && $request->keyword !== '') {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }
        
        return $query;
    }
}