<?php

namespace App\Http\Controllers;

use App\Models\Perfume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PerfumeController extends Controller
{
    private $jsonFile = 'json/perfumes.json';

    private function getPerfumes()
    {
        $filePath = storage_path('app/' . $this->jsonFile);
        if (!file_exists($filePath)) {
            return [];
        }
        return json_decode(file_get_contents($filePath), true) ?? [];
    }

    private function savePerfumes(array $perfumes)
    {
        $filePath = storage_path('app/' . $this->jsonFile);
        file_put_contents($filePath, json_encode($perfumes, JSON_PRETTY_PRINT));
    }

    public function index()
    {
        $perfumes = $this->getPerfumes();
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'ingredients' => 'nullable|array',
            'ingredients.*' => 'string|max:255',
            'quantity' => 'required|integer',
            'gender' => 'required|string',
            'limited_edition' => 'nullable|boolean',
            'vegan' => 'nullable|boolean',
            'natural' => 'nullable|boolean',
            'is_visible' => 'nullable|boolean',
        ]);

        $perfumes = $this->getPerfumes();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/images');
            $validated['image'] = str_replace('public/', '', $path);
        }

        $validated['is_visible'] = $validated['is_visible'] ?? ($validated['quantity'] > 0);

        $validated['id'] = count($perfumes) > 0 ? max(array_column($perfumes, 'id')) + 1 : 1;
        $perfumes[] = $validated;

        $this->savePerfumes($perfumes);

        return redirect()->route('admin.perfumes.index');
    }

    public function show($id)
    {
        $perfumes = $this->getPerfumes();
        $perfume = collect($perfumes)->firstWhere('id', $id);

        if (!$perfume) {
            abort(404);
        }

        return view('admin.perfumes.show', compact('perfume'));
    }

    public function edit($id)
    {
        $perfumes = $this->getPerfumes();
        $perfume = collect($perfumes)->firstWhere('id', $id);

        if (!$perfume) {
            abort(404);
        }

        return view('admin.perfumes.edit', compact('perfume'));
    }

    public function update(Request $request, $id)
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'ingredients' => 'nullable|array',
            'ingredients.*' => 'string|max:255',
            'quantity' => 'required|integer',
            'gender' => 'required|string',
            'limited_edition' => 'nullable|boolean',
            'vegan' => 'nullable|boolean',
            'natural' => 'nullable|boolean',
            'is_visible' => 'nullable|boolean',
        ]);

        $perfumes = $this->getPerfumes();

        foreach ($perfumes as &$perfume) {
            if ($perfume['id'] == $id) {
                if ($request->hasFile('image')) {
                    $path = $request->file('image')->store('public/images');
                    $validated['image'] = str_replace('public/', '', $path);
                }
                $perfume = array_merge($perfume, $validated);
                break;
            }
        }

        $this->savePerfumes($perfumes);

        return redirect()->route('admin.perfumes.show', $perfume->id)->with('success', 'Perfume updated successfully.');
    }

    public function destroy($id)
    {
        $perfumes = $this->getPerfumes();
        $perfumes = array_filter($perfumes, fn($perfume) => $perfume['id'] != $id);

        $this->savePerfumes($perfumes);

        return redirect()->route('admin.perfumes.index')->with('success', 'Perfume deleted successfully.');
    }
}
