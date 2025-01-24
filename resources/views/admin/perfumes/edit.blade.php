@extends('layouts.admin')

@section('content')
    <h1>Edit Perfume</h1>

    <form action="{{ route('admin.perfumes.update', $perfume->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $perfume->name) }}"
                required>
        </div>

        <div class="form-group">
            <label for="brand">Brand</label>
            <input type="text" name="brand" id="brand" class="form-control"
                value="{{ old('brand', $perfume->brand) }}" required>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" class="form-control"
                value="{{ old('price', $perfume->price) }}" required>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <button type="submit" class="mt-3 btn btn-primary">Update</button>
    </form>
@endsection
