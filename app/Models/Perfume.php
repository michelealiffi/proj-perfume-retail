<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
        'is_visible',
        'slug',
    ];

    protected $casts = [
        'notes' => 'array',
        'ingredients' => 'array',
        'limited_edition' => 'boolean',
        'vegan' => 'boolean',
        'natural' => 'boolean',
        'is_visible' => 'boolean',
    ];

    // public function getIsVisibleAttribute($value)
    // {
    //     return $value ? 'Visible' : 'Not Visible';
    // }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = number_format($value, 2, '.', '');
    }

    protected static function booted()
    {
        static::creating(function ($perfume) {
            if (empty($perfume->slug)) {
                $perfume->slug = Str::slug($perfume->name);
            }
        });

        static::updating(function ($perfume) {
            if (empty($perfume->slug)) {
                $perfume->slug = Str::slug($perfume->name);
            }
        });

        static::creating(function ($perfume) {
            $perfume->limited_edition = $perfume->limited_edition ?? false;
            $perfume->vegan = $perfume->vegan ?? false;
        });

        static::updating(function ($perfume) {
            $perfume->limited_edition = $perfume->limited_edition ?? false;
            $perfume->vegan = $perfume->vegan ?? false;
        });
    }
}
