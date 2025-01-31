@extends('layouts.app')

@section('title', 'Edit Perfume')

@section('content')
    <div class="container py-4">
        <h1 class="mb-4 text-center">Edit Perfume</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('perfumes.update', ['slug' => $perfume->slug]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <p class="text-muted text-small">The fields with * are required</p>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Name *</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ old('name', $perfume->name) }}" required>
                </div>

                <div class="col-md-6">
                    <label for="brand" class="form-label">Brand *</label>
                    <input type="text" name="brand" id="brand" class="form-control"
                        value="{{ old('brand', $perfume->brand) }}" required>
                </div>

                <div class="col-md-6">
                    <label for="category" class="form-label">Category *</label>
                    <input type="text" name="category" id="category" class="form-control"
                        value="{{ old('category', $perfume->category) }}" required>
                </div>

                <div class="col-md-6">
                    <label for="subcategory" class="form-label">Subcategory</label>
                    <input type="text" name="subcategory" id="subcategory" class="form-control"
                        value="{{ old('subcategory', $perfume->subcategory) }}">
                </div>

                <div class="col-md-6">
                    <label for="price" class="form-label">Price (€) *</label>
                    <input type="number" name="price" id="price" class="form-control" step="0.01"
                        value="{{ old('price', $perfume->price) }}" required>
                </div>

                <div class="col-md-6">
                    <label for="size" class="form-label">Size *</label>
                    <input type="text" name="size" id="size" class="form-control"
                        value="{{ old('size', $perfume->size) }}" required>
                </div>

                <div class="col-md-6">
                    <label for="notes" class="form-label">Notes</label>
                    <div id="notes-container">
                        @foreach ($perfume->notes as $index => $note)
                            <div class="input-group mb-2">
                                <input id="notes" type="text" name="notes[]" class="form-control"
                                    placeholder="Enter a note" value="{{ old('notes.' . $index, $note) }}">
                                <button type="button" class="btn btn-outline-danger" onclick="removeField(this)">-</button>
                            </div>
                        @endforeach
                        <div class="input-group mb-2">
                            <input id="notes" type="text" name="notes[]" class="form-control"
                                placeholder="Enter a note" value="{{ old('notes.' . count($perfume->notes)) }}">
                            <button type="button" class="btn btn-outline-secondary" onclick="addNote()">+</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="ingredients" class="form-label">Ingredients</label>
                    <div id="ingredients-container">
                        @foreach ($perfume->ingredients as $index => $ingredient)
                            <div class="input-group mb-2">
                                <input type="text" name="ingredients[]" class="form-control"
                                    placeholder="Enter an ingredient"
                                    value="{{ old('ingredients.' . $index, $ingredient) }}">
                                <button type="button" class="btn btn-outline-danger" onclick="removeField(this)">-</button>
                            </div>
                        @endforeach
                        <div class="input-group mb-2">
                            <input type="text" name="ingredients[]" class="form-control"
                                placeholder="Enter an ingredient"
                                value="{{ old('ingredients.' . count($perfume->ingredients)) }}">
                            <button type="button" class="btn btn-outline-secondary" onclick="addIngredient()">+</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="quantity" class="form-label">Quantity *</label>
                    <input type="number" name="quantity" id="quantity" class="form-control"
                        value="{{ old('quantity', $perfume->quantity) }}" required>
                </div>

                <div class="col-md-6">
                    <label for="gender" class="form-label">Gender *</label>
                    <select name="gender" id="gender" class="form-control" required>
                        <option value="Uomo" {{ old('gender', $perfume->gender) === 'Uomo' ? 'selected' : '' }}>Uomo
                        </option>
                        <option value="Donna" {{ old('gender', $perfume->gender) === 'Donna' ? 'selected' : '' }}>Donna
                        </option>
                        <option value="Unisex" {{ old('gender', $perfume->gender) === 'Unisex' ? 'selected' : '' }}>Unisex
                        </option>
                    </select>
                </div>

                <div class="col-12 d-flex flex-wrap gap-3">
                    <div class="form-check">
                        <input type="checkbox" name="limited_edition" value="1" id="limited_edition"
                            class="form-check-input"
                            {{ old('limited_edition', $perfume->limited_edition) ? 'checked' : '' }}>
                        <label class="form-check-label" for="limited_edition">Limited Edition</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="vegan" value="1" id="vegan" class="form-check-input"
                            {{ old('vegan', $perfume->vegan) ? 'checked' : '' }}>
                        <label class="form-check-label" for="vegan">Vegan</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="natural" value="1" id="natural" class="form-check-input"
                            value="1" {{ old('natural', $perfume->natural) ? 'checked' : '' }}>
                        <label class="form-check-label" for="natural">Natural</label>
                    </div>
                    <div class="form-check">
                        <label for="is_visible" class="form-label">Visible</label>
                        <input type="checkbox" name="is_visible" value="1"
                            {{ $perfume->is_visible ? 'checked' : '' }}>
                        <small class="form-text text-muted">Check to make the perfume visible, uncheck to hide it.</small>
                    </div>
                </div>

                <div class="col-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $perfume->description) }}</textarea>
                </div>

                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary w-20">Update</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function toggleImageInput() {
            let type = document.getElementById('image_type').value;
            document.getElementById('upload_section').classList.toggle('d-none', type === 'url');
            document.getElementById('url_section').classList.toggle('d-none', type === 'file');
        }

        function addNote() {
            let container = document.getElementById('notes-container');
            let div = document.createElement('div');
            div.classList.add('input-group', 'mb-2');
            div.innerHTML = `
                <input type="text" name="notes[]" class="form-control" placeholder="Enter a note">
                <button type="button" class="btn btn-outline-danger" onclick="removeField(this)">-</button>
            `;
            container.appendChild(div);
        }

        function addIngredient() {
            let container = document.getElementById('ingredients-container');
            let div = document.createElement('div');
            div.classList.add('input-group', 'mb-2');
            div.innerHTML = `
                <input type="text" name="ingredients[]" class="form-control" placeholder="Enter an ingredient">
                <button type="button" class="btn btn-outline-danger" onclick="removeField(this)">-</button>
            `;
            container.appendChild(div);
        }

        function removeField(button) {
            button.parentElement.remove();
        }
    </script>
@endsection
