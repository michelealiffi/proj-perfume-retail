<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perfume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PerfumeController extends Controller
{
    public function index()
    {
        $perfumes = Perfume::all();
        return view('admin.perfumes.index', compact('perfumes'));
    }

    public function create()
    {
        return view('admin.perfumes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'subcategory' => 'nullable|string|max:255',
            'notes' => 'nullable|array',
            'notes.*' => 'string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'size' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'ingredients' => 'nullable|array',
            'ingredients.*' => 'string|max:255',
            'quantity' => 'required|integer',
            'gender' => 'required|string',
            'limited_edition' => 'nullable|boolean',
            'vegan' => 'nullable|boolean',
            'natural' => 'nullable|boolean',
            'is_visible' => 'nullable|boolean',
        ]);

        $request->merge([
            'subcategory' => $request->subcategory ?? '',
            'description' => $request->description ?? '',
            'image' => $request->image ?? '',
            'notes' => $request->notes ?? [],
            'ingredients' => $request->ingredients ?? [],
            'limited_edition' => $request->limited_edition ?? false,
            'vegan' => $request->vegan ?? false,
            'natural' => $request->natural ?? false,
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $img = Image::make($image)->encode('webp', 90); // Converti in WebP
            $path = 'public/images/' . Str::slug($validated['name']) . '.webp';
            $img->save(storage_path('app/' . $path));
            $validated['image'] = str_replace('public/', '', $path);
        }

        // Creazione slug e visibilità
        $validated['slug'] = Str::slug($validated['name'], '-');
        $validated['is_visible'] = $validated['is_visible'] ?? ($validated['quantity'] > 0);

        Perfume::create($request->all());

        return redirect()->route('perfumes.index')->with('success', 'Perfume created successfully.');
    }

    public function show($slug)
    {
        $perfume = Perfume::where('slug', $slug)->firstOrFail();
        return view('admin.perfumes.show', compact('perfume'));
    }

    public function edit($slug)
    {
        $perfume = Perfume::where('slug', $slug)->firstOrFail();
        return view('admin.perfumes.edit', compact('perfume'));
    }

    public function update(Request $request, $slug)
    {
        $perfume = Perfume::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'subcategory' => 'nullable|string|max:255',
            'notes' => 'nullable|array',
            'notes.*' => 'string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'size' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'ingredients' => 'nullable|array',
            'ingredients.*' => 'string|max:255',
            'quantity' => 'required|integer',
            'gender' => 'required|string',
            'limited_edition' => 'nullable|boolean',
            'vegan' => 'nullable|boolean',
            'natural' => 'nullable|boolean',
            'is_visible' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $img = Image::make($image)->encode('webp', 90); // Converti in WebP
            $path = 'public/images/' . Str::slug($validated['name']) . '.webp';
            $img->save(storage_path('app/' . $path));
            $validated['image'] = str_replace('public/', '', $path);
        }

        // Creazione slug e visibilità
        $validated['slug'] = Str::slug($validated['name'], '-');
        $validated['is_visible'] = $validated['is_visible'] ?? ($validated['quantity'] > 0);

        $perfume->update($validated);

        return redirect()->route('admin.perfumes.show', $perfume->slug)->with('success', 'Perfume updated successfully.');
    }

    public function destroy($slug)
    {
        $perfume = Perfume::where('slug', $slug)->firstOrFail();

        if ($perfume->image && !filter_var($perfume->image, FILTER_VALIDATE_URL)) {
            Storage::delete('public/' . $perfume->image);
        }

        $perfume->delete();

        return redirect()->route('perfumes.index')->with('success', 'Perfume deleted successfully.');
    }
}
