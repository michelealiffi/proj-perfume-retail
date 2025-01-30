@extends('layouts.app')

@section('title', 'Admin - Manage Perfumes')

@section('content')
    <div class="px-5">
        <div class="m-2 mb-4 d-flex justify-content-between align-items-center">
            <h1>Perfumes</h1>
            <a href="{{ route('perfumes.create') }}" class="btn btn-primary">Create New Perfume</a>
        </div>

        <table class="table mt-4">
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Brand</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Avaible</th>
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
                        <td>{{ $perfume->quantity }}</td>
                        <td>
                            <div class="d-flex justify-content-between align-items-center">
                                @if ($perfume->is_visible)
                                    <span class="badge bg-success">Available</span>
                                @else
                                    <span class="badge bg-danger">Out of Stock</span>
                                @endif
                            </div>
                        </td>
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
    </div>
@endsection
