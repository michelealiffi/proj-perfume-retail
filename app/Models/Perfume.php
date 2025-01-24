<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfume extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'category',
        'subcategory',
        'notes',
        'price',
        'description',
        'size',
        'image',
        'ingredients',
        'quantity',
        'gender',
        'limited_edition',
        'vegan',
        'natural',
        'is_visible'
    ];

    protected $casts = [
        'notes' => 'array',
        'ingredients' => 'array',
        'limited_edition' => 'boolean',
        'vegan' => 'boolean',
        'natural' => 'boolean',
        'is_visible' => 'boolean',
    ];

    public function getIsVisibleAttribute($value)
    {
        return $value ? 'Visible' : 'Not Visible';
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = number_format($value, 2, '.', '');
    }
}
