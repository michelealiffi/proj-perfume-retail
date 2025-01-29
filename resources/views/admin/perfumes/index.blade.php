@extends('layouts.app')

@section('title', 'Admin - Manage Perfumes')

@section('content')
    <div class="m-2 mb-4 d-flex justify-content-between align-items-center">
        <h1>Perfumes</h1>
        <a href="{{ route('perfumes.create') }}" class="btn btn-primary">Create New Perfume</a>
    </div>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>Name</th>
                <th>Brand</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($perfumes as $perfume)
                <tr>
                    <td>
                        <img src="{{ Storage::url($perfume->image) }}" alt="{{ $perfume->name }}" class="img-thumbnail"
                            style="width: 50px; height: 50px; object-fit: cover;">
                    </td>
                    <td>{{ $perfume->name }}</td>
                    <td>{{ $perfume->brand }}</td>
                    <td>{{ $perfume->price }}€</td>
                    <td>
                        <a href="{{ route('perfumes.show', $perfume->slug) }}" class="btn btn-info">Show</a>
                        <a href="{{ route('perfumes.edit', $perfume->slug) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('perfumes.destroy', $perfume->slug) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
