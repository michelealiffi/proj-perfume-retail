@extends('layouts.app')

@section('title', 'Edit Perfume')

@section('content')
    <div class="container py-4">
        <h1 class="mb-4 text-center">Edit Perfume</h1>

        <form action="{{ route('perfumes.update', $perfume->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control"
                    value="{{ old('name', $perfume->name) }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="brand">Brand</label>
                <input type="text" name="brand" id="brand" class="form-control"
                    value="{{ old('brand', $perfume->brand) }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="price">Price (€)</label>
                <input type="number" name="price" id="price" class="form-control" step="0.01"
                    value="{{ old('price', $perfume->price) }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="image_type">Choose Image Source</label>
                <select id="image_type" class="form-control" onchange="toggleImageInput()">
                    <option value="file" {{ Str::startsWith($perfume->image, 'http') ? '' : 'selected' }}>
                        Upload from PC
                    </option>
                    <option value="url" {{ Str::startsWith($perfume->image, 'http') ? 'selected' : '' }}>
                        Use Image URL
                    </option>
                </select>
            </div>

            <div class="form-group mb-3" id="upload_section"
                style="{{ Str::startsWith($perfume->image, 'http') ? 'display: none;' : '' }}">
                <label for="image_file">Upload Image</label>
                <input type="file" name="image_file" id="image_file" class="form-control">
            </div>

            <div class="form-group mb-3" id="url_section"
                style="{{ Str::startsWith($perfume->image, 'http') ? '' : 'display: none;' }}">
                <label for="image_url">Enter Image URL</label>
                <input type="url" name="image_url" id="image_url" class="form-control"
                    value="{{ Str::startsWith($perfume->image, 'http') ? $perfume->image : '' }}">
            </div>

            <button type="submit" class="btn btn-primary">Update Perfume</button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            toggleImageInput();
        });

        function toggleImageInput() {
            const type = document.getElementById("image_type").value;
            document.getElementById("upload_section").style.display = (type === "file") ? "block" : "none";
            document.getElementById("url_section").style.display = (type === "url") ? "block" : "none";
        }
    </script>
@endsection
