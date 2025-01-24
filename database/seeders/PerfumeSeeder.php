<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PerfumeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $perfumes = [
            [
                // Dati Generici
                'name' => 'Nome del profumo',
                'brand' => 'Marca del profumo',
                'category' => 'Categoria del profumo',
                'subcategory' => 'Sottocategoria',
                'notes' => ['Nota 1', 'Nota 2', 'Nota 3'],
                'price' => 50.00,
                'description' => 'Descrizione del prodotto',
                'size' => '75ml',
                'image' => 'images/default.webp',
                'ingredients' => ['Ingrediente 1', 'Ingrediente 2', 'Ingrediente 3'],
                'quantity' => 100,
                'gender' => 'Unisex',
                'limited_edition' => false,
                'vegan' => true,
                'natural' => false,
                'is_visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        $path = storage_path('json');
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        File::put($path . '/perfumes.json', json_encode($perfumes, JSON_PRETTY_PRINT));
    }
}
