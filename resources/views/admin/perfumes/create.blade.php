@extends('layouts.app')

@section('title', 'Create Perfume')

@section('content')
    <div class="container py-4">
        <h1 class="mb-4 text-center">Create New Perfume</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('perfumes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <p class="text-muted text-small">The fields with * are required</p>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Name *</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="brand" class="form-label">Brand *</label>
                    <input type="text" name="brand" id="brand" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="category" class="form-label">Category *</label>
                    <input type="text" name="category" id="category" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="subcategory" class="form-label">Subcategory</label>
                    <input type="text" name="subcategory" id="subcategory" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="price" class="form-label">Price (€) *</label>
                    <input type="number" name="price" id="price" class="form-control" step="0.01" required>
                </div>

                <div class="col-md-6">
                    <label for="size" class="form-label">Size *</label>
                    <input type="text" name="size" id="size" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="notes" class="form-label">Notes</label>
                    <div id="notes-container">
                        <div class="input-group mb-2">
                            <input id="notes" type="text" name="notes[]" class="form-control"
                                placeholder="Enter a note" value="{{ old('notes.0') }}">
                            <button id="notes" type="button" class="btn btn-outline-secondary"
                                onclick="addNote()">+</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="ingredients" class="form-label">Ingredients</label>
                    <div id="ingredients-container">
                        <div class="input-group mb-2">
                            <input type="text" name="ingredients[]" class="form-control"
                                placeholder="Enter an ingredient" value="{{ old('ingredients.0') }}">
                            <button type="button" class="btn btn-outline-secondary" onclick="addIngredient()">+</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="quantity" class="form-label">Quantity *</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="gender" class="form-label">Gender *</label>
                    <select id="gender" name="gender" class="form-control">
                        <option value="">Select Gender</option>
                        <option value="unisex" {{ old('gender') == 'unisex' ? 'selected' : '' }}>Unisex</option>
                        <option value="uomo" {{ old('gender') == 'uomo' ? 'selected' : '' }}>Male</option>
                        <option value="donna" {{ old('gender') == 'donna' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>

                <div class="col-12 d-flex flex-wrap gap-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="limited_edition" id="limited_edition">
                        <label class="form-check-label" for="limited_edition">Limited Edition</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="vegan" id="vegan">
                        <label class="form-check-label" for="vegan">Vegan</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="natural" id="natural">
                        <label class="form-check-label" for="natural">Natural</label>
                    </div>
                </div>

                <div class="col-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                </div>

                {{-- Selettore modalità immagine --}}
                <div class="col-md-6">
                    <label for="image_type" class="form-label">Upload Method</label>
                    <select id="image_type" class="form-select" onchange="toggleImageInput()">
                        <option value="file" selected>Upload from PC</option>
                        <option value="url">Insert URL</option>
                    </select>
                </div>

                {{-- Upload da PC --}}
                <div class="col-md-6" id="upload_section">
                    <label for="image_file" class="form-label">Upload Image</label>
                    <input type="file" name="image_file" id="image_file" class="form-control" accept="image/*">
                </div>

                {{-- Inserimento URL --}}
                <div class="col-md-6 d-none" id="url_section">
                    <label for="image_url" class="form-label">Image URL</label>
                    <input type="url" name="image_url" id="image_url" class="form-control">
                </div>

                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary w-20">Save</button>
                </div>
            </div>
        </form>
    </div>

    {{-- SCRIPT --}}
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
