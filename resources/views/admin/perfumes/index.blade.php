@extends('layouts.admin')

@section('content')
    <h1>Perfumes</h1>
    <a href="{{ route('admin.perfumes.create') }}" class="btn btn-primary">Create New Perfume</a>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>Name</th>
                <th>Brand</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($perfumes as $perfume)
                <tr>
                    <td>{{ $perfume->name }}</td>
                    <td>{{ $perfume->brand }}</td>
                    <td>${{ $perfume->price }}</td>
                    <td>
                        <a href="{{ route('admin.perfumes.show', $perfume->id) }}" class="btn btn-info">Show</a>
                        <a href="{{ route('admin.perfumes.edit', $perfume->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.perfumes.destroy', $perfume->id) }}" method="POST"
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
